<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_template_model extends CI_Model{
	
	private $table , $lang_table, $primary_key;
	
	public function __construct(){
        return parent::__construct();
	}
	
	
	public function configure($options=array()){
		$this->table = !empty($options['table']) ? $options['table'] : '';
		$this->lang_table =  !empty($options['lang_table']) ? $options['lang_table'] : '';
		$this->primary_key = !empty($options['primary_key']) ? $options['primary_key'] : '';
	}
	
	public function getList($srch=array(), $limit=0, $offset=20, $for_list=TRUE){
		$admin_default_lang = admin_default_lang();
		$this->db->select('*')
			->from($this->table. ' a')
			->join($this->lang_table. ' b', 'a.'.$this->primary_key.'='.'b.'.$this->primary_key);
		
		if(!empty($srch['show']) && $srch['show'] == 'trash'){
			$this->db->where('a.status', DELETE_STATUS);	
		}else{
			$this->db->where('a.status <>', DELETE_STATUS);	
		}
		
	
		if(!empty($srch['term'])){
			$this->db->group_start();
			$this->db->like('a.template_for', $srch['term']);
			$this->db->or_like('a.template_type', $srch['term']);
			$this->db->or_like('b.template_subject', $srch['term']);
			$this->db->group_end();
		}
		
		$this->db->where('b.lang', $admin_default_lang);	
		if($for_list){
			$result = $this->db->limit($offset, $limit)->order_by('a.'.$this->primary_key, 'DESC')->get()->result_array();
		}else{
			$result = $this->db->count_all_results();
		}
		
		return $result;
	}
	
	public function addRecord($data=array()){
		$structure = array(
			'template_for' => !empty($data['template_for']) ? $data['template_for'] : '',
			'template_type' => !empty($data['template_type']) ? $data['template_type'] : '',
			'template_keys' => !empty($data['template_keys']) ? $data['template_keys'] : '',
			'display_order' => !empty($data['display_order']) ? $data['display_order'] : '0',
			'status' => !empty($data['status']) ? $data['status'] : '0',
		);
		$ins['data'] = $structure;
		$ins['table'] = $this->table;
		$insert_id = insert($ins, TRUE);
		
		$lang_fields = $data['lang'];
		$this->insert_lang_data($lang_fields, $insert_id);
		
		
		return $insert_id;
	}
	
	public function insert_lang_data($lang_fields=array(), $insert_id=''){
		$all_lang = get_lang();
		
		$this->db->where($this->primary_key, $insert_id)->delete($this->lang_table);
		foreach($all_lang as $k => $v){
			
			
			$structure = array(
				$this->primary_key => $insert_id,
				'lang' => $v,
			);
			
			foreach($lang_fields as $field_name => $lang_val){
				$structure[$field_name] = $lang_fields[$field_name][$v];
			}
			
			$lang_record['data'] = $structure;
			$lang_record['table'] = $this->lang_table;
			
			insert($lang_record);
		}
	}


	public function updateRecord($data=array(), $id=''){
		$structure = array(
			'template_for' => !empty($data['template_for']) ? $data['template_for'] : '',
			'template_type' => !empty($data['template_type']) ? $data['template_type'] : '',
			'template_keys' => !empty($data['template_keys']) ? $data['template_keys'] : '',
			'display_order' => !empty($data['display_order']) ? $data['display_order'] : '0',
			'status' => !empty($data['status']) ? $data['status'] : '0',
		);
		$ins['data'] = $structure;
		$ins['table'] = $this->table;
		$ins['where'] = array($this->primary_key => $id);
		
		
		$lang_fields = $data['lang'];
		$this->insert_lang_data($lang_fields, $id);
		
		
		return  update($ins);
	}
	
	public function deleteRecord($id=''){
		if($id && is_array($id)){
			return $this->db->where_in($this->primary_key, $id)->update($this->table, array('status' => DELETE_STATUS));
		}else{
			$ins['data'] = array('status' => DELETE_STATUS);
			$ins['table'] = $this->table;
			$ins['where'] = array($this->primary_key => $id);
			return  update($ins);
		}
		
	}
	
	public function getDetail($id=''){
		$result = $this->db->where($this->primary_key, $id)->get($this->table)->row_array();
		$lang_result = $this->db->where($this->primary_key, $id)->get($this->lang_table)->result_array();
		
		$lang_template_subject=$template_content=array();
		
		foreach($lang_result as $k => $v){
			$lang_template_subject[$v['lang']] = $v['template_subject'];
			$lang_template_content[$v['lang']] = $v['template_content'];
		}
		$result['lang'] = array();
		foreach($result as $k => $v){
			$result['lang']['template_subject'] = $lang_template_subject;
			$result['lang']['template_content'] = $lang_template_content;
		}
		return $result;
	}
	
}


