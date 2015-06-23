<?php
class Connection extends CI_Model {
    
    private $dbtable = 'main';
    private $client = NULL;
    
    public function __construct(){
        parent::__construct();
        $CI = & get_instance();
        $CI->config->load("facebook",TRUE);
        $config = $CI->config->item('facebook');
        $config = array('appId'=>FACEBOOK_APPID,'secret'=>FACEBOOK_SECRET,'fileUpload' => true);

        $this->load->model('muser');
        $this->load->library('Facebook', $config);

        $this->fb_userid = $this->facebook->getUser();
    }

    public function &__get($key){
        $CI =& get_instance();
        return $CI->$key;
    }

    public function fb_connect(){
        if($this->fb_userid <= 0){
            $fb_url  = $this->facebook->getLoginUrl(array('scope'=>'manage_pages, publish_actions, publish_pages, create_event, email'));
            if(is_null($fb_url)) echo "no internet connection";
                $redirect = $fb_url;
                redirect(filter_var($redirect, FILTER_SANITIZE_URL));
            exit;
        }else{
            $fb_user            = $this->facebook->api('/me?fields=id,name,first_name,last_name,email,gender,picture');
            $fb_pages           = $this->facebook->api('/me/accounts');
            $is_have_account    = $this->muser->is_have_account($fb_user['id']);

            if($is_have_account <= 0){
                $param = array(
                    'user_fname'    => $fb_user['first_name'],
                    'user_lname'    => $fb_user['last_name'],
                    'user_name'     => $fb_user['name'],
                    'user_email'    => isset($fb_user['email']) ? $fb_user['email'] : NULL,
                    'user_image'    => 'https://graph.facebook.com/'.$fb_user['id'].'/picture',
                    'user_gender'   => isset($fb_user['gender']) ? $fb_user['gender'] : NULL,
                    'facebook_id'   => $fb_user['id'],
                    'twitter_id'    => 0,
                    'instagram_id' => 0,
                                        'social_media_id' => 1,
                                        'login_count'   => 1,
                                        'last_login'    => date('Y-m-d H:i:s'),
                    'date_created'  => date('Y-m-d H:i:s')
                );

                copy("https://graph.facebook.com/". $fb_user["id"]."/picture?width=145&height=145", 'uploads/user_images/fb_'.$fb_user['id'].'.jpg');                                
                $param['web_user_image'] = 'fb_'.$fb_user['id'].'.jpg';

                $this->muser->save_user($param);
            }

            $user_data = $this->muser->get_user($fb_user['id']);
        }

        $this->session->set_userdata(array('user_data' => $user_data));
        redirect(filter_var(base_url(), FILTER_SANITIZE_URL));
        exit;
    }

    public function fb_logout(){ 
        $user = $this->session->userdata('user_data');

        $this->output->set_header('cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header("cache-Control: post-check=0, pre-check=0", false);
        $this->output->set_header("Pragma: no-cache");

        $this->session->unset_userdata('user_data');

        setcookie('PHPSESSID', '', time()-3600, '/');
        
        $this->db->where(array('user_ID'=>$user['user_id']))
        ->update('users', array('is_online'=>0));
        redirect(base_url());    
    }

    public function fb_pages(){
        return $this->facebook->api('/me/accounts');
    }

    public function post(){
        $this->facebook->api('/me/129764920688329/feed', 'post',
                array('access_token' => 'CAAW34bvEwQEBANxk2mFm717Xa5WNLd36vucD1o1xd6dAVawVILJZAJ6jGmZCp4Lh7jKZCQQ1ZAoJ9RsK6YuRsr3TV00lHL0hNcdNZCujj6fLwzponfrhJ8iBE9uz9ZCZBqBNyQJWk7ZCZAGgqFnYhZBAXkIdJXiqu9kbuDjyvgZBmOun0WihIv85ohJ',
                'message'=> 'Hi po',
                'from' => FACEBOOK_APPID,
                'to' => '129764920688329',
                'caption' => 'Caption',
                'name' => 'Name',
                'link' => 'http://www.example.com/',
                'picture' => 'http://www.phpgang.com/wp-content/themes/PHPGang_v2/img/logo.png',
                'description' => 'via demo.PHPGang.com'
            ));
    }

    public function fb_wall_post($photos, $page_id){
        try{
            $page_info = $this->facebook->api("/$page_id?fields=access_token");
            if(!empty($page_info['access_token'])){
                $album_id = '519520931534635';

                foreach($photos['tmp_name'] as $photo) {
                    $source[] = realpath($photo);
                }

                $args = array(
                        'access_token'  => $page_info['access_token'],
                        'message'       => '#daynedotnet',
                        'source'        => '@'.$source[0],
                        'aid'           => $album_id
                );

                $this->facebook->api($album_id . '/photos', 'post', $args);

                echo 'hello';
            }else{
                echo 'hi';
            }
        }catch (FacebookApiException $e){
            echo $e->getMessage();
            exit;
        }

        // var_dump($photos['tmp_name']);

        // foreach($photos['tmp_name'] as $photo) {
        //     $source[] = realpath($photo);'[@'.$source[0],'@'.$source[1].']'
        // }

        // var_dump($source);

        // $page_album = $this->facebook->api("/$page_id/albums");

        // $permissions = $this->facebook->api('/me/permissions');
        // return $permissions;
    }

    public function fb_pages_album($page_id){
        $page_album = $this->facebook->api("/$page_id/albums");
        var_dump($page_album);
    }

}