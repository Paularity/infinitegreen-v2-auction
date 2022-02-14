<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;
	private $currentUserId;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		
			extract($_POST);		
			$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
			if($qry->num_rows > 0){
				foreach ($qry->fetch_array() as $key => $value) {
					if($key != 'password' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}

				if($_SESSION['login_type'] == 3){
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
					return 2 ;
					exit;
				}
					$this->currentUserId = $_SESSION['login_id'];					
					return 1;
			}else{
				return 3;
			}
	}
	function login2(){
		
			extract($_POST);		
			$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
			if($qry->num_rows > 0){
				foreach ($qry->fetch_array() as $key => $value) {
					if($key != 'password' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}
				if($_SESSION['login_type'] == 1){
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
					return 2 ;
					exit;
				}
					return 1;
			}else{
				return 3;
			}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = '$type' ";
		if($type == 1)
			$establishment_id = 0;
		$chk = $this->db->query("Select * from users where username = '$username' and id !='$id' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		}
		if($save){
			return 1;
		}
	}	

	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	function signup(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", address = '$address' ";
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = 3";
		$chk = $this->db->query("SELECT * FROM users where username = '$username' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("INSERT INTO users set ".$data);
		if($save){
			$login = $this->login2();
				if($login)
				return $login;
		}
	}
	function signupSeller(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", address = '$address' ";
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = 2";
		$chk = $this->db->query("SELECT * FROM users where username = '$username' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("INSERT INTO users set ".$data);
		if($save){
			$login = $this->login();
				if($login)
				return $login;
		}
	}	
	function update_account(){
		extract($_POST);
		$data = " name = '".$firstname.' '.$lastname."' ";
		$data .= ", username = '$email' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' and id != '{$_SESSION['login_id']}' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("UPDATE users set $data where id = '{$_SESSION['login_id']}' ");
		if($save){
			$data = '';
			foreach($_POST as $k => $v){
				if($k =='password')
					continue;
				if(empty($data) && !is_numeric($k) )
					$data = " $k = '$v' ";
				else
					$data .= ", $k = '$v' ";
			}
			if($_FILES['img']['tmp_name'] != ''){
							$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
							$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
							$data .= ", avatar = '$fname' ";

			}
			$save_alumni = $this->db->query("UPDATE alumnus_bio set $data where id = '{$_SESSION['bio']['id']}' ");
			if($data){
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}
				$login = $this->login2();
				if($login)
				return 1;
			}
		}
	}

	function save_settings(){
		extract($_POST);
		$data = " name = '".str_replace("'","&#x2019;",$name)."' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
					$data .= ", cover_img = '$fname' ";

		}
		
		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set ".$data);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set ".$data);
		}
		if($save){
		$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['system'][$key] = $value;
		}

			return 1;
				}
	}

	
	function save_category(){
		extract($_POST);
		$data = " name = '$name' ";
			if(empty($id)){
				$save = $this->db->query("INSERT INTO categories set $data");
			}else{
				$save = $this->db->query("UPDATE categories set $data where id = $id");
			}
		if($save)
			return 1;
	}
	function delete_category(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM categories where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_product(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','img')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
			}
		
		if(empty($id)){
			$save = $this->db->query("INSERT INTO products set $data");
			$id = $this->db->insert_id;
		}else{
			$save = $this->db->query("UPDATE products set $data where id = $id");
		}

		if($save){

			if($_FILES['img']['tmp_name'] != ''){
			$ftype= explode('.',$_FILES['img']['name']);
			$ftype= end($ftype);
			$fname =$id.'.'.$ftype;
			if(is_file('assets/uploads/'. $fname))
				unlink('assets/uploads/'. $fname);
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$save = $this->db->query("UPDATE products set img_fname='$fname' where id = $id");
			}
			return 1;
		}
	}
	function delete_product(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM products where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function get_latest_bid(){
		extract($_POST);
		$get = $this->db->query("SELECT * FROM bids where product_id = $product_id order by bid_amount desc limit 1 ");
		$bid = $get->num_rows > 0 ? $get->fetch_array()['bid_amount'] : 0 ;
		return $bid;
	}
	function save_bid(){
		extract($_POST);
		$data = "";
		$chk = $this->db->query("SELECT * FROM bids where product_id = $product_id order by bid_amount desc limit 1 ");
		$uid = $chk->num_rows > 0 ? $chk->fetch_array()['user_id'] : 0 ;
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
					$data .= ", user_id='{$_SESSION['login_id']}' ";

		if($uid == $_SESSION['login_id']){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO bids set ".$data);
		}else{
			$save = $this->db->query("UPDATE bids set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_book(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM books where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function get_booked_details(){
		extract($_POST);
		$qry = $this->db->query("SELECT b.*,c.brand, c.model FROM books b inner join cars c on c.id = b.car_id where b.id = $id ")->fetch_array();
		$data = array();
		foreach($qry as $k=>$v){
			if(!is_numeric($k))
			$data[$k]= $v;
		}
			return json_encode($data);
	}
	function save_movement(){
		extract($_POST);
		$data = " booked_id = '$book_id' ";
		$data .= ", car_id = '$car_id' ";

		if(empty($id)){
			$save = $this->db->query("INSERT INTO borrowed_cars set ".$data);
			if($save){
				$data = " car_registration_no = '$car_registration_no' ";
				$data .= ", car_plate_no = '$car_plate_no' ";
				$this->db->query("UPDATE books set $data where id = $book_id");
			}
		}else{
		$data .= ", status = '$status' ";
			$save = $this->db->query("UPDATE borrowed_cars set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_movement(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM borrowed_cars where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_event(){
		extract($_POST);
		$data = " title = '$title' ";
		$data .= ", schedule = '$schedule' ";
		$data .= ", content = '".htmlentities(str_replace("'","&#x2019;",$content))."' ";
		if($_FILES['banner']['tmp_name'] != ''){
						$_FILES['banner']['name'] = str_replace(array("(",")"," "), '', $_FILES['banner']['name']);
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['banner']['name'];
						$move = move_uploaded_file($_FILES['banner']['tmp_name'],'assets/uploads/'. $fname);
					$data .= ", banner = '$fname' ";

		}
		if(empty($id)){

			$save = $this->db->query("INSERT INTO events set ".$data);
		}else{
			$save = $this->db->query("UPDATE events set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_event(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM events where id = ".$id);
		if($delete){
			return 1;
		}
	}
	
	function participate(){
		extract($_POST);
		$data = " event_id = '$event_id' ";
		$data .= ", user_id = '{$_SESSION['login_id']}' ";
		$commit = $this->db->query("INSERT INTO event_commits set $data ");
		if($commit)
			return 1;

	}

	function send_message(){
		extract($_POST);
		$data = " sender_id = '$sender_id' ";
		$data .= ", receiver_id = '$receiver_id' ";
		$data .= ", message = '$message' ";

		if(empty($sender_id)){
			return 2;
		}else{
			$save = $this->db->query("INSERT INTO chatlog set $data");
		}

		if($save)
			return 1;		
	}

	function notify_user(){
		extract($_POST);
		$data = " id = '$id' ";
		$data .= ", status = '2'";

		// if(empty($sender_id)){
		// 	return 2;
		// }else{
		// 	$save = $this->db->query("INSERT INTO chatlog set $data");
		// }
		
		$save = $this->db->query("UPDATE bids set $data where id = $id");

		if($save)
			return 1;		
	}

	function user_checkout(){
		extract($_POST);
		$data = " id = '$id' ";
		$data .= ", status = '2'";

		// if(empty($sender_id)){
		// 	return 2;
		// }else{
		// 	$save = $this->db->query("INSERT INTO chatlog set $data");
		// }
		
		$save = $this->db->query("UPDATE bids set $data where id = $id");

		if($save)
			return 1;		
	}

	function update_payment_method(){		
		extract($_POST);
		if($updatePaymentMethod == 2 && isset($_SESSION['payment_method'])){			
			$_SESSION['selectedBidId'] = $bidId;
			return 1;
			exit();
		}

		else if($updatePaymentMethod == 1 && isset($payment_method)){
			unset($_SESSION['payment_method']);
			$_SESSION['payment_method'] = $payment_method;
			return 2;
			exit();
		}
		
		return 3;
		exit();
			
	}

	function checkout_payment(){
		if(isset($_SESSION['payment_method'])){
			return 1;
			exit();
		}
		else{
			return 2;
			exit();
		}			
	}

	function checkout_gcash(){
		$generatedId =  $_SESSION['login_name'] . '_' . $_SESSION['login_id'] . '_' . $this->GUID();
		$generateDate = date('m/d/Y h:i:s a', time());
		// PAYMONGO API
		$url = 'https://api.paymongo.com/v1/sources';
		// changeable
		$public_key = 'pk_test_jnCvv3S3fxknkssw1uUwA2wR';
		$secret_key = 'sk_test_JCWt7DwW54K4wSu3PvuUv7wS';

		$data =[ "data" => [
				"attributes" => [
					//changeable
					"amount" => (float)($_POST['total'])*100,
					"redirect" => [
						// success and invalid page changeable
						"success" => "http://localhost/infinitegreen-v2-auction/index.php?page=success-payment",
						"failed" => "http://localhost/infinitegreen-v2-auction/index.php?page=invalid-payment",
					],
					"type" => "gcash",
					"currency" => "PHP",
					"billing" => [
						"name" => $generatedId,
						"phone" => $_POST['accountNumber'],
						"email" => $_SESSION['login_email']
					]
				]
			]];

		$dataText = $data_string = json_encode($data);
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_USERPWD, "$secret_key:$secret_key");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt(
			$curl,
			CURLOPT_HTTPHEADER,
			array('Content-Type: application/json')
		);
		
		
		$resp = curl_exec($curl);
		curl_close($curl);
		$json_a=json_decode($resp, true);
		
		if(isset($json_a)){
			// return var_dump($json_a);
			$generateOrderId = $generatedId."_".$generateDate;
			$user_id = $_SESSION['login_id'];
			$address = $_SESSION['login_address'];
			$account_name = $_SESSION['login_name'];
			$account_number = $_POST['accountNumber'];

			$_SESSION['current_gcash_source_id'] = $json_a['data']['id'];
			$_SESSION['current_product_price'] = (float)($_POST['total'])*100;
			$_SESSION['current_gcash_product_description'] = $json_a['data']['attributes']['billing']['name'] . $json_a['data']['attributes']['created_at'];
			return $json_a["data"]["attributes"]["redirect"]["checkout_url"];
			exit();
		}
		// if( (float)($_POST['total']) >= 100 ){
		// }
		return 2;
		exit();		
	}

	function update_order_status(){
		extract($_POST);
		if(empty($id)){
			return 2;
		}else{
			$save = $this->db->query("UPDATE `bids` SET `status` = '".$status."' WHERE id=".$id);
		}
		if($save)
			return 1;
	}

	private function GUID()
	{
		if (function_exists('com_create_guid') === true) {
			return trim(com_create_guid(), '{}');
		}

		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}

}