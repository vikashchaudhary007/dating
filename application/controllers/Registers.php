<?php 
	class Registers extends CI_Controller{

		public function register(){
			$data['title'] = "Register";
			$this->load->view('pages/register', $data);
			$this->load->view('templates/footer');
			$this->load->library('Paypal_lib');

		}
		public function add_reg($page = 'register')
		{
			if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
		    	show_404();
    		}
		    $this->load->model('Registers_Model');
		    $this->load->helper(array('form'));
			$this->load->library('form_validation');
			
			$data['title'] = 'Registration';
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required');
	        $this->form_validation->set_rules('email', 'Email','required|is_unique[user_registration.email]');
			$this->form_validation->set_rules('mobile', 'mobile', 'required');
			$this->form_validation->set_rules('address', 'address', 'required');
			$this->form_validation->set_rules('zipcode', 'zipcode', 'required');
			$this->form_validation->set_rules('dob', 'dob');
			$this->form_validation->set_rules('country', 'country', 'required');
			$this->form_validation->set_rules('gender', 'gender', 'required');

			if($this->form_validation->run() === FALSE){
				echo validation_errors(); 
		  	}else{
				$this->Registers_Model->add_registration($_POST);
				$data['vals'] = $_POST;  
			 	$this->load->view('pages/payment', $data);
			}
			
		}
		public function success()
		{
			   // Get the transaction data
        		$paypalInfo = $this->input->get();
        		print_r($paypalInfo);


		}
		public function cancel()
		{
			echo "Payment has been cancelled..";
		}
	}
	