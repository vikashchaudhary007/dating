<?php
	class Registers_Model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}

		public function add_registration($data)
		{
			$data = array(
				'name' => $data['name'], 
			    'username' => $data['username'],
			    'email' => $data['email'],
			    'mobile' => $data['mobile'],
			    'gender' => $data['gender'],
			    'address' => $data['address'],
			    'zipcode' => $data['zipcode'], 
			    'dob' => $data['dob'],
			    'country' => $data['country'],
			    'amount' => $data['amount'],
			    );
			$this->db->insert('user_registration', $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}

		 

		// public function update_post(){
		// 	$slug = url_title($this->input->post('title'), "dash", TRUE);

		// 	$data = array(
		// 		'title' => $this->input->post('title'), 
		// 	    'slug' => $slug,
		// 	    'body' => $this->input->post('body'),
		// 	    'category_id' => $this->input->post('category_id')
		// 	    );
		// 	$this->db->where('id', $this->input->post('id'));
		// 	return $this->db->update('posts', $data);
		// }
		public function email_exists($key){
			$this->db->where('email',$key);
		    $query = $this->db->get('user_registration');
		    if ($query->num_rows() > 0){
		        return true;
		    }else{
		        return false;
		    }
		}



		   $productResult = $this->db->query("SELECT * FROM user_registration WHERE id = '".$data['item_number']."' "); 
			    $productRow = $productResult->row_array(); 
			    $data['name']=$productRow['name'];
			    $data['amount']=$productRow['amount'];

			    // Check if transaction data exists with the same TXN ID. 
			    $prevPaymentResult = $this->db->query("SELECT * FROM payments WHERE txn_id = '".$data['txn_id']."'"); 
			 
			    if($prevPaymentResult->num_rows() > 0){ 
			        $paymentRow = $prevPaymentResult->row_array(); 
			        $payment_id = $paymentRow['payment_id']; 
			        $payment_gross = $paymentRow['payment_gross']; 
			        $payment_status = $paymentRow['payment_status']; 
			    }else{ 
			        // Insert tansaction data into the database 
			        $insert = $this->db->query("INSERT INTO payments(item_number,txn_id,payment_gross,currency_code,payment_status) VALUES('".$data['item_number']."','".$data['txn_id']."','".$data['payment_gross']."','".$data['currency_code']."','".$data['payment_status']."')"); 
			        $payment_id = $this->db->insert_id();
			    }
			    $data['payment_id']=$payment_id;
			    return $data; 

		 

		 
	}