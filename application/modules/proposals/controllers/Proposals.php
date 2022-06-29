<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposals extends MX_Controller {
	private $data;
	function __construct()
	{
		$this->loggedUser=$this->session->userdata('loggedUser');
		$this->access_member_type='F';
		if($this->loggedUser){
			$this->access_member_id=$this->loggedUser['LID'];	
			$this->access_member_type=$this->loggedUser['ACC_P_TYP'];
			$this->member_id=$this->loggedUser['MID'];
			$this->organization_id=$this->loggedUser['OID'];
		}elseif(in_array($this->router->fetch_method(),array('gigs','details','savecheckoutCheckAjax'))){

		}else{
			if($this->router->fetch_method()=='checkout'){
				redirect(URL::get_link('loginURL').'?ref=checkoutURL');
			}else{
				redirect(URL::get_link('loginURL').'?ref=postproposalURL');
			}
			
		}	
		$this->load->model('proposals_model');
		$this->data['curr_class'] = $this->router->fetch_class();
		$this->data['curr_method'] = $this->router->fetch_method();
		$this->lang = get_active_lang();
		//print_r($this->loggedUser);
		parent::__construct();
	}
	public function index()
	{
		redirect(get_link('postproposalURL'));
	}
	public function add()
	{
		if($this->access_member_type=='C'){
			redirect(get_link('dashboardURL'));
		}
		$this->layout->set_js(array(
				'utils/helper.js',
				'mycustom.js',
				'bootstrap-tagsinput.min.js',
				'typeahead.bundle.min.js',
				'upload-drag-file.js',
				'summernote.js',
			));
		$this->layout->set_css(array(
				'bootstrap-tagsinput.css',
				'summernote.css'
			));
		if($this->loggedUser){
			$member_id=$this->member_id;	
			$memberData=getData(array(
				'select'=>'m.member_name,m.member_email',
				'table'=>'member as m',
				'where'=>array('m.member_id'=>$member_id),
				'single_row'=>true,
			));	
			if($memberData){
				$this->data['proposalData']=array();
				$this->data['itemid']='';
				$this->data['all_category']=getAllCategory();
				$this->data['all_skills']=getAllSkills();
				//$this->data['left_panel']=load_view('inc/client-setting-left','',TRUE);
				$this->layout->view('post-proposal', $this->data);
			}
		}	
		//echo md5(1).'-'.md5('UPW'.'-'.date("Y-m-d").'-'.md5(1));
	}
	public function edit($md5id='',$token='')
	{
		//http://localhost:7777/localfreelancers/proposals/edit/c4ca4238a0b923820dcc509a6f75849b/d4749571d6c5a392cd2f8dbb10bee6a8

		if($this->access_member_type=='C'){
			redirect(get_link('dashboardURL'));
		}
		$this->data['itemid']=$md5id;	
		$verify_token=md5('UPW'.'-'.date("Y-m-d").'-'.$md5id);
		$this->layout->set_js(array(
			'utils/helper.js',
			'mycustom.js',
			'bootstrap-tagsinput.min.js',
			'typeahead.bundle.min.js',
			'upload-drag-file.js',
			'summernote.js',
		));
		$this->layout->set_css(array(
			'bootstrap-tagsinput.css',
			'summernote.css'
		));
			
				
		if($this->loggedUser){
			$member_id=$this->member_id;	
			if($verify_token==$token){	
				$arr=array(
					'select'=>'p.proposal_id,p.proposal_url,p.proposal_title,p.proposal_status',
					'table'=>'proposals as p',
					'where'=>array('p.proposal_status <>'=>PROPOSAL_DELETED,'p.proposal_seller_id'=>$member_id),
					'single_row'=>true,
					);
				$arr['where']['md5(p.proposal_id)']=$md5id;
				$ProjectDataBasic=getData($arr);
				if($ProjectDataBasic){
					$proposal_id=$ProjectDataBasic->proposal_id;
					$this->data['proposalData']=getGigDetails($proposal_id);
				}else{
					redirect(get_link('dashboardURL'));
				}
			}else{
				redirect(get_link('dashboardURL'));
			}
			
			$memberData=getData(array(
				'select'=>'m.member_name,m.member_email',
				'table'=>'member as m',
				'where'=>array('m.member_id'=>$member_id),
				'single_row'=>true,
			));	
			if($memberData){
				$this->data['all_category']=getAllCategory();
				$this->data['all_skills']=getAllSkills();
				//$this->data['left_panel']=load_view('inc/client-setting-left','',TRUE);
				$this->layout->view('post-proposal', $this->data);
			}
		}	
	}
	public function uploadattachment(){
		if($this->loggedUser){
		$config['upload_path']          = TMP_UPLOAD_PATH;
		if($this->input->get('type') && $this->input->get('type')=='image'){
			$file_input='file';
			$allowed = array('jpeg','jpg','gif','png');
			 $config['max_size']             = 1024*25;
		}elseif($this->input->get('type') && $this->input->get('type')=='video'){
			$file_input='fileinput';
			$allowed = array('mp4','mov','avi','flv','wmv');
			 $config['max_size']             = 1024*75;
		}else{ 
			 $msg['status']='FAIL';
			 echo json_encode($msg);
			die;
		}
        $config['file_name']            = md5($this->member_id.'-'.time());
		$config['allowed_types']        = implode('|',$allowed);
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload($file_input))
        {
            $msg['status']='FAIL';
            $msg['error']= $this->upload->display_errors();
        }
        else
        {
        	$msg['status']='OK';
        	$upload_data=$this->upload->data();

			$imgConfig = array();
			$imgConfig['image_library']    = 'gd2';
			$imgConfig['source_image']     =$upload_data["full_path"];
			$imgConfig['new_image']        = 'thumb_'.$upload_data['file_name'];
			$imgConfig['maintain_ratio']   = FALSE;
			$imgConfig['width']            = 305;
			$imgConfig['height']           = 202;
			$this->load->library('image_lib', $imgConfig);
			$this->image_lib->initialize($imgConfig);
			if($this->image_lib->resize()){
				//rename(TMP_UPLOAD_PATH.$imgConfig['new_image'], UPLOAD_PATH."member_logo/".$imgConfig['new_image']); 
			}
        	$msg['upload_response']=array('file_name'=>$upload_data['file_name'],'original_name'=>$upload_data['client_name']);
        }
		echo json_encode($msg);
		}
	}
	public function capturevideo(){
		checkrequestajax();
		$video=post('video');
		if($video){
			$json=json_decode($video);
			//print_r($json);
			if($json->file_name && file_exists(TMP_UPLOAD_PATH.$json->file_name)){
				$this->data['video']=$json;
				$this->data['path']=TMP_UPLOAD_HTTP_PATH.$json->file_name;
				$this->layout->view('ajax-capture-video', $this->data,TRUE);
			}else{
				show_404();
			}
			
		}else{
			show_404();
		}

	}
	public function post_proposal_form_check($step=""){
		$this->load->library('form_validation');
		checkrequestajax();
		if($this->access_member_type=='C'){
			redirect(get_link('dashboardURL'));
		}
		$i=0;
		$proposal_id=0;
		$is_edited=0;
		$msg=array();
		if($this->loggedUser){
		$member_id=$this->member_id;	
		$organization_id=$this->organization_id;
		if($member_id){
			if($this->input->post()){
				$dataid=post('dataid');
				if($dataid){
					if($member_id){
						$arr=array(
							'select'=>'p.proposal_id',
							'table'=>'proposals as p',
							'where'=>array('p.proposal_status <>'=>PROPOSAL_DELETED),
							'single_row'=>true,
							);
						$arr['where']['md5(p.proposal_id)']=$dataid;
						$arr['where']['p.proposal_seller_id']=$member_id;
						$ProjectDataBasic=getData($arr);
						if($ProjectDataBasic){
							$proposal_id=$ProjectDataBasic->proposal_id;
							$is_edited=1;
						}else{
							show_404();
						}
					}else{
						show_404();
					}
				}

				if($step=='1' || $step=='6')
				{
					$this->form_validation->set_rules('title', 'Title', 'required|trim|xss_clean');
					$this->form_validation->set_rules('category', 'Category', 'required|trim|xss_clean|is_natural_no_zero');
					$this->form_validation->set_rules('sub_category', 'Speciality', 'required|trim|xss_clean|is_natural_no_zero');
					//$this->form_validation->set_rules('skills', 'tags', 'required|trim|xss_clean');
					if ($this->form_validation->run() == FALSE){
						$error=validation_errors_array();
						if($error){
							foreach($error as $key=>$val){
								$msg['status'] = 'FAIL';
				    			$msg['errors'][$i]['id'] = $key;
								$msg['errors'][$i]['message'] = $val;
				   				$i++;
							}
						}
					}
					if($i==0){
						$up=1;
						if($up){
							$msg['status'] = 'OK';
							$msg['preview_data'] = 'title';
						}else{
							$msg['status'] = 'FAIL';
							$msg['errors'][$i]['id'] = 'title';
							$msg['errors'][$i]['message'] = 'Invalid ';
							$i++;
						}
					}
				}
				if($step=='2' || $step=='6')
				{
					$this->form_validation->set_rules('proposalPaymentType', 'pay type', 'required|trim|xss_clean|in_list[fixed,package]');
					if(post('proposalPaymentType') && ( post('proposalPaymentType')=='fixed' || post('proposalPaymentType')=='package')){
						$this->form_validation->set_rules('package_name_basic',  __('proposals_form_name','name'), 'required|trim|max_length[150]');
						$this->form_validation->set_rules('package_desc_basic',  __('proposals_form_description','description'), 'required|trim|max_length[1200]');
						$this->form_validation->set_rules('package_time_basic',  __('proposals_form_time','time'), 'required|trim|numeric|greater_than[0]');
						$this->form_validation->set_rules('package_price_basic',  __('proposals_form_price','price'), 'required|trim|numeric|greater_than[0]');
					}
					if(post('proposalPaymentType') && post('proposalPaymentType')=='package'){
						$this->form_validation->set_rules('package_name_standard',  __('proposals_form_name','name'), 'required|trim|max_length[150]');
						$this->form_validation->set_rules('package_desc_standard',  __('proposals_form_description','description'), 'required|trim|max_length[1200]');
						$this->form_validation->set_rules('package_time_standard',  __('proposals_form_time','time'), 'required|trim|numeric|greater_than[0]');
						$this->form_validation->set_rules('package_price_standard',  __('proposals_form_price','price'), 'required|trim|numeric|greater_than[0]');

						$this->form_validation->set_rules('package_name_premium',  __('proposals_form_name','name'), 'required|trim|max_length[150]');
						$this->form_validation->set_rules('package_desc_premium',  __('proposals_form_description','description'), 'required|trim|max_length[1200]');
						$this->form_validation->set_rules('package_time_premium',  __('proposals_form_time','time'), 'required|trim|numeric|greater_than[0]');
						$this->form_validation->set_rules('package_price_premium',  __('proposals_form_price','price'), 'required|trim|numeric|greater_than[0]');
					}
					if ($this->form_validation->run() == FALSE){
						$error=validation_errors_array();
						if($error){
							foreach($error as $key=>$val){
								$msg['status'] = 'FAIL';
				    			$msg['errors'][$i]['id'] = $key;
								$msg['errors'][$i]['message'] = $val;
				   				$i++;
							}
						}
					}
					if($i==0){
						$up=1;
						if($up){
							$msg['status'] = 'OK';
							$msg['preview_data'] = 'budget';
						}else{
							$msg['status'] = 'FAIL';
							$msg['errors'][$i]['id'] = 'title';
							$msg['errors'][$i]['message'] = 'Invalid ';
							$i++;
						}
					}
				}
				if($step=='3' || $step=='6')
				{
					$this->form_validation->set_rules('description', 'Description', 'required|trim|xss_clean');
					if ($this->form_validation->run() == FALSE){
						$error=validation_errors_array();
						if($error){
							foreach($error as $key=>$val){
								$msg['status'] = 'FAIL';
				    			$msg['errors'][$i]['id'] = $key;
								$msg['errors'][$i]['message'] = $val;
				   				$i++;
							}
						}
					}
					if($i==0){
						$up=1;
						if($up){
							$msg['status'] = 'OK';
							$msg['preview_data'] = 'description';
						}else{
							$msg['status'] = 'FAIL';
							$msg['errors'][$i]['id'] = 'title';
							$msg['errors'][$i]['message'] = 'Invalid ';
							$i++;
						}
					}
				}
				if($step=='4' || $step=='6')
				{
					//$this->form_validation->set_rules('proposalType', 'Project Type', 'required|trim|xss_clean');
					if ($this->form_validation->run() == FALSE){
						$error=validation_errors_array();
						if($error){
							foreach($error as $key=>$val){
								$msg['status'] = 'FAIL';
				    			$msg['errors'][$i]['id'] = $key;
								$msg['errors'][$i]['message'] = $val;
				   				$i++;
							}
						}
					}
					if($i==0){
						$up=1;
						if($up){
							$msg['status'] = 'OK';
							$msg['preview_data'] = 'details';
						}else{
							$msg['status'] = 'FAIL';
							$msg['errors'][$i]['id'] = 'title';
							$msg['errors'][$i]['message'] = 'Invalid ';
							$i++;
						}
					}
				}
				if($step=='5' || $step=='6')
				{
					
					if($is_edited){
						if(!post('proposalfileprevious') && !post('proposalfile')){
							$this->form_validation->set_rules('proposalfile[]', 'image', 'required|trim');
						}
					}else{
						$this->form_validation->set_rules('proposalfile[]', 'image', 'required|trim');
					}
					
					if((post('proposalvideo') && post('proposalvideo')!='') || post('proposalvideoprevious')){
						$this->form_validation->set_rules('videothumb', 'thumb', 'required|trim');
					}
					if ($this->form_validation->run() == FALSE){
						$error=validation_errors_array();
						if($error){
							foreach($error as $key=>$val){
								$msg['status'] = 'FAIL';
				    			$msg['errors'][$i]['id'] = ($key=='proposalfile[]' ? 'proposalfile':$key);
								$msg['errors'][$i]['message'] = $val;
				   				$i++;
							}
						}
					}
					if($i==0){
						$up=1;
						if($up){
							$msg['status'] = 'OK';
							$msg['preview_data'] = 'visibility';
						}else{
							$msg['status'] = 'FAIL';
							$msg['errors'][$i]['id'] = 'title';
							$msg['errors'][$i]['message'] = 'Invalid ';
							$i++;
						}
					}
				}
				
				if($step=='6' && $i==0)
				{
					/*$chk=array(
						'select'=>'p.proposal_id',
						'table'=>'proposal as p',
						'join'=>array(array('table'=>'proposal_owner as p_o','on'=>'p.proposal_id=p_o.proposal_id','position'=>'left')),
						'where'=>array('p.proposal_id'=>$dataid),
						'single_row'=>true,
					)
					$chk['where']['p_o.organization_id']=$organization_id;
					$memberDatacount=getData($chk);;*/
					$proposal_url=generateProposalSlug(post('title'));
					$proposal=array(
					'proposal_title'=>post('title'),
					'proposal_short_info'=>substr(strip_tags(post('description')),0,150),
					'proposal_date'=>date('Y-m-d H:i:s'),
					'proposal_status'=>PROPOSAL_ACTIVE,
					'posted_lang'=>$this->lang,
					'proposal_url'=>$proposal_url,
					);
					
					if($is_edited){
						unset($proposal['proposal_url']);
						updateTable('proposals',$proposal,array('proposal_id'=>$proposal_id));
					}else{
						$proposal['proposal_seller_id']=$member_id;
						$proposal_id=insert_record('proposals',$proposal,TRUE);
					}
					if($proposal_id){
						/* if($is_edited){}else{
							$proposal_owner=array(
							'proposal_id'=>$proposal_id,
							'member_id'=>$member_id,
							'organization_id'=>$organization_id,
							);
							insert_record('proposal_owner',$proposal_owner);
						} */
						$proposal_category=array(
						'proposal_id'=>$proposal_id,
						'category_id'=>post('category'),
						'category_subchild_id'=>post('sub_category'),
						);
						if($is_edited){
							unset($proposal_category['proposal_id']);
							updateTable('proposal_category',$proposal_category,array('proposal_id'=>$proposal_id));
						}else{
							insert_record('proposal_category',$proposal_category);
						}
						if(post('skills')){
							$all_skill=post('skills');
							updateTable('proposal_skills',array('proposal_skill_status'=>0),array('proposal_id'=>$proposal_id));
							if($all_skill){
								$sk=explode(',',$all_skill);
								foreach($sk as $ord=>$skill_id){
									$skillDatacount=getData(array(
										'select'=>'p_s.proposal_skill_id',
										'table'=>'proposals as p',
										'join'=>array(array('table'=>'proposal_skills as p_s','on'=>'p.proposal_id=p_s.proposal_id','position'=>'left')),
										'where'=>array('p.proposal_id'=>$proposal_id,'p_s.skill_id'=>$skill_id),
										'single_row'=>true,
									));
									if($skillDatacount){
										updateTable('proposal_skills',array('proposal_skill_status'=>1),array('proposal_skill_id'=>$skillDatacount->proposal_skill_id));
									}else{
										insert_record('proposal_skills',array('proposal_id'=>$proposal_id,'skill_id'=>$skill_id,'proposal_skill_status'=>1),TRUE);
									}
								}
							}
						}
						$proposal_additional=array(
						'proposal_id'=>$proposal_id,
						'proposal_description'=>post('description'),
						'buyer_instruction'=>NULL,
						);
						if($this->input->post('requirement')){
							$proposal_additional['buyer_instruction']=trim(strip_tags(post('requirement')));
						}
						if($is_edited){
							unset($proposal_additional['proposal_id']);
							updateTable('proposal_additional',$proposal_additional,array('proposal_id'=>$proposal_id));
						}else{
							insert_record('proposal_additional',$proposal_additional);
						}

						
						if($is_edited==1){
							$previous_file=array();
							if(post('proposalfileprevious')){
								$proposalfileprevious=post('proposalfileprevious');
								foreach($proposalfileprevious as $file){
									$file_data_p=json_decode($file);
									if($file_data_p){
										$previous_file[]=$file_data_p->file_id;
										$is_primary=0;
										$file_order[]=array('file_id'=>$file_data_p->file_id);
									}
								}
							}
							if($previous_file){
								$this->db->where_not_in('proposal_file_id',$previous_file)->where('proposal_id',$proposal_id)->delete('proposal_files');
							}else{
								$this->db->where('proposal_id',$proposal_id)->delete('proposal_files');
							}
						}
						if(post('proposalfile')){
							$proposalfiles=post('proposalfile');
							foreach($proposalfiles as $file){
								$file_data=json_decode($file);
								if($file_data){
									if($file_data->file_name && file_exists(TMP_UPLOAD_PATH.$file_data->file_name)){
										rename(TMP_UPLOAD_PATH.$file_data->file_name, UPLOAD_PATH."proposals-files/proposals-images/".$file_data->file_name);
							
										$ext=explode('.',$file_data->file_name);
										$proposal_files=array(
										'proposal_id'=>$proposal_id,
										'original_name'=>$file_data->original_name,
										'server_name'=>$file_data->file_name,
										'upload_time'=>date('Y-m-d H:i:s'),
										'file_ext'=>strtolower(end($ext)),
										'is_video'=>0,
										'image_thumb'=>NULL,
										);
										if(file_exists(TMP_UPLOAD_PATH.'thumb_'.$file_data->file_name)){
											rename(TMP_UPLOAD_PATH.'thumb_'.$file_data->file_name, UPLOAD_PATH."proposals-files/proposals-thumb/".'thumb_'.$file_data->file_name);
											$proposal_files['image_thumb']='thumb_'.$file_data->file_name;
										}
										$this->db->insert('proposal_files',$proposal_files);
									}
								}
							}
						}
						$proposal_image=NULL;
						$arr=array(
							'select'=>'p.image_thumb',
							'table'=>'proposal_files p',
							'where'=>array('p.proposal_id'=>$proposal_id,'p.is_video'=>0,'p.image_thumb <>'=>NULL),
							'single_row'=>true,
							'order'=>array(array('p.proposal_file_id','asc'))
						);
						$check_proposal_files=getData($arr);
						if($check_proposal_files){
							$proposal_image=$check_proposal_files->image_thumb;
						}
						updateTable('proposals',array('proposal_image'=>$proposal_image),array('proposal_id'=>$proposal_id));	

						if($this->input->post('proposalvideo')){
							$file_data=json_decode(post('proposalvideo'));
							if($file_data){
								if($file_data->file_name && file_exists(TMP_UPLOAD_PATH.$file_data->file_name)){
									rename(TMP_UPLOAD_PATH.$file_data->file_name, UPLOAD_PATH."proposals-files/proposals-video/".$file_data->file_name);

									$ext=explode('.',$file_data->file_name);
									$proposal_files=array(
									'proposal_id'=>$proposal_id,
									'original_name'=>$file_data->original_name,
									'server_name'=>$file_data->file_name,
									'upload_time'=>date('Y-m-d H:i:s'),
									'file_ext'=>strtolower(end($ext)),
									'is_video'=>1,
									'image_thumb'=>NULL,
									);
									$this->db->insert('proposal_files',$proposal_files);
								}
							}
						}

						$videothumb=post('videothumb');
						if($videothumb){
							$image_thumb='';
							$file_data=json_decode($videothumb);
							if($file_data){
								if(array_key_exists('is_previous',$file_data)){
									$image_thumb=$file_data->file_name;
								}else{
									if($file_data->file_name && file_exists(TMP_UPLOAD_PATH.$file_data->file_name)){
										rename(TMP_UPLOAD_PATH.$file_data->file_name, UPLOAD_PATH."proposals-files/proposals-images/".$file_data->file_name);
										rename(TMP_UPLOAD_PATH.'thumb_'.$file_data->file_name, UPLOAD_PATH."proposals-files/proposals-thumb/".'thumb_'.$file_data->file_name);
										$image_thumb=$file_data->file_name;
									}
								}
							}
							if($image_thumb){
								$this->db->where(array('proposal_id'=>$proposal_id,'is_video'=>1))->update('proposal_files',array('image_thumb'=>$image_thumb));
							}
						}
						
						$this->db->where('proposal_id',$proposal_id)->delete('proposal_question');
						if(post('question')){
							$proposalquestion=post('question');
							$proposalanswer=post('answer');
							foreach($proposalquestion as $q=>$question){
								if(trim($question)!=''){
									$proposal_question=array(
										'proposal_id'=>$proposal_id,
										'proposal_question'=>$question,
										'proposal_answer'=>NULL,
									);
									if(!empty($proposalanswer[$q])){
										$proposal_question['proposal_answer']=$proposalanswer[$q];
									}
									insert_record('proposal_question',$proposal_question);
								}
							}
						}
						$this->db->where('proposal_id', $proposal_id)->delete('proposal_stat');
						$proposal_stat=array(
							'proposal_id'=>$proposal_id,
							'proposal_rating'=>0,
							'proposal_views'=>0,
						);
						$this->db->insert('proposal_stat',$proposal_stat);

						$proposalPaymentType=$this->input->post('proposalPaymentType');


						$this->db->where('proposal_id', $proposal_id)->delete('proposal_packages');
						$proposal_packages=array(
							'package_id'=>$proposal_id.'-1-'.time(),
							'proposal_id'=>$proposal_id,
							'package_name'=>post('package_name_basic'),
							'price'=>post('package_price_basic'),
							'delivery_time'=>post('package_time_basic'),
							'description'=>post('package_desc_basic'),
							'package_type'=>'B'
						);
						$this->db->insert('proposal_packages',$proposal_packages);
						$is_package=0;
						if($proposalPaymentType=='package'){
							$is_package=1;
							$proposal_packages=array(
								'package_id'=>$proposal_id.'-2-'.time(),
								'proposal_id'=>$proposal_id,
								'package_name'=>post('package_name_standard'),
								'price'=>post('package_price_standard'),
								'delivery_time'=>post('package_time_standard'),
								'description'=>post('package_desc_standard'),
								'package_type'=>'S'
							);
							$this->db->insert('proposal_packages',$proposal_packages);

							$proposal_packages=array(
								'package_id'=>$proposal_id.'-3-'.time(),
								'proposal_id'=>$proposal_id,
								'package_name'=>post('package_name_premium'),
								'price'=>post('package_price_premium'),
								'delivery_time'=>post('package_time_premium'),
								'description'=>post('package_desc_premium'),
								'package_type'=>'P'
							);
							$this->db->insert('proposal_packages',$proposal_packages);
						}
						$display_price=0;
						$arr=array(
							'select'=>'p.price',
							'table'=>'proposal_packages p',
							'where'=>array('p.proposal_id'=>$proposal_id,'p.price >'=>0),
							'single_row'=>true,
							'order'=>array(array('price','asc'))
						);
						$check_proposal_price=getData($arr);
						if($check_proposal_price){
							$display_price=$check_proposal_price->price;
						}
						updateTable('proposals',array('display_price'=>$display_price),array('proposal_id'=>$proposal_id));	


						
						$proposal_settings=array(
						'proposal_id'=>$proposal_id,
						'proposal_featured'=>0,
						'featured_end_date'=>NULL,
						'is_package'=>$is_package
						);
						if($is_edited==1){
							unset($proposal_settings['proposal_id']);
							updateTable('proposal_settings',$proposal_settings,array('proposal_id'=>$proposal_id));
						}else{
							insert_record('proposal_settings',$proposal_settings);	
						}
						
						
						$data_parse = array(
							'TITLE' => post('title')
						);
						/* if($is_edited==1){
							
						}else{
						$this->admin_notification_model->parse('admin-ad-post', $data_parse, 'proposal/list_record?ID='.$proposal_id);
						SendMail(get_setting('admin_email'),'admin-ad-post',$data_parse);
						} */
						$msg['status'] = 'OK';
						$msg['preview_data'] = 'proposal';
						$msg['proposal_id'] =$proposal_id;
						
						
					//print_r($proposal);
					//print_r($proposal_owner);
					//print_r($proposal_category);	
					//print_r($proposal_additional);	
					//print_r($proposal_files);	
					//print_r($files);
					//print_r($question);
					//print_r($proposal_question);
					//print_r($proposal_settings);
						
					}else{
						$msg['status'] = 'FAIL';
						$msg['errors'][$i]['id'] = 'proposal';
						$msg['errors'][$i]['message'] = 'Invalid ';
						$i++;
					}
				}
				
				
				}
			}else{
				$msg['status'] = 'FAIL';
				$msg['errors'][$i]['id'] = 'error';
				$msg['errors'][$i]['message'] = 'Invalid ';
				$i++;
			}
		unset($_POST);
		echo json_encode($msg);
		}
	}
	public function success($proposal_id=''){
		if($this->access_member_type=='C'){
			redirect(get_link('dashboardURL'));
		}
		$arr=array(
			'select'=>'p.proposal_id,p.proposal_url',
			'table'=>'proposals as p',
			'where'=>array('p.proposal_status <>'=>PROPOSAL_DELETED,'p.proposal_seller_id'=>$this->member_id),
			'single_row'=>true,
		);
		$arr['where']['p.proposal_id']=$proposal_id;
		$ProjectDataBasic=getData($arr);
		if($ProjectDataBasic){
			$this->data['edit_url']=get_link('editproposalURL').'/'.md5($ProjectDataBasic->proposal_id).'/'.md5('UPW'.'-'.date("Y-m-d").'-'.md5($ProjectDataBasic->proposal_id));
			$this->data['details_url']=get_link('myProposalDetailsURL').'/'.$ProjectDataBasic->proposal_url;
		}else{
			show_404();
		}
		$this->layout->view('post-success', $this->data);
	}
	public function savecaptureimage(){
		$msg=array();
		$videothumb=$this->input->post('videothumb',false);
		if($videothumb){
			$formatdata=explode(';base64,',$videothumb);
			$image = base64_decode($formatdata[1]);
			$image_name = md5($this->member_id.'_'.time());
			$filename = $image_name . '.' . 'png';

			$path =TMP_UPLOAD_PATH;
			file_put_contents($path . $filename, $image);
			$imgConfig = array();
			$imgConfig['image_library']    = 'gd2';
			$imgConfig['source_image']     =$path.$filename;
			$imgConfig['new_image']        = 'thumb_'.$image_name . '.' . 'png';
			$imgConfig['maintain_ratio']   = FALSE;
			$imgConfig['width']            = 305;
			$imgConfig['height']           = 202;
			$this->load->library('image_lib', $imgConfig);
			$this->image_lib->initialize($imgConfig);
			if($this->image_lib->resize()){
				$msg['upload_response']=array('file_name'=>$filename,'original_name'=>$filename,'thumb'=>TMP_UPLOAD_HTTP_PATH.$imgConfig['new_image']);
			}
			$proposal_files['image_thumb']=$filename;
			$msg['status']='OK';
		}
		unset($_POST);
		echo json_encode($msg);
	}

	public function manage(){
		if($this->access_member_type=='F'){
			$this->data['left_panel']=$this->layout->view('inc/freelancer-setting-left',$this->data,TRUE,TRUE);
		}else{
			$this->data['left_panel']=$this->layout->view('inc/client-setting-left',$this->data,TRUE,TRUE);
		}
        $this->load->library('pagination');
      
        $this->data['srch_url'] = uri_string();
        $this->data['srch_param'] = $this->data['srch_string'] = $this->input->get();

        $this->data['offset'] = 10;
        $this->data['limit'] = !empty($this->data['srch_param']['per_page']) ? $this->data['srch_param']['per_page'] : 0;
        $this->data['srch_string'] = !empty($this->data['srch_string']) ? $this->data['srch_string'] : array();
        $this->data['srch_param']['member_id'] =$this->member_id;
        unset($this->data['srch_string']['per_page']);
        unset($this->data['srch_string']['total']);
 
    
        $this->data['proposals'] = $this->proposals_model->manage_proposal($this->data['srch_param'] , $this->data['limit'] , $this->data['offset']);
        $this->data['total_proposals'] = $this->proposals_model->manage_proposal($this->data['srch_param'] , $this->data['limit'] , $this->data['offset'] , FALSE);
        
       
    
        $config['base_url'] = base_url('proposals/manage?total=10');
            
        $config['base_url'] .= !empty($this->data['srch_string']) ? '&'.http_build_query($this->data['srch_string']) : '';
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->data['total_proposals'];
        $config['per_page'] = $this->data['offset'];
        
        $config['full_tag_open'] = '<div class="pagination-container margin-top-60 margin-bottom-60"><nav class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></nav></div>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="waves-effect">';
		$config['first_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="waves-effect">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li><a class='current-page' href='javascript:void(0)'>";
		$config['cur_tag_close'] = '</a></li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = "<li class='last waves-effect'>";
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '<i class="icon-material-outline-keyboard-arrow-right"></i>';
		$config['next_tag_open'] = '<li class="waves-effect">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="icon-material-outline-keyboard-arrow-left"></i>';
		$config['prev_tag_open'] = '<li class="waves-effect">';
		$config['prev_tag_close'] = '</li>';  

        $this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();
		$this->layout->view('manage-gigs', $this->data);
    }
	public function actionproposal(){
        check_user_log();
		$msg=array();
		$all_action=array('pause','delete','active');
		//checkrequestajax();
		if($this->input->post('rid') && $this->input->post('action')){
			$action=post('action');
			$proposal_id=post('rid');
			if(in_array($action,$all_action)){
				$arr=array(
					'select'=>'p.proposal_id,p.proposal_status',
					'table'=>'proposals p',
					'where'=>array('p.proposal_id'=>$proposal_id,'p.proposal_seller_id'=>$this->member_id),
					'single_row'=>true,
				);
				$proposals=getData($arr);
				if($proposals){
					if($action=='pause'){
						updateTable('proposals',array('proposal_status'=>PROPOSAL_PAUSED),array('proposal_id'=>$proposals->proposal_id,'proposal_status'=>PROPOSAL_ACTIVE));
						$msg['message']=__('popup_proposal_pause_success','One proposal has been paused.');
					}elseif($action=='delete'){
						updateTable('proposals',array('proposal_status'=>PROPOSAL_DELETED),array('proposal_id'=>$proposals->proposal_id));
						$msg['message']=__('popup_proposal_deleted_success','One proposal has been deleted successfully');
					}elseif($action=='active'){
						updateTable('proposals',array('proposal_status'=>PROPOSAL_ACTIVE),array('proposal_id'=>$proposals->proposal_id,'proposal_status'=>PROPOSAL_PAUSED));
						$msg['message']=__('popup_proposal_active_success','One proposal has been activated.');
					}
                    $this->session->set_flashdata('succ_msg',$msg['message']);
					$msg['status']='OK';
				}else{
					$msg['status']='FAIL';
					$msg['message']='Invalid proposal';
                    $this->session->set_flashdata('error_msg',$msg['message']);
				}
				
			}else{
				$msg['status']='FAIL';
				$msg['message']='Invalid proposal';
                $this->session->set_flashdata('error_msg',$msg['message']);
			}	
		}else{
			$msg['status']='FAIL';
			$msg['message']='Invalid proposal';
            $this->session->set_flashdata('error_msg',$msg['message']);
		}
		echo json_encode($msg);
	}
	public function pay_featured_listing(){
		checkrequestajax();
	
		$proposal_id=post('proposal_id');
		$arr=array(
            'select'=>'p.proposal_id,p.proposal_status,p.proposal_title',
            'table'=>'proposals p',
            'where'=>array('p.proposal_id'=>$proposal_id,'p.proposal_seller_id'=>$this->member_id),
            'single_row'=>true,
        );
		$this->data['proposal_details']=getData($arr);
		//$data['member_details']=getMemberDetails($this->member_id);
        $this->data['member_details']=getWalletMember($this->member_id);
        $this->data['balance']=$this->data['member_details']->balance;
		$this->layout->view('pay-featured',$this->data,true);
	}
	public function makefeature($id){
		checkrequestajax();
		$i=0;
		$msg=array();
		$method=post('method');
		$arr=array(
					'select'=>'p.proposal_id',
					'table'=>'proposals p',
					'where'=>array('p.proposal_seller_id'=>$this->member_id,'p.proposal_id'=>$id),
					'single_row'=>true,
				);
		$check_proposal=getData($arr);
		if($check_proposal){
			$featured_fee=get_setting('featured_fee');
			$featured_duration=get_setting('featured_duration');
			$proposal_id=$check_proposal->proposal_id;
			if($method=='wallet'){
				$processing_fee=0;
				$total=$featured_fee+$processing_fee;
				$seller_details=getWalletMember($this->member_id);
				$seller_wallet_id=$seller_details->wallet_id;
				$seller_wallet_balance=$seller_details->balance;
				$site_details=getWallet(get_setting('SITE_PROFIT_WALLET'));
				$reciver_wallet_id=$site_details->wallet_id;
				$reciver_wallet_balance=$site_details->balance;
				//$issuer_relational_data=get_setting('website_name');
				$recipient_relational_data=$seller_details->member_name;
				if($seller_details && $seller_details->balance>$total){
					$wallet_transaction_type_id=get_setting('FEATURED_PAYMENT_WALLET');
					$current_datetime=date('Y-m-d H:i:s');
					$wallet_transaction_id=insert_record('wallet_transaction',array('wallet_transaction_type_id'=>$wallet_transaction_type_id,'status'=>1,'created_date'=>$current_datetime,'transaction_date'=>$current_datetime),TRUE);
					if($wallet_transaction_id){
						
						
						$insert_wallet_transaction_row=array('wallet_transaction_id'=>$wallet_transaction_id,'wallet_id'=>$seller_wallet_id,'debit'=>$total,'description_tkey'=>'PID','relational_data'=>$proposal_id);
						$insert_wallet_transaction_row['ref_data_cell']=json_encode(array(
								'FW'=>$seller_details->name.' wallet',
								'TW'=>$site_details->title,
								'TP'=>'Featured_Payment',
								));
						insert_record('wallet_transaction_row',$insert_wallet_transaction_row);
						
						$insert_wallet_transaction_row=array('wallet_transaction_id'=>$wallet_transaction_id,'wallet_id'=>$reciver_wallet_id,'credit'=>$total,'description_tkey'=>'Transfer_from','relational_data'=>$recipient_relational_data);
						$insert_wallet_transaction_row['ref_data_cell']=json_encode(array(
								'FW'=>$seller_details->name.' wallet',
								'TW'=>$site_details->title,
								'TP'=>'Featured_Payment',
								));
						insert_record('wallet_transaction_row',$insert_wallet_transaction_row);
						
						$seller_new_balance=displayamount($seller_wallet_balance,2)-displayamount($total,2);
						updateTable('wallet',array('balance'=>$seller_new_balance),array('wallet_id'=>$seller_wallet_id));
						wallet_balance_check($seller_wallet_id,array('transaction_id'=>$wallet_transaction_id));
						
						$new_balance=displayamount($reciver_wallet_balance,2)+displayamount($total,2);
						updateTable('wallet',array('balance'=>$new_balance),array('wallet_id'=>$reciver_wallet_id));
						wallet_balance_check($reciver_wallet_id,array('transaction_id'=>$wallet_transaction_id));
						
						$featured_end_date=date('Y-m-d H:i:s',strtotime('+'.$featured_duration.' days'));
						updateTable('proposal_settings',array('proposal_featured'=>1,'featured_end_date'=>$featured_end_date),array('proposal_id'=>$proposal_id));
						
						
						$RECEIVER_EMAIL=$seller_details->member_email;
						$url=get_link('myProposalsURL');
						$template='featured-gig';
						$data_parse=array(
						'SELLER_NAME'=>$seller_details->member_name,
						'PROPOSAL_URL'=>$url,
						);
						SendMail($RECEIVER_EMAIL,$template,$data_parse);
						
						$this->notification_model->log(
							$template, // template key
							array('PID'=>$proposal_id), // template data
							$this->config->item('myProposalsURL'), // link (without base_url)
							$this->member_id, // notification to,
							0 // notification_from
						);
						
						
							
						$msg['status'] = 'OK';
						$msg['method'] = $method;
						$msg['redirect'] =get_link('myProposalsURL').'?ref=paymentsuccess';
					}else{
						$msg['status'] = 'FAIL';
						$msg['message'] = 'transaction error';
					}
				}else{
					$msg['status'] = 'FAIL';
					$msg['message'] = 'Insufficient fund';
				}					
					
					
				
			}
			
		}else{
			$msg['status'] = 'FAIL';
		}
		unset($_POST);
		echo json_encode($msg);	
	}

	public function gigs($cat='',$cat_id='',$sub_cat='',$sub_cat_id='') {
		$this->layout->set_js(array(
			'bootstrap-tagsinput.min.js',
			'typeahead.bundle.min.js',
		));
		$this->layout->set_css(array(
			'bootstrap-tagsinput.css'
		));
		$this->db->where('proposal_featured',1)->where('featured_end_date <',date('Y-m-d H:i:s'))->update('proposal_settings',array('proposal_featured'=>0,'featured_end_date'=>NULL));
		$this->load->library('pagination');
		$this->data['srch_url'] = uri_string();
		$this->data['srch_param'] = $this->data['srch_string'] = $this->input->get();
		$breadcrumb=array(
					array(
							'title'=>__('findjob_category','Category'),'path'=>''
					)
				);
		
	
		$this->data['srch_url'] = uri_string();
		$this->data['srch_param'] = $this->data['srch_string'] = $this->input->get();
		if($cat_id){
			$this->data['srch_param']['category'] = $cat;
			$this->data['srch_param']['category_id'] = $cat_id;
		}
		if($sub_cat_id){
			$this->data['srch_param']['sub_catgory'] = $sub_cat;
			$this->data['srch_param']['sub_catgory_id'][] = $sub_cat_id;
		}
		$this->data['pre_skills']=array();
		$this->data['all_skills']=getAllSkills();
		if(get('byskillsid')){
			$this->data['pre_skills']=getData(array(
				'select'=>'s.skill_id,s.skill_key,s_n.skill_name',
				'table'=>'skills s',
				'join'=>array(array('table'=>'skill_names as s_n','on'=>"(s.skill_id=s_n.skill_id and s_n.skill_lang='".get_active_lang()."')",'position'=>'left')),
				'where'=>array('s.skill_status'=>'1'),
				'where_in'=>array('s.skill_id'=>get('byskillsid'))
			));
		}
		$this->data['offset'] = 10;
		$this->data['limit'] = !empty($this->data['srch_param']['per_page']) ? $this->data['srch_param']['per_page'] : 0;
		$this->data['srch_string'] = !empty($this->data['srch_string']) ? $this->data['srch_string'] : array();
		unset($this->data['srch_string']['per_page']);
		unset($this->data['srch_string']['total']);
	
		$this->data['proposals'] = $this->proposals_model->list_proposal($this->data['srch_param'] , $this->data['limit'] , $this->data['offset']);
		$this->data['total_proposals'] = $this->proposals_model->list_proposal($this->data['srch_param'] , $this->data['limit'] , $this->data['offset'] , FALSE);
		
		$this->data['parent_category']=getAllCategory();
		$this->data['child_category'] = array();
		if(!empty($this->data['srch_param']['category_id'])){
			$this->data['category_name']=getFieldData('category_name','category_names','','',array('category_id'=>$this->data['srch_param']['category_id'],'category_lang'=>$this->lang));
			$this->data['child_category'] = getAllSubCategory($this->data['srch_param']['category_id']);
		}
	
		$config['base_url'] = base_url('proposals/gigs?total=10');
			
		$config['base_url'] .= !empty($this->data['srch_string']) ? '&'.http_build_query($this->data['srch_string']) : '';
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_proposals'];
		$config['per_page'] = $this->data['offset'];
		
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = __('pagination_first','First');
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='page-item active'><a href='javascript:void(0)' class='page-link'>";
		$config['cur_tag_close'] = '</a></li>';
		$config['last_link'] = __('pagination_last','Last');;
		$config['last_tag_open'] = "<li class='page-item last'>";
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '<i class="zmdi zmdi-chevron-right"></i>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="zmdi zmdi-chevron-left"></i>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>'; 
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		$this->data['links'] = $this->pagination->create_links();

		$this->layout->set_title('Catelog');
		$this->layout->set_meta('keywords', 'Freelancer Script, Freelancer, New Flance');
		$this->layout->set_meta('description', 'Freelancer Clone Script');
		$this->layout->view('gigs',$this->data);
	}
	public function details($proposal_url='') {
		$arr=array(
			'select'=>'p.proposal_id',
			'table'=>'proposals as p',
			'where'=>array('p.proposal_status <>'=>PROPOSAL_DELETED,'p.proposal_url'=>$proposal_url),
			'single_row'=>true,
		);
		$this->layout->set_js(array(
				'ninjaVideoPlugin.js',
				'ninja-slider.js',
				'thumbnail-slider.js',
				
			));
		$this->layout->set_css(array(
				'ninja-slider.css',
				'thumbnail-slider.css'
			));
		$ProposalDataBasic=getData($arr);
		if($ProposalDataBasic){
			$proposal_id=$ProposalDataBasic->proposal_id;
			$this->data['proposal'] = getGigDetails($proposal_id,'',true);
			$r=array(
				'select'=>'m.member_id,m.member_name,m.is_email_verified,m_b.member_heading,m_b.member_hourly_rate,m_a.member_country,m_l.logo,m_s.avg_rating as avg_review,m_s.total_earning as totalearn,m_s.no_of_reviews,m_s.success_rate,m_a.member_city,m_a.member_state,c_n.country_name,c.country_code_short',
				'table'=>'member m',
				'join'=>array(
					array('table'=>'member_address m_a','on'=>'m.member_id=m_a.member_id','position'=>'left'),
					array('table'=>'country as c','on'=>'m_a.member_country=c.country_code','position'=>'left'),
					array('table'=>'country_names as c_n','on'=>"(c.country_code=c_n.country_code and c_n.country_lang='".get_active_lang()."')",'position'=>'left'),
					array('table'=>'member_basic m_b','on'=>'m.member_id=m_b.member_id','position'=>'left'),
					array('table'=>'member_logo m_l','on'=>'m.member_id=m_l.member_id','position'=>'left'),
					array('table'=>'member_statistics m_s','on'=>'m.member_id=m_s.member_id','position'=>'left'),
				),
				'where'=>array('m.member_id'=>$this->data['proposal']->proposal_seller_id),
				'single_row'=>true
				);

			$this->data['proposal']->member=getData($r);
			$is_owner=$logged_in_id=0;
			if($this->loggedUser){
				$logged_in_id=$this->member_id;
				if($this->member_id==$this->data['proposal']->proposal_seller_id){
					$is_owner=1;
				}else{
					$proposal_view_log=array(
						'proposal_id'=>$proposal_id,
						'member_id'=>$this->member_id
					);
					$this->db->where($proposal_view_log)->delete('proposal_view_log');
					$proposal_view_log['reg_date']=date('Y-m-d H:i:s');
					$this->db->insert('proposal_view_log',$proposal_view_log);
				}
			}
			if($is_owner==0){
				if($this->session->userdata('no_of_views-'.$proposal_id)){
				}else{
					$this->db->where('proposal_id',$proposal_id)->set('proposal_views','`proposal_views`+1',false)->update('proposal_stat');
					$this->session->set_userdata('no_of_views-'.$proposal_id,TRUE);
				}
			}
			$this->data['is_owner']=$is_owner;
			$this->data['logged_in_id']=$logged_in_id;
			$srch_param=array();
			if($this->data['proposal']){
				$srch_param['not_proposal_id'] = $proposal_id;
				$srch_param['category_id'] = $this->data['proposal']->proposal_category->category_id;
				$srch_param['sub_catgory_id'][] = $this->data['proposal']->proposal_category->category_subchild_id;
			}
			$this->data['similar'] = $this->proposals_model->list_proposal($srch_param , 0 , 8);
			if($this->data['proposal']){
				$srch_param=array('not_proposal_id'=>$proposal_id,'member_id'=>$this->data['proposal']->proposal_seller_id);
			}
			
			$this->data['my_other_gigs'] = $this->proposals_model->list_proposal($srch_param , 0 , 8);
			$srch_param=array('not_proposal_id'=>$proposal_id,'other_viewer'=>1);
			$this->data['other_viewer_gigs'] = $this->proposals_model->list_proposal($srch_param , 0 , 8);
		
			$this->layout->view('gigs-details',$this->data);
		}else{
			show_404();
		}
		
		
	}
	public function savecheckoutCheckAjax(){
		$i=0;
		$msg=array();
		$CheckOutData=array();
		$proposal_id=post('proposal_id');
		$qty=post('proposal_qty');
		if($proposal_id && $qty){
			$proposal_status=getFieldData('proposal_status','proposals','proposal_id',$proposal_id);
			if($proposal_status==PROPOSAL_ACTIVE){
				$CheckOutData['proposal_id']=$proposal_id;
				$CheckOutData['qty']=$qty;
				if($this->input->post('package_id')){
					$CheckOutData['package_id']=$this->input->post('package_id');
				}else{
					$CheckOutData['package_id']='';
				}
				$this->session->set_userdata('CheckOutData',$CheckOutData);	
				$msg['redirect'] =get_link('checkoutURL');
				$msg['status'] = 'OK';
			}else{
				$msg['status'] = 'FAIL';	
				$msg['notverified'] = 'Proposal not verified yet';	
				
			}
		}
		unset($_POST);
		echo json_encode($msg);
	}
	public function checkout(){
		
		$sub_total=$proposal_price=$extra_price=0;
			
			$CheckOutData=$this->session->userdata('CheckOutData');
			$this->data['CheckOutData']=$CheckOutData;
			if($CheckOutData && $CheckOutData['proposal_id']){
			   
				$this->data['proposal_details']=$this->db->select('ps.proposal_seller_id,ps.proposal_title,ps.proposal_short_info,ps.display_price,ps.proposal_id,ps.proposal_image')->where(['ps.proposal_id' => $CheckOutData['proposal_id']])->from('proposals as ps')->join('proposal_stat as pt','ps.proposal_id=pt.proposal_id','left')->get()->row();
				if($CheckOutData['package_id']){
					$arr=array(
						'select'=>'p.package_id,p.package_name,p.price,p.description,p.delivery_time',
						'table'=>'proposal_packages as p',
						'where'=>array('p.proposal_id'=>$CheckOutData['proposal_id'],'p.package_id'=>$CheckOutData['package_id']),
						'single_row'=>TRUE
					);
					$proposal_packages=getData($arr);
					$this->data['proposal_details']->package=$proposal_packages;
					if($proposal_packages){
						$proposal_price=$proposal_packages->price;
					}else{
						$proposal_price=$this->data['proposal_details']->display_price;
					}
					
				}else{
					$proposal_price=$this->data['proposal_details']->display_price;
				}
				$sub_total+= $proposal_price*$CheckOutData['qty'];
				$this->data['CheckOutData']['proposal_price']=$proposal_price;
				$this->data['CheckOutData']['sub_total']=$sub_total;
	
				$this->data['balance']=getFieldData('balance','wallet','user_id',$this->member_id);
				$this->session->set_userdata('CheckOutData',$this->data['CheckOutData']);
	
			}else{
				redirect(get_link('dashboardURL'));
			}
		
			$this->layout->view('checkout',$this->data);
	}
	public function checkoutprocessCheckAjax(){
		$all_method=array('wallet');
		checkrequestajax();
		$i=0;
		$msg=array();
		$method=post('method');
		$is_cart=post('payfor');
		$processing_fee=get_setting('processing_fee');
		$is_join_payment=post('is_join_payment');
		$order_status=ORDER_PROCESSING;
		$order_number=time();
		$buyer_details=getWalletMember($this->member_id);

		$CheckOutData=$this->session->userdata('CheckOutData');
		$wallet_balance_adjust=displayamount($buyer_details->balance,2);
		if($wallet_balance_adjust>$CheckOutData['sub_total']){
			$wallet_balance_adjust=$CheckOutData['sub_total'];
		}
		
		//dd($CheckOutData,TRUE);
		if($CheckOutData && in_array($method,$all_method)){
			$proposal_details=getGigDetails($CheckOutData['proposal_id'],array('proposal','proposal_additional','proposal_settings'));
			$seller_details=getWalletMember($proposal_details['proposal']->proposal_seller_id);
			if(!empty($proposal_details['proposal_additional']->buyer_instruction)){
				//$order_status=ORDER_PENDING;
			}
			$delivery_time=7;
			if($CheckOutData['package_id']){
				$delivery_time_package=getFieldData('delivery_time','proposal_packages','package_id',$CheckOutData['package_id']);
				if($delivery_time_package){
					$delivery_time=$delivery_time_package;
				}
			}	
			if($method=='wallet'){
				$processing_fee=0;
				$total=$CheckOutData['sub_total']+$processing_fee;
				if($buyer_details && $buyer_details->balance>$total){
					//$delivery= getAllDeliveryTimes($proposal_details['proposal']->delivery_time)
					$order_time = date("Y-m-d H:i:s", strtotime(" + ".$delivery_time." days"));
					$OrderData=array(
					'order_number'=>generate_order_number(),
					'order_date'=>date('Y-m-d H:i:s'),
					'buyer_id'=>$this->member_id,
					'seller_id'=>$proposal_details['proposal']->proposal_seller_id,
					'proposal_id'=>$CheckOutData['proposal_id'],
					'package_id'=>$CheckOutData['package_id'],
					'delivery_time'=>$delivery_time,
					'delivery_date'=>$order_time,
					'order_price'=>$CheckOutData['sub_total'],
					'item_price'=>$CheckOutData['proposal_price'],
					'order_qty'=>$CheckOutData['qty'],
					'order_fee'=>$processing_fee,
					'order_total'=>$total,
					'order_active'=>'1',
					'order_status'=>0,
					'payment_method'=>$method,
					);
					$order_id=$this->proposals_model->processOrder($OrderData);
					if($order_id){
						$buyer_wallet_id=$buyer_details->wallet_id;
						$buyer_wallet_balance=$buyer_details->balance;
						$site_details=getWallet(get_setting('SITE_MAIN_WALLET'));
	
						$reciver_wallet_id=$site_details->wallet_id;
						$reciver_wallet_balance=$site_details->balance;
						//$issuer_relational_data=get_setting('website_name');
						$recipient_relational_data=$buyer_details->name;
						$wallet_transaction_type_id=get_setting('ORDER_PAYMENT_WALLET');
						$current_datetime=date('Y-m-d H:i:s');
						$wallet_transaction_id=insert_record('wallet_transaction',array('wallet_transaction_type_id'=>$wallet_transaction_type_id,'status'=>1,'created_date'=>$current_datetime,'transaction_date'=>$current_datetime),TRUE);
						if($wallet_transaction_id){
							insert_record('orders_transaction',array('order_id'=>$order_id,'transaction_id'=>$wallet_transaction_id));
							$insert_wallet_transaction_row=array('wallet_transaction_id'=>$wallet_transaction_id,'wallet_id'=>$buyer_wallet_id,'debit'=>$total,'description_tkey'=>'OrderID','relational_data'=>$order_id);
							$insert_wallet_transaction_row['ref_data_cell']=json_encode(array(
									'FW'=>$buyer_details->name.' wallet',
									'TW'=>$site_details->title,
									'TP'=>'Order_Payment',
									));
							insert_record('wallet_transaction_row',$insert_wallet_transaction_row);
							
							$buyer_new_balance=displayamount($buyer_wallet_balance,2)-displayamount($total,2);
							updateTable('wallet',array('balance'=>$buyer_new_balance),array('wallet_id'=>$buyer_wallet_id));
							wallet_balance_check($buyer_wallet_id,array('transaction_id'=>$wallet_transaction_id));	
							
							$insert_wallet_transaction_row=array('wallet_transaction_id'=>$wallet_transaction_id,'wallet_id'=>$reciver_wallet_id,'credit'=>$total,'description_tkey'=>'Transfer_from','relational_data'=>$recipient_relational_data);
							$insert_wallet_transaction_row['ref_data_cell']=json_encode(array(
									'FW'=>$buyer_details->name.' wallet',
									'TW'=>$site_details->title,
									'TP'=>'Order_Payment',
									));
							insert_record('wallet_transaction_row',$insert_wallet_transaction_row);
							
							$new_balance=displayamount($reciver_wallet_balance,2)+displayamount($total,2);
							updateTable('wallet',array('balance'=>$new_balance),array('wallet_id'=>$reciver_wallet_id));
							wallet_balance_check($reciver_wallet_id,array('transaction_id'=>$wallet_transaction_id));	
							
							updateTable('orders',array('order_status'=>$order_status,'transaction_id'=>$wallet_transaction_id),array('order_id'=>$order_id));
							
							
							$RECEIVER_EMAIL=getFieldData('member_email','member','member_id',$proposal_details['proposal']->proposal_seller_id);
							$url=get_link('OrderDetailsURL').md5($order_id);
							$template='new-order';
							$data_parse=array(
							'BUYER_NAME'=>$buyer_details->name,
							'SELLER_NAME'=>$seller_details->name,
							'PROPOSAL_TITLE'=>$proposal_details['proposal']->proposal_title,
							'QTY'=>$OrderData['order_qty'],
							'DELIVERY_TIME'=>$OrderData['delivery_time'],
							'ORDER_PRICE'=>$OrderData['order_price'],
							'ORDER_DETAILS_URL'=>$url,
							);
							SendMail($RECEIVER_EMAIL,$template,$data_parse);
							SendMail(get_setting('admin_email'),$template,$data_parse);
							
							$this->notification_model->log(
								$template, // template key
								array('OID'=>$order_id), // template data
								$this->config->item('OrderDetailsURL').md5($order_id), // link (without base_url)
								$proposal_details['proposal']->proposal_seller_id, // notification to,
								$this->member_id // notification_from
							);
							$this->session->set_flashdata('succ_msg', 'Order placed successfully');			
							$msg['status'] = 'OK';
							$msg['method'] = $method;
							$msg['redirect'] = get_link('OrderDetailsURL').md5($order_id).'?ref=paymentsuccess';
							
						}else{
							$msg['status'] = 'FAIL';
							$msg['message'] = 'Insufficient fund';
						}
					}
				}else{
					$msg['status'] = 'FAIL';
					$msg['message'] = 'transaction error';
				}	
			}
			if($order_id){
				$this->session->unset_userdata('CheckOutData');
			}
		
		}else{
			$msg['status'] = 'FAIL';
		}
		unset($_POST);
		echo json_encode($msg);
	}
}
