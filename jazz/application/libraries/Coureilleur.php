<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coureilleur
{
	private $username;
	private $password;
	private $api_key;
	private $client_id;
	private $list_id;
	private $mailing_list;
	private $user_key;
	
	public function build($username, $password, $client_id, $api_key)
	{
		$this->set_username($username);
		$this->set_passwrod($password);
		$this->set_client_id($client_id);
		$this->set_api_key($api_key);
	}
	
	public function connect()
	{
		$data = array('email' => $this->get_username() ,'password' => $this->get_passwrod());
		$result = $this->execute_curl('https://api.wbsrvc.com/User/login', $data);
		$json_object = json_decode($result, true);
		$this->user_key = $json_object['data']['user_key'];
	}
	
	public function create_list($list_name, $sender_name, $sender_email)
	{
		$data = array('user_key' => $this->get_user_key() ,'client_id' => $this->get_client_id(), 'name' => $list_name, 'sender_name' => $sender_name, 'sender_email' => $sender_email);
		$result = $this->execute_curl('https://api.wbsrvc.com/List/create', $data);
		$json_object = json_decode($result, true);
		$this->list_id = $json_object['data'];
	}
	
	public function create_email_body()
	{
		$data = array('user_key' => $this->get_user_key() ,'list_id' => $this->get_list_id(), 'client_id' => $this->get_client_id(), 'status' => 'active', 'policy' => 'accepted');
		$result = $this->execute_curl('https://api.wbsrvc.com/List/setInfo', $data);
		$data = array('user_key' => $this->get_user_key() ,'list_id' => $this->get_list_id(), 'client_id' => $this->get_client_id(), 'field' => 'message_body', 'action' => 'add', 'type' => 'mediumtext');
		$result = $this->execute_curl('https://api.wbsrvc.com/List/editStructure', $data);
	}
	
	public function create_mailing_list($mailing_name, $subject, $sender_name, $sender_email)
	{
		$data = array('user_key' => $this->get_user_key() ,'client_id' => $this->get_client_id(), 'name' => $mailing_name);
		$result = $this->execute_curl('https://api.wbsrvc.com/Mailing/create', $data);
		$json_object = json_decode($result, true);
		$this->mailing_list = $json_object['data'];
		$htmlMessage = '[message_body]';
		$data = array('user_key' => $this->get_user_key(),
					  'client_id' => '86182', 
					  'mailing_id' => $this->get_mailing_list(), 
					  'list_id' => $this->get_list_id(),
					  'subject' => $subject,
					  'sender_name' => $sender_name,
					  'sender_email' => $sender_email,
					  'html_message' => $htmlMessage,
					  'clickthru_html' => 'true',
					  'unsub_bottom_link' => 'false');
		$result = $this->execute_curl('https://api.wbsrvc.com/Mailing/setInfo', $data);
	}
	
	public function add_email($email, $body)
	{
		$api_data =  array(array('email' => $email,'message_body' => $body));
		$data = array('user_key' => $this->get_user_key() ,'list_id' => $this->get_list_id(), 'client_id' => $this->get_client_id(), 'record' => $api_data);
		$result = $this->execute_curl('https://api.wbsrvc.com/List/import', $data);
	}
   
	public function send_mailing_list()
	{
		$data = array('user_key' => $this->get_user_key() ,'client_id' => $this->get_client_id(), 'mailing_id' =>  $this->get_mailing_list());
		$result = $this->execute_curl('https://api.wbsrvc.com/Mailing/schedule', $data);
	}
	
	public function unsubscribe_email($email, $list_id)
	{
		$data = array('user_key' => $this->get_user_key() ,'client_id' => $this->get_client_id(), 'list_id' => $list_id, 'email' => $email);
		$result = $this->execute_curl('https://api.wbsrvc.com/List/UnsubscribeEmail', $data);
	}
		
	public function get_username()
	{
		return $this->username;
	}

	public function get_passwrod()
	{
		return $this->password;
	}
	
	public function get_client_id()
	{
		return $this->client_id;
	}
	
	public function get_api_key()
	{
		return $this->api_key;
	}
	
	public function get_user_key()
	{
		return $this->user_key;
	}
	
	public function get_list_id()
	{
		return $this->list_id;
	}
	
	public function get_mailing_list()
	{
		return $this->mailing_list;
	}
	
	private function set_username($username)
	{
		$this->username = $username;
	}

	private function set_passwrod($password)
	{
		$this->password = $password;
	}
	
	private function set_client_id($client_id)
	{
		$this->client_id = $client_id;
	}
	
	private function set_api_key($api_key)
	{
		$this->api_key = $api_key;
	}
	
	private function execute_curl($url, $data)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('apikey: '.$this->get_api_key()));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
}
