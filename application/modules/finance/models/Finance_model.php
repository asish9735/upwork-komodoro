<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finance_model extends CI_Model {

	private $lang;
	
    public function __construct() {
		$this->lang = get_active_lang();
        return parent::__construct();
    }
    
	public function getPlan(){
		$pln_list =  get_results(array('select' => '*', 'from' => 'plan', 'offset' => 'all', 'where' => array('status' => 'Y')));
		if(count($pln_list) > 0){
			foreach($pln_list as $k => $v){
				$pln_list[$k]['features'] = $this->_getPlanFeature($v['id']);
			}
			return $pln_list;
		}else{
			return array();
		}
		
	}

	
}
