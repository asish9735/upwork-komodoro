<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Findtalents extends MX_Controller {
	
	private $data;
	
    public function __construct() {
		parent::__construct();
        $this->load->model('findtalents_model');
		$curr_class = $this->router->fetch_class();
		$curr_method = $this->router->fetch_method();
		
		$this->data['curr_class'] = $curr_class;
		$this->data['curr_method'] = $curr_method;
		
    }

  
	public function all_list() {

		$this->data['category'] = $this->findtalents_model->get_all_category();
		$this->layout->set_meta('author', 'Venkatesh bishu');
		$this->layout->set_meta('keywords', 'Freelancer Script, Freelancer, New Flance');
		$this->layout->set_meta('description', 'Freelancer Clone Script');
		$this->layout->view('findtalents',$this->data);
	}
	
	public function get_sub_category(){
		$category_id = get('category_id');
		$category = array();
		if($category_id > 0){
			$category = $this->job_model->get_sub_category($category_id);
		}
		
		$this->api->set_data('category', $category);
		$this->api->out();
	}
	
	public function talent_list_ajax(){
		$data=array();
		$get = get();

		$limit = !empty($get['per_page']) ? $get['per_page'] : 0;
		$offset = 10;
		$next_limit = $limit + $offset;
		
		$data['talent_list'] =$this->findtalents_model->getTalentList($get,$limit, $offset);
		$data['talent_list_count'] =$this->findtalents_model->getTalentList($get,'','', FALSE);
		
		$json['talent_list'] = $data['talent_list'];
		$json['talent_list_count'] = $data['talent_list_count'];
		
		if($data['talent_list_count'] > $next_limit){
			unset($get['per_page']);
			
			if($get){
				$json['next'] = base_url('findtalents/talent_list_ajax?per_page='.$next_limit.'&'.http_build_query($get));
			}else{
				$json['next'] = base_url('findtalents/talent_list_ajax?per_page='.$next_limit);
			}
			
		}else{
			$json['next'] = null;
		}
		$json['html'] = $this->layout->view('talent-list-ajax',$data, TRUE, TRUE);
		$json['status'] = 1;		
		echo json_encode($json);
	}
	
	

	
	
}
