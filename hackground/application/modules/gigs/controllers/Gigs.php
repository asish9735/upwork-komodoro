<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gigs extends MX_Controller {
   
   private $data;
   
	public function __construct(){
		$this->data['curr_controller'] = $this->router->fetch_class()."/";
		$this->data['curr_method'] = $this->router->fetch_method()."/";
		$this->load->model('gigs_model', 'proposal');
		$this->data['table'] = 'proposals';
		$this->data['primary_key'] = 'proposal_id';
		parent::__construct();
		
		admin_log_check();
	}

	public function index(){
		redirect(base_url($this->data['curr_controller'].'list_record'));
	}
	
	public function list_record(){
		$srch = get();
		if($srch && get('csv') && $srch['csv']==1){
			$this->load->helper('csv');	
			$csvarr=array();
			$csvarr[]=array('ID','Title','Category','Sub Category','Created On','Created By ID','Creator Name','Status');
			$list = $this->proposal->getListCSV($srch);
			if($list){
				foreach($list as $k=>$v){
				$status_txt = '';
				if($v['proposal_status'] == PROPOSAL_ACTIVE){
					$status_txt = 'Active';
				}else if($v['proposal_status'] == PROPOSAL_PENDING){
					$status_txt = 'Pending';
				}else if($v['proposal_status'] == PROPOSAL_DECLINED){
					$status_txt = 'Declined';
				}else if($v['proposal_status'] == PROPOSAL_MODIFICATION){
					$status_txt = 'Modification';
				}else if($v['proposal_status'] == PROPOSAL_PAUSED){
					$status_txt = 'Pause';
				}else{
					$status_txt = 'Deleted';
				}
					$csvarr[]=array($v['proposal_id'],$v['proposal_title'],$v['category_name'],$v['sub_category'],$v['proposal_date'],$v['proposal_seller_id'],$v['member_name'],$status_txt);
				}
			}
			$file_name='Proposal-List-'.date("dmY").'.csv';
			array_to_csv($csvarr, $file_name);
			exit();
		}
		$curr_limit = get('per_page');
		$limit = !empty($curr_limit) ? $curr_limit : 0; 
		$offset = 20;
		$this->data['main_title'] = 'Service Management';
		$this->data['second_title'] = 'List of services';
		$this->data['title'] = 'Services';
		$breadcrumb = array(
			array(
				'name' => 'Service',
				'path' => '',
			),
		);
		$this->data['breadcrumb'] = breadcrumb($breadcrumb);
		$this->data['list'] = $this->proposal->getList($srch, $limit, $offset);
		$this->data['list_total'] = $this->proposal->getList($srch, $limit, $offset, FALSE);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url($this->data['curr_controller'].'list_record');
		$config['total_rows'] =$this->data['list_total'];
		$config['per_page'] = $offset;
		$config['page_query_string'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		
		$this->data['links'] = $this->pagination->create_links();
		$this->data['add_command'] = null;
		$this->data['edit_command'] = null;
		
		/* search parameter */
		$this->load->model('category/category_model');
		
		$this->data['category'] = $this->category_model->get_all_category();
		$this->layout->view('list', $this->data);
       
	}
	
	public function load_ajax_page(){
		$page = get('page');
		$this->data['page'] = $page;
		if($page == 'add'){
			$this->data['title'] = 'Add Test Three';
			$this->data['form_action'] = base_url($this->data['curr_controller'].'add');
		}else if($page == 'edit'){
			$id = get('id');
			$this->data['ID']= $id;
			$this->data['form_action'] = base_url($this->data['curr_controller'].'edit');
			$this->data['detail'] = $this->proposal->getDetail($id);
			$this->load->model('category/category_model');
			$this->data['category'] = $this->category_model->get_all_category();
			$this->data['sub_category'] = $this->proposal->get_all_sub_category($this->data['detail']['category_id']);
			$this->data['title'] = 'Edit Proposal';
		}else if($page == 'subcat'){
			$id = get('id');
			$this->data['ID']= $id;
			$this->data['sub_category'] = $this->proposal->get_all_sub_category($id);
		}else if($page == 'reason'){
			$id = get('id');
			$type = get('type');
			$this->data['ID']= $id;
			$this->data['status']= $type;
			$this->data['form_action'] = base_url($this->data['curr_controller'].'reason');
			//$this->data['detail'] = $this->proposal->getDetail($id);
			$this->data['title'] = 'Edit Test Three';
			if($type==PROPOSAL_MODIFICATION){
				$this->data['title'] = 'Modification reason';
			}elseif($type==PROPOSAL_PAUSED){
				$this->data['title'] = 'Pause reason';
			}
			
		}
		$this->load->view('ajax_page', $this->data);
	}
	public function reason(){
		if(post() && $this->input->is_ajax_request()){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('reason', 'reason', 'required|trim');
			$this->form_validation->set_rules('ID', 'ID', 'required|trim');
			$this->form_validation->set_rules('status', 'status', 'required|trim');
			if($this->form_validation->run()){
				$post = post();
				
				$ID = post('ID');
				$sts = post('status');
				$reason = post('reason');
				$upd['data'] = array('proposal_status' => $sts,'admin_reason'=>$reason);
				if($sts==PROPOSAL_MODIFICATION){
					//$upd['data']['last_reminder_date']=date('Y-m-d');
				}
				$upd['where'] = array($this->data['primary_key'] => $ID);
				$upd['table'] = $this->data['table'];
				update($upd);
				
				$member_id=getField('proposal_seller_id','proposals','proposal_id',$ID);
				$RECEIVER_EMAIL=getField('member_email','member','member_id',$member_id);
				$SELLER_NAME=getField('member_name','member','member_id',$member_id);
				$data_parse=array(
				'SELLER_NAME'=>$SELLER_NAME,
				'REASON'=>$reason,
				'PROPOSAL_URL'=>SITE_URL.'s/'.getField('proposal_url','proposals','proposal_id',$ID),
				);
				if($sts==PROPOSAL_MODIFICATION){
					$template='modification-request-by-admin';
				}elseif($sts==PROPOSAL_PAUSED){
					$template='proposal-paused-by-admin';
				}
				SendMail($RECEIVER_EMAIL,$template,$data_parse);
				$this->api->cmd('reload');
			}else{
				$errors = validation_errors_array();
				$this->api->set_error($errors);
			}
			
		}else{
			$this->api->set_error('invalid_request', 'Invalid Request');
		}
		
		$this->api->out();
	}
	public function add(){
		if(post() && $this->input->is_ajax_request()){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'name', 'required|trim|max_length[100]');
			$this->form_validation->set_rules('status', 'status', '');
			if($this->form_validation->run()){
				$post = post();
				$insert = $this->proposal->addRecord($post);
				if(post('add_more') && post('add_more') == '1'){
					$this->api->cmd('reset_form');
				}else{
					$this->api->cmd('reload');
				}
				
			}else{
				$errors = validation_errors_array();
				$this->api->set_error($errors);
			}
			
		}else{
			$this->api->set_error('invalid_request', 'Invalid Request');
		}
		
		$this->api->out();
	}
	
	public function edit(){
		if(post() && $this->input->is_ajax_request()){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('proposal_title', 'title', 'required|trim');
			$this->form_validation->set_rules('category_id', 'category_id', 'required|trim|numeric');
			$this->form_validation->set_rules('category_subchild_id', 'category_subchild_id', 'required|trim|numeric');
			$this->form_validation->set_rules('ID', 'id', 'required');
			if($this->form_validation->run()){
				$post = post();
				$ID = post('ID');
				unset($post['ID']);
				$update = $this->proposal->updateRecord($post, $ID);
				$this->api->cmd('reload');
			}else{
				$errors = validation_errors_array();
				$this->api->set_error($errors);
			}
			
		}else{
			$this->api->set_error('invalid_request', 'Invalid Request');
		}
		
		$this->api->out();
	}
	public function makefeatured(){
		if(post() && $this->input->is_ajax_request()){
			
			$ID = post('ID');
			$status = post('status');
			
			if($status==1){
				$featured_duration=get_setting('featured_duration');
				$featured_end_date=date('Y-m-d H:i:s',strtotime('+'.$featured_duration.' days'));
				$upd['data'] = array('proposal_featured' => 1,'featured_end_date'=>$featured_end_date);
			}else{
				$upd['data'] = array('proposal_featured' => 0,'featured_end_date'=>NULL);
			}
			
			$upd['where'] = array($this->data['primary_key'] => $ID);
			$upd['table'] = 'proposal_settings';
			update($upd);
			$this->api->cmd('reload');

		}else{
			$this->api->set_error('invalid_request', 'Invalid Request');
		}
		
		$this->api->out();
	}
	public function change_status(){
		if(post() && $this->input->is_ajax_request()){
			
			$ID = post('ID');
			$sts = post('status');
			$action_type = post('action_type');
			
			if(is_array($ID)){
				$this->db->where_in($this->data['primary_key'], $ID)->update($this->data['table'], array('proposal_status' => $sts));
			}else{
				$upd['data'] = array('proposal_status' => $sts,'admin_reason'=>'');
				$upd['where'] = array($this->data['primary_key'] => $ID);
				$upd['table'] = $this->data['table'];
				update($upd);
				
				$member_id=getField('proposal_seller_id','proposals','proposal_id',$ID);
				$RECEIVER_EMAIL=getField('member_email','member','member_id',$member_id);
				$SELLER_NAME=getField('member_name','member','member_id',$member_id);
				$data_parse=array(
				'SELLER_NAME'=>$SELLER_NAME,
				'PROPOSAL_URL'=>SITE_URL.'s/'.getField('proposal_url','proposals','proposal_id',$ID),
				);
				if($sts==PROPOSAL_ACTIVE){
					$template='proposal-approved-by-admin';
				}elseif($sts==PROPOSAL_MODIFICATION){
					$template='modification-request-by-admin';
				}elseif($sts==PROPOSAL_DECLINED){
					$template='proposal-declined-by-admin';
				}elseif($sts==PROPOSAL_PAUSED){
					$template='proposal-paused-by-admin';
				}
				SendMail($RECEIVER_EMAIL,$template,$data_parse);
			}
			
			$this->api->cmd('reload');
			
			/* if($action_type == 'multiple'){
				$this->api->cmd('reload');
			}else{
				
				$html = '';
				if($sts == ACTIVE_STATUS){
					$html = '<a href="'.JS_VOID.'"  data-toggle="tooltip" title="Make inactive" onclick="changeStatus(0, '.$ID.', this)"><span class="label label-success">Active</span></a>';
				}else{
					$html = '<a href="'.JS_VOID.'" data-toggle="tooltip" title="Make active"  onclick="changeStatus(1, '.$ID.', this)"><span class="label label-danger">Inactive</span></a>';
				}
			
			
				$this->api->data('html', $html);
				$this->api->cmd('replace');
			} */
			
			
		}else{
			$this->api->set_error('invalid_request', 'Invalid Request');
		}
		
		$this->api->out();
	}
	
	public function delete_record($id=''){
		$action_type = post('action_type');
		if($action_type == 'multiple'){
			$id = post('ID');
		}
		if($id){
			$this->test_three->deleteRecord($id);
			$cmd = get('cmd');
			if($cmd && $cmd == 'remove'){
				if($id && is_array($id)){
					$this->db->where_in($this->data['primary_key'] ,  $id)->delete($this->data['table']);
				}else{
					$this->db->where($this->data['primary_key'] ,  $id)->delete($this->data['table']);
				}
				
			}
			$this->api->cmd('reload');
		}else{
			$this->api->set_error('invalid_request', 'Invalid Request');
		}
		$this->api->out();
	}
	
	public function referral(){
		$srch = get();
		$curr_limit = get('per_page');
		$limit = !empty($curr_limit) ? $curr_limit : 0; 
		$offset = 20;
		$this->data['main_title'] = 'Proposal Referral Management';
		$this->data['second_title'] = 'All Proposal Referral List';
		$this->data['title'] = 'Proposal Referral';
		$breadcrumb = array(
			array(
				'name' => 'Proposal Referral',
				'path' => '',
			),
		);
		$this->data['breadcrumb'] = breadcrumb($breadcrumb);
		$this->data['list'] = $this->proposal->getReferralList($srch, $limit, $offset);
		$this->data['list_total'] = $this->proposal->getReferralList($srch, $limit, $offset, FALSE);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url($this->data['curr_controller'].'referral');
		$config['total_rows'] =$this->data['list_total'];
		$config['per_page'] = $offset;
		$config['page_query_string'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		
		$this->data['links'] = $this->pagination->create_links();
		$this->data['add_command'] = null;
		$this->data['edit_command'] = null;
		$this->layout->view('referral', $this->data);
       
	}
	public function edit_proposal($proposal_id=''){
		if(!$proposal_id){
			show_404(); return;
		}
		
		$this->data['details']=$this->proposal->getProposalDetails($proposal_id);
		
		$this->data['ID']= $proposal_id;
		$this->data['form_action'] = base_url($this->data['curr_controller'].'updateproposal');
		$this->load->model('category/category_model');
		$this->data['category'] = $this->category_model->get_all_category();
		$this->data['sub_category'] = $this->proposal->get_all_sub_category($this->data['details']['project_category']['category_id']);
		$this->data['all_delivery_times']= $this->proposal->getdeliverytimes();
		$this->data['main_title'] = 'Edit Proposal of ';
		$this->data['second_title'] = $this->data['details']['proposal_title'];
		$this->data['title'] = 'Edit Proposal';
		
		$breadcrumb = array(
			array(
				'name' => 'Proposal',
				'path' => base_url($this->data['curr_controller'].'list_record'),
			),
			array(
				'name' =>$this->data['details']['proposal_title'],
				'path' => '',
			),
		);
		
		$this->data['breadcrumb'] = breadcrumb($breadcrumb);
		//$this->data['list'] = $this->wallet->getTxnDetail($srch, $limit, $offset);
		
		
		$this->data['add_command'] = null;
		$this->data['edit_command'] = null;
		$this->layout->view('edit-proposal', $this->data);
       
	}
	public function uploadfiles(){
	
		$config['upload_path'] =LC_PATH."userupload/tempfile/";
		if($this->input->get('type') && $this->input->get('type')=='main'){
			$dataimg=$this->input->post("image",FALSE);
			$formatdata=explode(';base64,',$dataimg);
			
			$image = base64_decode($formatdata[1]);
			$image_name = md5(uniqid(rand(), true));
			$filename = $image_name . '.' . 'png';
			
			$path =$config['upload_path'];
			//$file_extension = pathinfo($name, PATHINFO_EXTENSION);
		
			file_put_contents($path . $filename, $image);
			if(file_exists($path . $filename)){
				$msg['status']='OK';
   				$msg['upload_response']=array('file_name'=>$filename,'original_name'=>$filename);
			}else{
				$msg['status']='FAIL';
			}
			
			
			
		}else{
			if($this->input->get('type') && $this->input->get('type')=='image'){
				$allowed = array('jpeg','jpg','gif','png');
				 $config['max_size']             = 1024*25;
			}elseif($this->input->get('type') && $this->input->get('type')=='video'){
				
				$allowed = array('mp4','mov','avi','flv','wmv');
				 $config['max_size']             = 1024*75;
			}else{ 
				 $msg['status']='FAIL';
				 echo json_encode($msg);
				die;
			}
        $config['allowed_types']        = implode('|',$allowed);
        $config['file_name']            = md5(uniqid(rand(), true).'-'.time());
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('fileinput'))
        {
            $msg['status']='FAIL';
            $msg['error']= $this->upload->display_errors();
        }
        else
        {
        	$msg['status']='OK';
        	$upload_data=$this->upload->data();
        	$msg['upload_response']=array('file_name'=>$upload_data['file_name'],'original_name'=>$upload_data['client_name']);
        }
        }
		echo json_encode($msg);
		
	}

	public function updateproposal(){
		$i=0;
		$msg=array();
		if($this->input->post()){
			$this->load->library('form_validation');
			$proposal_id=post('ID');
			$this->form_validation->set_rules('proposal_title', 'title', 'required|trim|min_length[15]|max_length[80]');
			$this->form_validation->set_rules('proposal_title_ar', 'title', 'required|trim|min_length[15]|max_length[80]');
			$this->form_validation->set_rules('proposal_description', 'description', 'required|trim|min_length[150]|max_length[1200]');
			$this->form_validation->set_rules('proposal_description_ar', 'description', 'required|trim|min_length[150]|max_length[1200]');
			$this->form_validation->set_rules('category_id', 'category', 'required|trim');
			if(post('category_id')>0){
				$this->form_validation->set_rules('category_subchild_id', 'sub category', 'required|trim');
			}
			$this->form_validation->set_rules('delivery_id', 'delivery time', 'required|trim');
			if($this->input->post('proposal_enable_referrals') && $this->input->post('proposal_enable_referrals')=='1'){
				$this->form_validation->set_rules('proposal_referral_money', 'commision', 'required|trim');
			}
			$this->form_validation->set_rules('proposal_tags', 'tag', 'required|trim');
			$this->form_validation->set_rules('proposal_tags_ar', 'tag', 'required|trim');
			if($this->input->post('mainimageprevious')){
				
			}else{
				$this->form_validation->set_rules('mainimage', 'image', 'required|trim');
			}
			$is_fixed=0;
			if($this->input->post('is_fixed') && $this->input->post('is_fixed')=='1'){
				$this->form_validation->set_rules('proposal_price', 'price', 'required|trim|numeric|greater_than[0]');
				$is_fixed=1;
			}else{
				$this->form_validation->set_rules('package_1', 'package', 'required|trim|numeric');
				$this->form_validation->set_rules('package_2', 'package', 'required|trim|numeric');
				$this->form_validation->set_rules('package_3', 'package', 'required|trim|numeric');
				$this->form_validation->set_rules('package_time_1','time', 'required|trim|numeric|greater_than[0]');
				$this->form_validation->set_rules('package_time_2','time', 'required|trim|numeric|greater_than[0]');
				$this->form_validation->set_rules('package_time_3','time', 'required|trim|numeric|greater_than[0]');
				$this->form_validation->set_rules('package_desc_1', 'description', 'required|trim|min_length[50]|max_length[1200]');
				$this->form_validation->set_rules('package_desc_2', 'description', 'required|trim|min_length[50]|max_length[1200]');
				$this->form_validation->set_rules('package_desc_3', 'description', 'required|trim|min_length[50]|max_length[1200]');
				$this->form_validation->set_rules('package_desc_1_ar',  'description', 'required|trim|min_length[50]|max_length[1200]');
				$this->form_validation->set_rules('package_desc_2_ar',  'description', 'required|trim|min_length[50]|max_length[1200]');
				$this->form_validation->set_rules('package_desc_3_ar',  'description', 'required|trim|min_length[50]|max_length[1200]');
				$this->form_validation->set_rules('package_price_1', 'price', 'required|trim|numeric|greater_than[0]');
				$this->form_validation->set_rules('package_price_2', 'price', 'required|trim|numeric|greater_than[0]');
				$this->form_validation->set_rules('package_price_3', 'price', 'required|trim|numeric|greater_than[0]');
			}
			$attribute_name=array();
			if($this->input->post('attribute_count')){
				$attribute_count=$this->input->post('attribute_count');
				$allattr=array_unique($attribute_count);
				foreach($allattr as $k=>$value){
					$attribute_name[]=$this->input->post('attribute_name_'.$value.'[0]');
					for($p=1;$p<=3;$p++){
					$this->form_validation->set_rules('attribute_value_'.$p.'_'.$value, 'attribute value', 'required|trim');
					
					}
				}			
			}
			if($this->form_validation->run()== FALSE){
				$errors = validation_errors_array();
				$this->api->set_error($errors);
				/*$error=$this->form_validation->error_array();
				 if($error){
					foreach($error as $key=>$val){
						$msg['status'] = 'FAIL';
						$msg['errors'][$i]['id'] = $key;
						$msg['errors'][$i]['message'] = $val;
						   $i++;
					}
				} */
			}
			else{
				if($i==0){
					$proposals=array(
						'proposal_title'=>strip_tags(post('proposal_title')),
						'proposal_title_ar'=>strip_tags(post('proposal_title_ar')),
						'delivery_time'=>post('delivery_id'),
						'proposal_date'=>date('Y-m-d H:i:s'),
						'proposal_status'=>PROPOSAL_PENDING,
						);
					
					$file_data=json_decode(post('mainimage'));
					if($file_data){
						if($file_data->file_name && file_exists(LC_PATH.'userupload/'."tempfile/".$file_data->file_name)){
							rename(LC_PATH.'userupload/'."tempfile/".$file_data->file_name, LC_PATH.'userupload/'."proposal-files/".$file_data->file_name);
							$proposals['proposal_image']=$file_data->file_name;
						}
					}else{
						$previousfile_data=json_decode(post('mainimageprevious'));
						if($previousfile_data){
							$proposals['proposal_image']=$previousfile_data->file_name;
						}
					}
					$this->db->where(array('proposal_id'=>$proposal_id))->update('proposals',$proposals);
					if($proposal_id){
						$this->db->where(array('proposal_id'=>$proposal_id))->delete('proposal_category');	
						$proposal_category=array(
						'proposal_id'=>$proposal_id,
						'category_id'=>post('category_id'),
						'category_subchild_id'=>post('category_subchild_id'),
						);
						$this->db->insert('proposal_category',$proposal_category);
						
						$this->db->where(array('proposal_id'=>$proposal_id))->delete('proposal_additional');
						$proposal_additional=array(
						'proposal_id'=>$proposal_id,
						'proposal_description'=>NULL,
						'buyer_instruction'=>'',
						'proposal_video'=>NULL,
						);
						if($this->input->post('proposal_description')){
							$proposal_additional['proposal_description']=htmlentities(post('proposal_description'));
						}
						if($this->input->post('proposal_description_ar')){
							$proposal_additional['proposal_description_ar']=htmlentities(post('proposal_description_ar'));
						}
						if($this->input->post('buyer_instruction')){
							$proposal_additional['buyer_instruction']=trim(strip_tags(post('buyer_instruction')));
						}
						if($this->input->post('buyer_instruction_ar')){
							$proposal_additional['buyer_instruction_ar']=trim(strip_tags(post('buyer_instruction_ar')));
						}
						if($this->input->post('projectvideo')){
							$file_data=json_decode(post('projectvideo'));
							if($file_data){
								if($file_data->file_name && file_exists(LC_PATH.'userupload/'."tempfile/".$file_data->file_name)){
									rename(LC_PATH.'userupload/'."tempfile/".$file_data->file_name, LC_PATH.'userupload/'."proposal-video/".$file_data->file_name);
									$proposal_additional['proposal_video']=$file_data->file_name;
								}
							}
						}elseif($this->input->post('videoprevious')){
							$file_data=json_decode(post('videoprevious'));
							if($file_data){
								if($file_data->file_name && file_exists(LC_PATH.'userupload/'."proposal-video/".$file_data->file_name)){
									$proposal_additional['proposal_video']=$file_data->file_name;
								}
							}
						}
						$this->db->insert('proposal_additional',$proposal_additional);
						$this->db->where(array('proposal_id'=>$proposal_id))->delete('proposal_tags');
						if($this->input->post('proposal_tags')){
							$proposal_tag=explode(',',post('proposal_tags'));
							foreach($proposal_tag as $tag){
								$proposal_tags=array(
								'proposal_id'=>$proposal_id,
								'tag_name'=>strip_tags($tag),
								'add_date'=>date('Y-m-d H:i:s'),
								'lang'=>'en'
								);
								$this->db->insert('proposal_tags',$proposal_tags);
							}
						}
						if($this->input->post('proposal_tags_ar')){
							$proposal_tag_ar=explode(',',post('proposal_tags_ar'));
							foreach($proposal_tag_ar as $tag){
								$proposal_tags_ar=array(
								'proposal_id'=>$proposal_id,
								'tag_name'=>strip_tags($tag),
								'add_date'=>date('Y-m-d H:i:s'),
								'lang'=>'ar'
								);
								$this->db->insert('proposal_tags',$proposal_tags_ar);
							}
						}
						$this->db->where(array('proposal_id'=>$proposal_id))->delete('proposal_settings');
						$proposal_settings=array(
							'proposal_id'=>$proposal_id,
							'proposal_referral_code'=>0,
							'proposal_enable_referrals'=>0,
							'proposal_referral_money'=>0,
							'proposal_featured'=>0,
						);
						if($this->input->post('proposal_enable_referrals') && $this->input->post('proposal_enable_referrals')=='1'){
							$proposal_settings['proposal_enable_referrals']=1;
							$proposal_settings['proposal_referral_code']=mt_rand();
							$proposal_settings['proposal_referral_money']=post('proposal_referral_money');
						}
						$this->db->insert('proposal_settings',$proposal_settings);
						$previous_file=array();
						if(post('projectfileprevious')){
							$projectfileprevious=post('projectfileprevious');
							foreach($projectfileprevious as $file){
								$file_data_p=json_decode($file);
								if($file_data_p){
									$previous_file[]=$file_data_p->file_id;
								}
							}
						}
						if($previous_file){
							$this->db->where_not_in('file_id',$previous_file)->where('proposal_id',$proposal_id)->delete('proposal_files');
						}else{
							$this->db->where('proposal_id',$proposal_id)->delete('proposal_files');
						}
						if(post('projectfile')){
							$projectfiles=post('projectfile');
							foreach($projectfiles as $file){
								$file_data=json_decode($file);
								if($file_data){
									if($file_data->file_name && file_exists(LC_PATH.'userupload/'."tempfile/".$file_data->file_name)){
										rename(LC_PATH.'userupload/'."tempfile/".$file_data->file_name, LC_PATH.'userupload/'."proposal-files/".$file_data->file_name);
										$ext=explode('.',$file_data->file_name);
										$files=array(
										'original_name'=>$file_data->original_name,
										'server_name'=>$file_data->file_name,
										'upload_time'=>date('Y-m-d H:i:s'),
										'file_ext'=>strtolower(end($ext)),
										);
										$this->db->insert('files',$files);
										$file_id=$this->db->insert_id();
										if($file_id){
											$proposal_files=array(
											'proposal_id'=>$proposal_id,
											'file_id'=>$file_id,
											);
											$this->db->insert('proposal_files',$proposal_files);
										}
									}
								}
							}
						}
						if($is_fixed==1){
							$this->db->where(array('proposal_id'=>$proposal_id))->update('proposals',array('proposal_price'=>post('proposal_price'),'display_price'=>post('proposal_price')));
						}else{
							$packageIDONE=$package_id=post('package_1');
							$this->db->where(array('proposal_id'=>$proposal_id,'package_id'=>$package_id))->update('proposal_packages',array('description'=>post('package_desc_1'),'description_ar'=>post('package_desc_1_ar'),'delivery_time'=>post('package_time_1'),'price'=>post('package_price_1')));
							
							$packageIDTWO=$package_id=post('package_2');
							$this->db->where(array('proposal_id'=>$proposal_id,'package_id'=>$package_id))->update('proposal_packages',array('description'=>post('package_desc_2'),'description_ar'=>post('package_desc_2_ar'),'delivery_time'=>post('package_time_2'),'price'=>post('package_price_2')));
							
							$packageIDTHREE=$package_id=post('package_3');
							$this->db->where(array('proposal_id'=>$proposal_id,'package_id'=>$package_id))->update('proposal_packages',array('description'=>post('package_desc_3'),'description_ar'=>post('package_desc_3_ar'),'delivery_time'=>post('package_time_3'),'price'=>post('package_price_3')));
							
							$display_price=0;
							$this->db->select('p.price')
							->from('proposal_packages p');
							$this->db->where(array('p.proposal_id'=>$proposal_id,'p.price >'=>0));
							$this->db->order_by('price','asc');
							$check_proposal_price=$this->db->get()->row();
							if($check_proposal_price){
								$display_price=$check_proposal_price->price;
							}
							
							$this->db->where(array('proposal_id'=>$proposal_id))->update('proposals',array('display_price'=>$display_price,'proposal_price'=>0));	
						}
						if($attribute_name){
							$this->db->where_not_in('attribute_name',$attribute_name)->where('proposal_id',$proposal_id)->delete('proposal_package_attributes');
						}else{
							$this->db->where('proposal_id',$proposal_id)->delete('proposal_package_attributes');
						}
						if($is_fixed!=1){
							if($attribute_name){
								foreach($allattr as $k=>$value){
									$attribute_name=$this->input->post('attribute_name_'.$value.'[0]');
									for($p=1;$p<=3;$p++){
										if($p==1){
											$package_id=$packageIDONE;
										}elseif($p==2){
											$package_id=$packageIDTWO;
										}elseif($p==3){
											$package_id=$packageIDTHREE;
										}
										$insdata=array('attribute_name'=>$attribute_name,'attribute_value'=>post('attribute_value_'.$p.'_'.$value),'package_id'=>$package_id,'proposal_id'=>$proposal_id);
										$check=$this->db->where(array('attribute_name'=>$attribute_name,'package_id'=>$package_id,'proposal_id'=>$proposal_id))->from('proposal_package_attributes')->count_all_results();
										if($check){
											$this->db->where(array('attribute_name'=>$attribute_name,'package_id'=>$package_id,'proposal_id'=>$proposal_id))->update('proposal_package_attributes',$insdata);
										}else{
											$this->db->insert('proposal_package_attributes',$insdata);
										}
									}
								}
							}
						}
						set_flash('succ_msg','Update successfull');
						$this->api->cmd('reload');
					}else{
						$this->api->set_error('invalid_request', 'Invalid Request');
					}	
				}
			}
		}
		$this->api->out();
	}

}





