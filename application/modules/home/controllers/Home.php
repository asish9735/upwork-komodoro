<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {
	
	private $data;
	
    public function __construct() {
		$this->loggedUser=$this->session->userdata('loggedUser');
		$this->access_member_type='';
		if($this->loggedUser){
			$this->access_user_id=$this->loggedUser['LID'];	
			$this->access_member_type=$this->loggedUser['ACC_P_TYP'];
			$this->member_id=$this->loggedUser['MID'];
		}
		parent::__construct();
        $this->load->model('home_model');
		$curr_class = $this->router->fetch_class();
		$curr_method = $this->router->fetch_method();
		
		$this->data['curr_class'] = $curr_class;
		$this->data['curr_method'] = $curr_method;
		
		/**
		 * Setting default css and js
		 */
		$this->layout->set_css(array(
			'home.css','feedback.css'
			
		));


		$this->layout->set_js(array(
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
			'bootbox_custom.js',
		));
		
    }

    public function index() {
		$this->layout->set_meta('author', 'Venkatesh bishu');
		$this->layout->set_meta('keywords', 'Freelancer Script, Freelancer, New Flance');
		$this->layout->set_meta('description', 'Freelancer Clone Script');

		$login_user_id=0;
		if($this->loggedUser){
			$login_user_id=$this->member_id;
		}
		$this->data['login_user_id']=$login_user_id;
		$this->load->model('findtalents/findtalents_model');
		$get = array('order_by'=>'rating');
		$limit = 0;
		$offset = 10;
		$this->data['popular_category'] = $this->findtalents_model->get_all_category(true);
		$this->data['popular_freelancer']=$this->findtalents_model->getTalentList($get,$limit, $offset);

		$this->load->model('job/job_model');
		$get = array('order_by'=>'default');
		$limit = 0;
		$offset = 6;
		$this->data['job_list'] =$this->job_model->getJobList($get,$limit, $offset);
		if($this->data['job_list']){
			foreach($this->data['job_list'] as $k=>$row){
				$clientdata=new stdClass();
				if($row['organization_id']){
					$memberData=getData(array(
						'select'=>'o.organization_name,c_n.country_name,c.country_code_short',
						'table'=>'organization as o',
						'join'=>array(
							array('table'=>'organization_address as o_a','on'=>'o.organization_id=o_a.organization_id','position'=>'left'),
							array('table'=>'country as c','on'=>'o_a.organization_country=c.country_code','position'=>'left'),
							array('table'=>'country_names as c_n','on'=>"(o_a.organization_country=c_n.country_code and c_n.country_lang='".get_active_lang()."')",'position'=>'left')
						),
						'where'=>array('o.organization_id'=>$row['organization_id']),
						'single_row'=>true,
					));
					$clientdata->client_name=$memberData->organization_name;
					$clientdata->client_location=$memberData->country_name;
					$clientdata->client_logo=getCompanyLogo($row['organization_id']);
					$clientdata->country_code_short=$memberData->country_code_short;
				}else{
					$memberData=getData(array(
						'select'=>'m.member_name,c_n.country_name,c.country_code_short',
						'table'=>'member as m',
						'join'=>array(
							array('table'=>'member_address as m_a','on'=>'m.member_id=m_a.member_id','position'=>'left'),
							array('table'=>'country as c','on'=>'m_a.member_country=c.country_code','position'=>'left'),
							array('table'=>'country_names as c_n','on'=>"(m_a.member_country=c_n.country_code and c_n.country_lang='".get_active_lang()."')",'position'=>'left')
						),
						'where'=>array('m.member_id'=>$row['owner_id']),
						'single_row'=>true,
					));
					$clientdata->client_name=$memberData->member_name;
					$clientdata->client_location=$memberData->country_name;
					$clientdata->client_logo=getMemberLogo($row['owner_id']);
					$clientdata->country_code_short=$memberData->country_code_short;
				}
				$memberDatacount=getData(array(
					'select'=>'m_s.avg_rating,m_s.no_of_reviews,m_s.total_spent',
					'table'=>'member_statistics as m_s',
					'where'=>array('m_s.member_id'=>$row['owner_id']),
					'single_row'=>TRUE
				));
				$clientdata->avg_rating=0;
				if($memberDatacount){
					$clientdata->avg_rating=$memberDatacount->avg_rating;
				}
				$row['clientdata']=$clientdata;
				$this->data['job_list'][$k]=$row;
			}
		}

		$this->load->model('proposals/proposals_model');
		$get = array();
		$get['is_featured']=1;
		$limit = 0;
		$offset = 8;
		$this->data['featured_proposals'] = $this->proposals_model->list_proposal($get , $limit , $offset);


		$this->load->model('skill_model');
		$limit = 0;
		$offset = 32;
		$this->data['popular_skills']=$this->skill_model->getPolularSkillsList($get,$limit, $offset);
		$page="how-it-works";
		$this->load->model('cms/cms_model');
		$this->data['cms_temp']=$this->cms_model->getTempContent($page);
		$this->data['testimonial']=$this->home_model->getTestimonial();
		$this->data['partner']=$this->home_model->getPartner();
		$this->data['slider']=$this->home_model->getSldier();
		$this->layout->view('index',$this->data);
	}
	public function findjobs() {
		$this->layout->set_meta('author', 'Venkatesh bishu');
		$this->layout->set_meta('keywords', 'Freelancer Script, Freelancer, New Flance');
		$this->layout->set_meta('description', 'Freelancer Clone Script');
		$this->layout->view('findjobs',$this->data);
	}
	public function findtalents() {
		$this->layout->set_meta('author', 'Venkatesh bishu');
		$this->layout->set_meta('keywords', 'Freelancer Script, Freelancer, New Flance');
		$this->layout->set_meta('description', 'Freelancer Clone Script');
		$this->layout->view('findtalents',$this->data);
	}
	public function enterprise() {
		$this->layout->set_title('Enterprise');
		$this->layout->set_meta('author', 'Dev Sharma');
		$this->layout->set_meta('keywords', 'Freelancer Script, Freelancer, New Flance');
		$this->layout->set_meta('description', 'Freelancer Clone Script');
		$this->layout->view('enterprise',$this->data);
	}
	public function membership() {
		$this->layout->set_title('Membership');
		$this->layout->set_meta('author', 'Dev Sharma');
		$this->layout->set_meta('keywords', 'Freelancer Script, Freelancer, New Flance');
		$this->layout->set_meta('description', 'Freelancer Clone Script');
		$this->layout->view('membership',$this->data);
	}
	public function setlanguage(){
		$msg=array();
		$i=0;
		$default_lang=get_setting('default_lang');
		$msg['status']='OK';
		$previous_lang=post('preflang');
		$current_lang=post('newlang');
		$refeffer=$this->input->post('currentlink').'/';
		$replace=$previous_lang.'/';
		$new_location_slug=$current_lang.'/';
		if($default_lang==$current_lang){
			$new_location_slug='';
		}
		$refeffer=rtrim(str_replace($replace,'',$refeffer),'/');
		$msg['refeffer']=SITE_URL.$new_location_slug.$refeffer;				
		echo json_encode($msg);
	}
	
}
