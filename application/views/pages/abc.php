<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * LocumApp
 *
 * @author		LocumApp Developers & Contributors
 * @copyright	Copyright (c) 2012 - 2018 LocumApp.com
 * @license		https://locumapp.com/license.txt
 * @link		https://locumapp.com
 */

    function nurse_devices($id,$type){
        $CI =& get_instance();
        $where=array(
            'user_id' => $id,
            'user_type' => $type
        );
        $CI->db->from('ip_device_tokens');
        $CI->db->where($where);
        $query = $CI->db->get();
        if($query->num_rows() > 0){ 
        	return $query->result_array(); 
        }else{ 
        	return 0; 
        } 
    }
    
    function user_devices($id,$type){
        $CI =& get_instance();
        $where=array(
            'user_id' => $id,
            'user_type' => $type
        );
        $CI->db->from('ip_device_tokens');
        $CI->db->where($where);
        $query = $CI->db->get();
        if($query->num_rows() > 0){ 
        	return $query->result_array(); 
        }else{ 
        	return 0; 
        }
    }
    
	function fcm_usernoti($cname,$cid,$nname,$userid,$apikey){
		define( 'API_ACCESS_KEY', 'AAAA0B5ydAg:APA91bErd-R8xCjylQ4puBlSgc7aTNoVjIGsG1wtVU8wVczbwxcM2z04YsRAKCIse6ZTHjEOFWpawteVbSENkIsjIC0G5mjFFu7rW_IfAv7HtvvvqgUPNpcdeiGE0HdzPnCmVm_aV-Rj');
		$res = user_devices($userid,'user');
		if ($res > 0) {
			foreach ($res as $val) {
				$title="Locum";
				$umsg="Request successfull. Please wait it is in process ";
				if($val['device_token']!=''){
					$fcmMsg = array(
						'body' => $umsg,
						'title' => $title,
		 			);
		            $data=array(
					    'ids' => '',
					    'title' => 'Locum',
					    'click_action' => '1',
					    'message' => $umsg,
		            	'isBackground' => true
					);
					$fcmFields = array(
					'to' => $val['device_token'],
					'priority' => 'high',
					'notification' => $fcmMsg,
					'data' => $data
					);
					$headers = array(
					'Authorization: key=' . $apikey,
					'Content-Type: application/json'
					);
					$ch = curl_init();
					curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
					curl_setopt( $ch,CURLOPT_POST, true );
					curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
					curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
					curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
					curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
					return $result = curl_exec($ch );
					curl_close( $ch );
				}
			}
		}
		
	}
	
		function fcm_usernoti_on_jobstart($cname,$cid,$nname,$userid,$apikey){
	    	define( 'API_ACCESS_KEY', 'AAAA0B5ydAg:APA91bErd-R8xCjylQ4puBlSgc7aTNoVjIGsG1wtVU8wVczbwxcM2z04YsRAKCIse6ZTHjEOFWpawteVbSENkIsjIC0G5mjFFu7rW_IfAv7HtvvvqgUPNpcdeiGE0HdzPnCmVm_aV-Rj');
	    	$res = user_devices($userid,'user');
			if ($res > 0) {
				foreach ($res as $val) {
					$title="Locum";
					$umsg="Your job has been started..";
		    		if($val['device_token']!=''){
		    			$fcmMsg = array(
			    			'body' => $umsg,
			    			'title' => $title,
		    			);
		                $data=array(
		    			    'ids' => '',
		    			    'title' => 'Locum',
		    			    'click_action' => '1',
		    			    'message' => $umsg,
		                	'isBackground' => true
		    			);
		    			$fcmFields = array(
			    			'to' => $val['device_token'],
			    			'priority' => 'high',
			    			'notification' => $fcmMsg,
			    			'data' => $data
		    			);
		    			$headers = array(
			    			'Authorization: key=' . $apikey,
			    			'Content-Type: application/json'
		    			);
		    			$ch = curl_init();
		    			curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
		    			curl_setopt( $ch,CURLOPT_POST, true );
		    			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		    			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		    			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		    			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
		    			return $result = curl_exec($ch );
		    			curl_close( $ch );
		    		}
			    }
			}
		}
	
	function fcm_usernoti_on_accept($cname,$cid,$nname,$userid,$apikey){
		define( 'API_ACCESS_KEY', 'AAAA0B5ydAg:APA91bErd-R8xCjylQ4puBlSgc7aTNoVjIGsG1wtVU8wVczbwxcM2z04YsRAKCIse6ZTHjEOFWpawteVbSENkIsjIC0G5mjFFu7rW_IfAv7HtvvvqgUPNpcdeiGE0HdzPnCmVm_aV-Rj');
		$res = user_devices($userid,'user');
			if ($res > 0) {
				foreach ($res as $val) {
				$title="Locum";
				$umsg="Your Request has been accepted";
				if($val['device_token']!=''){
					$fcmMsg = array(
					'body' => $umsg,
					'title' => $title,
					);
		            $data=array(
					    'ids' => '',
					    'title' => 'Locum',
					    'message' => $umsg,
					    'click_action' => '2',
		            	'isBackground' => true
					);
					$fcmFields = array(
						'to' => $val['device_token'],
						'priority' => 'high',
						'notification' => $fcmMsg,
						'data' => $data
					);
					$headers = array(
						'Authorization: key=' . $apikey,
						'Content-Type: application/json'
					);
					$ch = curl_init();
					curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
					curl_setopt( $ch,CURLOPT_POST, true );
					curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
					curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
					curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
					curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
					return $result = curl_exec($ch );
					curl_close( $ch );
				}
			}
		}
	}
	function fcm_usergetnoti_on_cancel_job($cid,$userid){
		define( 'API_ACCESS_KEY', 'AAAA0B5ydAg:APA91bErd-R8xCjylQ4puBlSgc7aTNoVjIGsG1wtVU8wVczbwxcM2z04YsRAKCIse6ZTHjEOFWpawteVbSENkIsjIC0G5mjFFu7rW_IfAv7HtvvvqgUPNpcdeiGE0HdzPnCmVm_aV-Rj');
		$res = user_devices($userid,'user');
			if ($res > 0) {
				foreach ($res as $val) {
				$title="Locum";
				$umsg="Your Job has been cancelled by nurse..";
			    if($val['device_token']!=''){
				$fcmMsg = array(
					'body' => $umsg,
					'title' => $title,
				);
				$data=array(
				    'ids' => '',
				    'title' => 'Locum',
				    'click_action' => '3',
				    'message' => $umsg,
		           	'isBackground' => true
				);
				$fcmFields = array(
					'to' => $val['device_token'],
					'priority' => 'high',
					'notification' => $fcmMsg,
		    		'data' => $data
				);
				$headers = array(
					'Authorization: key=' . $apikey,
					'Content-Type: application/json'
				);
				$ch = curl_init();
				curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
				curl_setopt( $ch,CURLOPT_POST, true );
				curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
				curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
				curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
				return $result = curl_exec($ch );
				curl_close( $ch );
				}
			}
		}		
	}
	
	function fcm_usernoti_on_complete($cname,$cid,$nname,$userid,$apikey){
		define( 'API_ACCESS_KEY', 'AAAA0B5ydAg:APA91bErd-R8xCjylQ4puBlSgc7aTNoVjIGsG1wtVU8wVczbwxcM2z04YsRAKCIse6ZTHjEOFWpawteVbSENkIsjIC0G5mjFFu7rW_IfAv7HtvvvqgUPNpcdeiGE0HdzPnCmVm_aV-Rj');
		$res = user_devices($userid,'user');
			if ($res > 0) {
				foreach ($res as $val) {
				$title="Locum";
				$umsg="Your job has been completed..";
				if($val['device_token']!=''){
					$fcmMsg = array(
						'body' => $umsg,
						'title' => $title,
					);
					$data=array(
					    'ids' => '',
					    'title' => 'Locum',
					    'click_action' => '4',
					    'message' => $umsg,
		            	'isBackground' => true
					);
					$fcmFields = array(
						'to' => $val['device_token'],
						'priority' => 'high',
						'notification' => $fcmMsg,
		    			'data' => $data
					);
					$headers = array(
						'Authorization: key=' . $apikey,
						'Content-Type: application/json'
					);
					$ch = curl_init();
					curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
					curl_setopt( $ch,CURLOPT_POST, true );
					curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
					curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
					curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
					curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
					return $result = curl_exec($ch );
					curl_close( $ch );
				}
			}
		}		
	}
	function fcm_nursenoti($cname,$nurseid,$nname,$nid,$apikey){
		$res = nurse_devices($nurseid,'nurse');
		if ($res > 0) {
			foreach ($res as $val) {
				$title="Locum";
				$tmsg="Job has assigned to you";
	    		if($val['device_token']!=''){
	    			$fcmMsg = array(
		    			'body' => $tmsg,
		    			'title' => $title,
	    			);
	    			$data=array(
					    'ids' => '',
					    'title' => 'Locum',
					    'click_action' => '5',
					    'message' => $tmsg,
		            	'isBackground' => true
				    );
					$fcmFields = array(
		    			'to' => $val['device_token'],
		    			'priority' => 'high',
		    			'notification' => $fcmMsg,
		    			'data' => $data
	    			);
	    			$headers = array(
		    			'Authorization: key=' . $apikey,
		    			'Content-Type: application/json'
	    			);
	       			$ch = curl_init();
	    			curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
	    			curl_setopt( $ch,CURLOPT_POST, true );
	    			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	    			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	    			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	    			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
	    			return $result = curl_exec($ch );
	    			curl_close( $ch );
	    		}
	    	}
	    }		
	}
	function fcm_nurse_get_when_user_pay($nurseid,$nid){
		$res = nurse_devices($nurseid,'nurse');
		if ($res > 0) {
			foreach ($res as $val) {		
				$title="Locum";
				$umsg="User has paid amount for his job..";
				$apikey ='AAAArPpIsj4:APA91bGJl-pzqWrIUhHUZeiSLbNg5S0p3VaSDKZWkgOFk1i2dWvPLIVB7ObVe95wduhLKV32mVX3v5ii3Fizg7xEvNSjzLI-p2dsTB0Qi0EbflqvOQSp3kP8z7d2gilA81UFv6W12vJO';
	    		if($val['device_token']!=''){
	    			$fcmMsg = array(
		    			'body' => $umsg,
		    			'title' => $title,
	    			);
	    			$data=array(
				        'ids' => '',
				        'title' => 'Locum',
				        'click_action' => '6',
				        'message' => $umsg,
	            	    'isBackground' => true
				    );
					$fcmFields = array(
		    			'to' => $val['device_token'],
		    			'priority' => 'high',
		    			'notification' => $fcmMsg,
		    			'data' => $data
	    			);
	    			$headers = array(
		    			'Authorization: key=' . $apikey,
		    			'Content-Type: application/json'
	    			);
	    			$ch = curl_init();
	    			curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
	    			curl_setopt( $ch,CURLOPT_POST, true );
	    			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	    			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	    			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	    			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
	    			return $result = curl_exec($ch );
	    			curl_close( $ch );
	    		}
		    }
		}		
	}
	function fcm_nursenoti_whenuser_cancel($nid){
	     	$title="Locum";
	     	$apikeys ='AAAArPpIsj4:APA91bGJl-pzqWrIUhHUZeiSLbNg5S0p3VaSDKZWkgOFk1i2dWvPLIVB7ObVe95wduhLKV32mVX3v5ii3Fizg7xEvNSjzLI-p2dsTB0Qi0EbflqvOQSp3kP8z7d2gilA81UFv6W12vJO';
			$tmsg="Job has been cancelled by user";
    		if($nid!=''){
    			$fcmMsg = array(
	    			'body' => $tmsg,
	    			'title' => $title,
    			);
    			$data=array(
    			    'ids' => '',
    			    'title' => 'Locum',
    			    'click_action' => '7',
    			    'message' => $tmsg,
                	'isBackground' => true
			    );
    			$fcmFields = array(
	    			'to' => $nid,
	    			'priority' => 'high',
	    			'notification' => $fcmMsg,
	    			'data' => $data
    			);
    			$headers = array(
	    			'Authorization: key=' . $apikeys,
	    			'Content-Type: application/json'
    			);
    			$ch = curl_init();
    			curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    			curl_setopt( $ch,CURLOPT_POST, true );
    			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
    			return $result = curl_exec($ch );
    			curl_close( $ch );
    		}
	 }
	 
	 function fcm_noti_admin_update_ticket($did,$usertype){
	     	if($usertype=='Nurse'){
	     	   $apikey ='AAAArPpIsj4:APA91bGJl-pzqWrIUhHUZeiSLbNg5S0p3VaSDKZWkgOFk1i2dWvPLIVB7ObVe95wduhLKV32mVX3v5ii3Fizg7xEvNSjzLI-p2dsTB0Qi0EbflqvOQSp3kP8z7d2gilA81UFv6W12vJO';
	     	}else{
	     	   $apikey = 'AAAA0B5ydAg:APA91bErd-R8xCjylQ4puBlSgc7aTNoVjIGsG1wtVU8wVczbwxcM2z04YsRAKCIse6ZTHjEOFWpawteVbSENkIsjIC0G5mjFFu7rW_IfAv7HtvvvqgUPNpcdeiGE0HdzPnCmVm_aV-Rj';
	     	}
	     	$title="Locum";
			$tmsg="You have new message from support";
    		if($did!=''){
    			$fcmMsg = array(
	    			'body' => $tmsg,
	    			'title' => $title,
    			);
    			$data=array(
    			    'ids' => '',
    			    'title' => 'Locum',
    			    'click_action' => '8',
    			    'message' => $tmsg,
                	'isBackground' => true
    			);
    			$fcmFields = array(
	    			'to' => $did,
	    			'priority' => 'high',
	    			'notification' => $fcmMsg,
	    			'data' => $data
    			);
    			$headers = array(
	    			'Authorization: key=' . $apikey,
	    			'Content-Type: application/json'
    			);
    			$ch = curl_init();
    			curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    			curl_setopt( $ch,CURLOPT_POST, true );
    			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
    			return $result = curl_exec($ch );
    			curl_close( $ch );
    		}
	 }
	 
	function fcm_userget_commnoti($nursename,$uid,$message,$nurse_id){
		define( 'API_ACCESS_KEYs', 'AAAA0B5ydAg:APA91bErd-R8xCjylQ4puBlSgc7aTNoVjIGsG1wtVU8wVczbwxcM2z04YsRAKCIse6ZTHjEOFWpawteVbSENkIsjIC0G5mjFFu7rW_IfAv7HtvvvqgUPNpcdeiGE0HdzPnCmVm_aV-Rj');
		$title="Locum";
		$umsg= $message;
		if($uid!=''){
			$fcmMsg = array(
				'body' => $umsg,
				'title' => $nursename,
			);
			$data=array(
			    'ids' => $nurse_id,
			    'title' => $nursename,
			    'click_action' => '9',
			    'message' => $umsg,
            	'isBackground' => true
			);
			$fcmFields = array(
				'to' => $uid,
				'priority' => 'high',
				'notification' => $fcmMsg,
				'data' => $data
			);
			$headers = array(
				'Authorization: key=' .API_ACCESS_KEYs,
				'Content-Type: application/json'
			);
			$ch = curl_init();
			curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
			curl_setopt( $ch,CURLOPT_POST, true );
			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
			return $result = curl_exec($ch );
			curl_close($ch);
		}
	}  
	
	function fcm_user_get_when_nurse_confirm($cdev,$nid){
			$title="Locum";
			$umsg="Nurse confirmed job has successfully paid..";
			$apikey ='AAAArPpIsj4:APA91bGJl-pzqWrIUhHUZeiSLbNg5S0p3VaSDKZWkgOFk1i2dWvPLIVB7ObVe95wduhLKV32mVX3v5ii3Fizg7xEvNSjzLI-p2dsTB0Qi0EbflqvOQSp3kP8z7d2gilA81UFv6W12vJO';
    		if($nid!=''){
    			$fcmMsg = array(
	    			'body' => $umsg,
	    			'title' => $title,
    			);
    			$data=array(
    			    'ids' => '',
    			    'title' => 'Locum',
    			    'click_action' => '10',
    			    'message' => $umsg,
                	'isBackground' => true
    			);
    			$fcmFields = array(
	    			'to' => $nid,
	    			'priority' => 'high',
	    			'notification' => $fcmMsg,
	    			'data' => $data
    			);
    			$headers = array(
	    			'Authorization: key=' . $apikey,
	    			'Content-Type: application/json'
    			);
    			$ch = curl_init();
    			curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    			curl_setopt( $ch,CURLOPT_POST, true );
    			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
    			return $result = curl_exec($ch );
    			curl_close( $ch );
    		}
	}
	
	
	function fcm_nurseget_commnoti($nursename,$uid,$message,$client_id){
		define( 'API_ACCESS_KEY', 'AAAArPpIsj4:APA91bGJl-pzqWrIUhHUZeiSLbNg5S0p3VaSDKZWkgOFk1i2dWvPLIVB7ObVe95wduhLKV32mVX3v5ii3Fizg7xEvNSjzLI-p2dsTB0Qi0EbflqvOQSp3kP8z7d2gilA81UFv6W12vJO');
		$title="Locum";
		$umsg= $message;
		if($uid!=''){
            $fcmMsg = array(
				'body' => $umsg,
				'title' => $nursename,
			);
			$data=array(
			    'ids' => $client_id,
			    'title' => $nursename,
			    'click_action' => '11',
			    'message' => $umsg,
            	'isBackground' => true
			);
			$fcmFields = array(
    			'to' => $uid,
    			'priority' => 'high',
    			'notification' => $fcmMsg,
    			'data' => $data
			);
			$headers = array(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);
			$ch = curl_init();
			curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
			curl_setopt( $ch,CURLOPT_POST, true );
			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
			return $result = curl_exec($ch );
			curl_close($ch);
		}
	}  
	function fcm_usergetnoti($cname,$cid,$nname,$nid,$apikey,$umsg){
		define( 'API_ACCESS_KEY', 'AAAA0B5ydAg:APA91bErd-R8xCjylQ4puBlSgc7aTNoVjIGsG1wtVU8wVczbwxcM2z04YsRAKCIse6ZTHjEOFWpawteVbSENkIsjIC0G5mjFFu7rW_IfAv7HtvvvqgUPNpcdeiGE0HdzPnCmVm_aV-Rj');
		$title="Locum";
		if($cid!=''){
			$fcmMsg = array(
				'body' => $umsg,
				'title' => $title,
			);
            $data=array(
			    'ids' => '',
			    'title' => 'Locum',
			    'click_action' => '12',
			    'message' => $umsg,
            	'isBackground' => true
			);
			$fcmFields = array(
				'to' => $cid,
				'priority' => 'high',
				'notification' => $fcmMsg,
    			'data' => $data
			);
			$headers = array(
				'Authorization: key=' . $apikey,
				'Content-Type: application/json'
			);
			$ch = curl_init();
			curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
			curl_setopt( $ch,CURLOPT_POST, true );
			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
			return $result = curl_exec($ch );
			curl_close($ch);
		}
	}
