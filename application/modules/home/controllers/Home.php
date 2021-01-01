<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {
	
	private $data;
	
    public function __construct() {
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
		));
		
    }

    public function index() {
		$this->layout->set_meta('author', 'Venkatesh bishu');
		$this->layout->set_meta('keywords', 'Freelancer Script, Freelancer, New Flance');
		$this->layout->set_meta('description', 'Freelancer Clone Script');
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
	
	
}
