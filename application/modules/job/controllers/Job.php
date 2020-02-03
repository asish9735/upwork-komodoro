<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Job extends MX_Controller {
	
	private $data;
	
    public function __construct() {
		parent::__construct();
        $this->load->model('job_model');
		$curr_class = $this->router->fetch_class();
		$curr_method = $this->router->fetch_method();
		
		$this->data['curr_class'] = $curr_class;
		$this->data['curr_method'] = $curr_method;
		
		/**
		 * Setting default css and js
		 */
		/* $this->layout->set_css(array(
			'bootstrap.css',
			
		));
 */

		/* $this->layout->set_js(array(
			'jquery-3.3.1.min.js',
			'jquery-migrate-3.0.0.min.js',
			'popper.js',
			'bootstrap.min.js',
			'mmenu.min.js',
			'tippy.all.min.js',
			'simplebar.min.js',
			'bootstrap-slider.min.js',
			'bootstrap-select.min.js',
			'snackbar.js',
			'clipboard.min.js',
			'counterup.min.js',
			'magnific-popup.min.js',
			'slick.min.js',
			'custom.js',
		)); */
		
    }

  
	public function findjobs() {
		$this->data['category'] = $this->job_model->get_all_category();
		$this->data['experience_level'] = $this->job_model->get_experience_level();
		$this->layout->set_meta('author', 'Venkatesh bishu');
		$this->layout->set_meta('keywords', 'Freelancer Script, Freelancer, New Flance');
		$this->layout->set_meta('description', 'Freelancer Clone Script');
		$this->layout->view('findjobs',$this->data);
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
	
	public function job_list_ajax(){
		$data=array();
		$get = get();

		$limit = !empty($get['per_page']) ? $get['per_page'] : 0;
		$offset = 10;
		$next_limit = $limit + $offset;
		
		$data['job_list'] =$this->job_model->getJobList($get,$limit, $offset);
		$data['job_list_count'] =$this->job_model->getJobList($get,'','', FALSE);
		
		$json['job_list'] = $data['job_list'];
		$json['job_list_count'] = $data['job_list_count'];
		
		if($data['job_list_count'] > $next_limit){
			unset($get['per_page']);
			
			if($get){
				$json['next'] = base_url('job/job_list_ajax?per_page='.$next_limit.'&'.http_build_query($get));
			}else{
				$json['next'] = base_url('job/job_list_ajax?per_page='.$next_limit);
			}
			
		}else{
			$json['next'] = null;
		}
		$json['html'] = $this->layout->view('job-list-ajax',$data, TRUE, TRUE);
		$json['status'] = 1;		
		echo json_encode($json);
	}
	
	

	
	
}
