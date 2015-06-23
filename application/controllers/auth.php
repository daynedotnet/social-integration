<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		session_start();

        $CI =& get_instance();
        $this->load->model('connection');   

		$this->cur_class = strtolower(__CLASS__);
	}

    public function index(){
        $data['title']      = 'cPanel - Login';
        $data['user_data']    = $this->array_to_object($this->session->userdata('user_data'));
        $data['fb_pages'] = $this->connection->fb_pages();

        foreach($this->connection->fb_pages()['data'] as $info){ 
            $data['pages'] = $info;
            $data['profile_image'] = '<img src="https://graph.facebook.com/'.$info['id'].'/picture?access_token='.$info['access_token'].'">';
            $data['news_feed'] = 'https://graph.facebook.com/'.$info['id'].'/feed?access_token='.$info['access_token'];
            $data['publish'] = 'https://graph.facebook.com/'.$info['id'].'/feed?access_token='.$info['access_token'].'
                        &name=Facebook API: Posting As A Page
                        &from='.FACEBOOK_APPID.'
                        &to='.$info['id'].'
                        &link=https://www.webniraj.com/2012/08/09/facebook-api-posting-as-a-page/
                        &caption=The Facebook API lets you post to Pages you own automatically - either as real-time updates or in the case that you want to schedule posts.
                        &message=Check out my new blog post!';
            // $data['publish'] = $this->fb_wall_post();
        }

        $this->load->view($this->cur_class.'_view', $data);
    }

    public function fb_connect(){
        $this->connection->fb_connect();
    }

    public function fb_wall_post(){
        $this->connection->fb_wall_post($_FILES['pic'], $this->input->post('page_id'));
    }

    public function fb_logout(){
        $this->connection->fb_logout();   
    }

    public function fb_pages_album(){
        $this->connection->fb_pages_album('519506148202780');
    }

	public function hello(){
        try{ 
            $ret_obj= $this->facebook->api('/me/accounts');
            $this->renderpages($ret_obj);    

        }catch(FacebookApiException $e){
            error_log($e->getType());
            error_log($e->getMessage());
        }
	}

	private function array_to_object($array_to_convert){
        if (is_array($array_to_convert) || is_object($array_to_convert)){
            $result= new stdClass();
            foreach ($array_to_convert as $key => $value){
                $result->$key = $this->array_to_object($value);
            }
            return $result;
        }
        return $array_to_convert;
    }

}