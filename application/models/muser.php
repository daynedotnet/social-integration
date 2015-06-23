<?php
class Muser extends CI_Model {

	private $user_table = 'users';	
	private $users_friend_table = 'users_friends';	
	private $fb_friend_request_table = 'fb_friend_request';	
	private $users_notification_table = 'users_notification';	

	public function __construct() {
		parent::__construct();
	}

	public function &__get($key){
		$CI =& get_instance();
		return $CI->$key;
	}

	public function is_have_account($social_user_id){
        if(is_array($social_user_id)) extract($social_user_id);

		return $this->db->or_where('facebook_id',$social_user_id)
        ->or_where('twitter_id',$social_user_id)
        ->or_where('instagram_id',$social_user_id)
		->get($this->user_table)
		->num_rows();
	}
		
	public function get_user_total(){
		$query = $this->db->get($this->user_table);
		return $query->num_rows();
	}
	
	public function get_user_list(){
		$result = null;
		$query = $this->db->get($this->user_table);
			foreach($query->result() as $row) {
				$result[] = array(
					'user_id'           => $row->user_ID,
					'user_fname'        => $row->user_fname,
					'user_lname'        => $row->user_lname,
					'user_name'         => $row->user_name,
					'user_username'     => $row->user_username,
					'user_email'        => $row->user_email,
					'user_image'        => $row->user_image,
					'user_gender'       => $row->user_gender,
					'user_birthday'     => $row->user_birthday,
					'facebook_id'       => $row->facebook_id,
					'twitter_id'        => $row->twitter_id,
					'google_id'         => $row->google_id,
                    'social_media_id'   => $row->social_media_id,
					'date_created'      => $row->date_created
				);
			}
		return $result;
	}

	public function get_user_nameNimg($user_id){
		$this->db->select('user_ID, user_image, user_name, web_user_image, facebook_id, twitter_id,  google_id, social_media_id, is_online');
		$this->db->from($this->user_table);
		$this->db->where('user_ID', $user_id);
		$query = $this->db->get();
		$result = NULL;

		foreach($query->result() as $row) {

			$result['user_id'] = $row->user_ID;
			$result['user_name'] = $row->user_name;
			$result['user_image'] = $row->user_image;
                        $result['web_user_image'] = $row->web_user_image;
                        $result['facebook_id'] = $row->facebook_id;
                        $result['twitter_id']  =  $row->twitter_id;
                        $result['google_id']   = $row->google_id;
                        $result['social_media_id']  = $row->social_media_id;
                        $result['is_online']  = $row->is_online;
		}

		return $result;
	}

	public function get_name($user_id){
		$this->db->select('user_name');
		$this->db->from($this->user_table);
		$this->db->where('user_ID', $user_id);
		$query = $this->db->get();
		$result = NULL;

		foreach($query->result() as $row) {
			$result['user_name'] = $row->user_name;
		}

		return $result;
	}

	public function get_user($social_user_id){
        if(is_array($social_user_id)) extract($social_user_id);

		$query = $this->db->or_where('facebook_id', $social_user_id)
        ->or_where('twitter_id', $social_user_id)
        ->or_where('instagram_id', $social_user_id)
        ->or_where('user_email ='.$this->db->escape($social_user_id) .' AND social_media_id = 4')
		->get($this->user_table)
        ->result();
		
		$result = NULL;

		foreach($query as $row) {
			$result['user_id'] = $row->user_ID;
			$result['user_fname'] = $row->user_fname;
			$result['user_lname']=$row->user_lname;
			$result['user_name'] = $row->user_name;
			$result['user_email'] = $row->user_email;
			$result['user_image'] = $row->user_image;
            $result['web_user_image'] = $row->web_user_image;
			$result['user_gender'] = $row->user_gender;
			$result['facebook_id'] = $row->facebook_id;
			$result['twitter_id'] = $row->twitter_id;
			$result['instagram_id'] = $row->instagram_id;
            $result['social_media_id'] = $row->social_media_id;
			$result['date_created'] = $row->date_created;
		}
                    
		return $result;
	}

	public function save_user($params = array()){
        if(empty($params)) return FALSE;
		$this->db->insert($this->user_table, $params);
	}
        
    public function updateLastLogin($where_params = array()){
		if(!empty($where_params) && is_array($where_params)){
		   $this->db->set('login_count','login_count+1',FALSE);
		   $this->db->where($where_params);
		   if($this->db->update('users', array('last_login'=>date('Y-m-d H:i:s'))))
		           return TRUE;
		}
		return FALSE;
    }//public function updateLastLogin
        
        
        public function update_user($param){
		extract($param);
		$data = array(
			'user_fname'        => $user_fname,
			'user_lname'        => $user_lname,
			'user_name'         => $user_name,
			'user_username'     => $user_username,
			'user_email'        => $user_email,
			'user_image'        => $user_image,
			'user_gender'       => $user_gender,
			'user_birthday'     => $user_birthday,
                        'last_login'        => $last_login
                );
                $this->db->set('login_count','login_count+1',FALSE);
                if(!empty($facebook_id) && $facebook_id !== 0){
                    $this->db->where(array('facebook_id'=>$facebook_id));
                    $this->db->update($this->user_table, $data);                                
                }elseif(!empty($twitter_id) && $twitter_id !== 0){
                    $this->db->where(array('twitter_id'=>$twitter_id));
                    $this->db->update($this->user_table, $data);                                
                }elseif(!empty($google_id) && $google_id !== 0){
                    $this->db->where(array('google_id'=>$google_id));
                    $this->db->update($this->user_table, $data);                                
                }

        }
        
        public function  update_web_user_image($params = array()){
            
                extract($params);
                
        	$data = array(
			'web_user_image' => $web_user_image,
                );
 
		$this->db->or_where('facebook_id', $user_social_id);
                $this->db->or_where('twitter_id', $user_social_id);
                $this->db->or_where('google_id', $user_social_id); 
                $this->db->or_where('user_email ='.$this->db->escape($user_social_id) .' AND social_media_id = '.$social_media_id);
                
                return $this->db->update($this->user_table, $data);                                                

         }//public function update_user_web_image
         
         
         public function update_birthdate($params = array()){
                //$this->output->enable_profiler(true);
                extract($params);
                if(empty($user_id) || empty($user_birthday)) return FALSE;
                $this->db->where(array('user_ID'=>$user_id));
                if($this->db->update($this->user_table, array('user_birthday'=>date('Y-m-d H:i:s', strtotime($user_birthday)) ))){
                    $fb_user = $this->session->userdata('fb_user');
                    $fb_user['user_birthday'] = date('Y-m-d H:i:s', strtotime($user_birthday));
                    $this->session->set_userdata('fb_user', $fb_user);
                    return TRUE;
                }
                return FALSE;
         }//update_update_birthdate

	// ========================================================================== users_friend

	public function get_user_id_by_fb_id($fb_user_id)
	{
		$this->db->select('user_ID');
		$this->db->from($this->user_table);
		$this->db->or_where('facebook_id', $fb_user_id);
                $this->db->or_where('twitter_id', $fb_user_id);
                $this->db->or_where('google_id', $fb_user_id);
		$query = $this->db->get();
		
		$result = NULL;

		foreach($query->result() as $row) {
			$result[] = array('user_id'	=> $row->user_ID);
		}

		return $result;
	}

	public function get_friends_id_from_friend_list($user_id, $friend_id)
	{
		$this->db->where('user_ID', $user_id);
		$this->db->where('friend_ID', $friend_id);
		$query = $this->db->get($this->users_friend_table);
		return $query->num_rows();
	}

	public function get_friend_list($user_id) {

		$result = null;

		$this->db->select(' users.user_image, 
                                    users.web_user_image, 
                                    users.facebook_id, 
                                    users.twitter_id, 
                                    users.google_id, 
                                    users.social_media_id, 
                                    users_friends.user_ID, 
                                    users_friends.friend_ID, 
                                    users.user_name,
                                    users.is_online');
		$this->db->from('users_friends');
		$this->db->join('users', 'users.user_ID = users_friends.friend_ID');
		$this->db->where('users_friends.user_ID',$user_id);
                $this->db->order_by('users.is_online', 'DESC');
		$this->db->order_by('users.user_name', 'ASC');
		$query = $this->db->get();

		if($query) {	
			foreach($query->result() as $row) {
				$result[] = array(
						'friend_ID'         => $row->friend_ID,
						'user_id'           => $row->user_ID,
						'user_name'         => $row->user_name,
						'user_image'        => $row->user_image,
                                                'web_user_image'    => $row->web_user_image,
                                                'facebook_id'       => $row->facebook_id,
                                                'twitter_id'        => $row->twitter_id,
                                                'google_id'         => $row->google_id,       
                                                'is_online'         => $row->is_online,
                                                'social_media_id'   =>$row->social_media_id
				);
			}
		}

		return $result;
	}

	public function save_to_friend_list($param)
	{
		extract($param);
		$data = array(
			'user_ID'		=> $user_ID,
			'friend_ID'		=> $friend_ID,
			'date_created' 	=> $date_created
        );

		$this->db->insert($this->users_friend_table, $data);
	}

	// ========================================================================== friend request

	public function save_fb_friend_request($param)
	{
		extract($param);
		$data = array(
			
			'fb_request_ID'	=> $fb_request_ID,
			'inviter_fb_ID'	=> $inviter_fb_ID,
			'invited_fb_ID' => $invited_fb_ID
        );

		$this->db->insert($this->fb_friend_request_table, $data);
	}

	public function count_fb_friend_request($facebook_id)
	{
		$this->db->where('invited_fb_ID',$facebook_id);
		$query = $this->db->get($this->fb_friend_request_table);
		return $query->num_rows();
	}

	public function get_fb_friend_request($facebook_id)
	{
		$result = null;
		$this->db->or_where('invited_fb_ID',$facebook_id);
		$query = $this->db->get($this->fb_friend_request_table);

		if($query) {	
			foreach($query->result() as $row) {
				$result[] = array(
					'fb_request_ID'	=> $row->fb_request_ID,
					'inviter_fb_ID'	=> $row->inviter_fb_ID,
					'invited_fb_ID' => $row->invited_fb_ID
				);
			}
		}

		return $result;
	}

	// ========================================================================== user notification

	public function save_notifications($param)
	{
		extract($param);
		$data = array(
			
			//'notification_ID'=> $notification_ID,
			'user_ID'=> $user_ID,
			'title'=> $title,
			'view'=> $view,
			'type'=> $type,
			'hangout_ID' => $hangout_ID,
			'date_created'=>$date_created
        );

		$this->db->insert($this->users_notification_table, $data);
	}

	public function get_notifications($user_id) 
	{
		$result = null;

		$this->db->select('users_notification.notification_ID, 
						   users_notification.user_ID, 
						   users_notification.type, 
						   users_notification.title, 
						   users_notification.view,
						   users_notification.date_created, 
						   users_notification.hangout_ID, 
						   users_notification.creator_ID, 
						   users_notification.movie_ID');

		$this->db->from($this->users_notification_table);
		$this->db->join('users_notification', 'users_notification.hangout_ID = users_hangouts.hangout_ID', 'left');
		//$this->db->join('users', 'users.user_ID = users_hangouts.user_ID', 'left');
		$this->db->where('users_notification.user_ID',$user_id);
		$this->db->order_by('users_notification.date_created', 'DESC');
		$query = $this->db->get();

		if($query->num_rows() > 0) {	
			foreach($query->result() as $row) {
				$result['notification_ID'] = $row->notification_ID;
				$result['user_ID']= $row->user_ID;
				$result['type']= $row->type;
				$result['title']= $row->title;
				$result['view']= $row->view;
				$result['date_created']= $row->date_created;
				$result['hangout_ID']= $row->hangout_ID;
				$result['creator_ID']= $row->creator_ID;
				$result['movie_ID']= $row->movie_ID;
			}
		}

		return $result;
	}//public function get_notifications($user_id)

	public function get_notifications_list($user_id)
	{
		$result = null;
		$this->db->where('user_ID',$user_id);
		$this->db->order_by('date_created', 'DESC');
		$query = $this->db->get($this->users_notification_table);

		if($query) {	
			foreach($query->result() as $row) {

				$result[] = array(
					'notification_ID'=> $row->notification_ID,
					'user_ID'=> $row->user_ID,
					'title'=> $row->title,
					'view'=> $row->view,
					'type'=> $row->type,
					'hangout_ID' => $row->hangout_ID,
					'date_created'=>$row->date_created
				);
			}
		}

		return $result;

	}

        /**
         * Function updateNotificationAsRead
         * 
         * Updates view field of users_notifications table  to indicate notification as read.
         * 
         * @param array() $param This array requires the user_ID, notification_ID and view index. If user_ID or notification_ID is missing
         *                        no update will occur.
         * @return mixed   Return query result or return NULL if user_ID or notification_ID index of $param array is missing. 
         */
	public function updateNotificationAsRead($param = array())
	{
		extract($param);

                if(empty($user_ID) && empty($notification_ID)) return NULL;
                $this->db->set('view', 'view+1', FALSE);
		$this->db->where('user_ID',(int)$user_ID);
		$this->db->where('notification_ID', (int)$notification_ID);
		$query = $this->db->update($this->users_notification_table);
                return $query;
	}
        
        /**
         * DEPRECATED
         * Function updateNotificationAsRead
         * 
         * Updates view field of users_notifications table  to indicate notification as read.
         * 
         * @param array() $param This array requires the user_ID, notification_ID and view index. If user_ID or notification_ID is missing
         *                        no update will occur.
         * @return mixed   Return query result or return NULL if user_ID or notification_ID index of $param array is missing. 
         */        
	public function update_notification_view($param = array())
	{
		extract($param);

                if(empty($user_ID) && empty($notification_ID)) return NULL;
                $this->db->set('view', 'view+1', FALSE);
		$this->db->where('user_ID',(int)$user_ID);
		$this->db->where('notification_ID', (int)$notification_ID);
		$query = $this->db->update($this->users_notification_table);
                return $query;
	}        
        
        /**
         * Function update_deleted_notification_view
         * 
         * Updates the view field of users_notification table to indicate type 3 notification (one that signifies deleted) as read
         * @param mixed $param  This array requires the user_ID and view index. If user_ID is missing no update will occur.
         * @return mixed    Return $query result of NULL if user_ID is missing
         */
        public function update_deleted_notification_view($param)
	{
		extract($param);
		$data = array('view'=>$view);
                
                if(empty($user_ID)) return NULL;
		$this->db->where('user_ID',$user_ID);
                $this->db->where('type', 3);
		$query = $this->db->update($this->users_notification_table, $data);
                return $query;
                
	}//public function update_deleted_notification_view

	public function delete_notifications($notification_ID)
	{
		$this->db->where('notification_ID',$notification_ID);
		$this->db->delete($this->users_notification_table);
	}
        
        
        public function get_user_notification_count($user_id = NULL, $date_last_view = NULL){
            if(empty($user_id)) return NULL;
		$this->db->select('COUNT(*) AS count');
		$this->db->from('users_notification');
                $this->db->where('users_notification.user_ID', $user_id);
                $this->db->where('view <= 0');
                if(!empty($date_last_view)){
                    $this->db->where('users_notification.date_created >', $date_last_view);
                }
                $this->db->limit(1);
		$query = $this->db->get();

		return $query->row()->count;                  
        }//public function get_user_notification_count
        
        
        public function get_notifications_unread_count($user_id = NULL){
            if(empty($user_id)) return NULL;
		$this->db->select('COUNT(*) AS count');
		$this->db->from('users_notification');
                $this->db->where('users_notification.user_ID', $user_id);
                $this->db->where('view <= 0');
                $this->db->limit(1);
		$query = $this->db->get();

		return $query->row()->count;             
        }//public function get_notifications_unread_count
        
        public function get_user_watch_history($params = array()){

                if(empty($params['user_id'])) return FALSE;
                $query_user = $this->db->get_where('users',array('user_ID'=>$params['user_id']));
                if($query_user->num_rows() <= 0){
                    return NULL;
                }
                $this->db->select('uh.history_ID, uh.date_created, m.movie_ID, m.title',FALSE);
                $this->db->from('users_history AS uh');
                $this->db->join('movies AS m','uh.movie_ID = m.movie_ID');
                $this->db->where(array('user_ID'=>$params['user_id']));
                $this->db->order_by('uh.date_created','DESC');
                $query_history = $this->db->get();    
                if($query_history->num_rows() > 0){

                        return $query_history->result();
                    
                }
                
                return NULL;
                
       }//public function get_user_watch_history
       
       
       public function clear_user_watch_history($params = array()){
           
                if(empty($params['user_id']) || empty($params['history_id'])) return FALSE;
                $query_user = $this->db->get_where('users',array('user_ID'=>$params['user_id']));
                if($query_user->num_rows() <= 0){
                    return FALSE;
                }
                
                if($params['history_id'] == 'all'){
                    unset($params['history_id']);
                    $query_history = $this->db->get_where('users_history',array('user_ID'=>$params['user_id']));
                }else{
                    $query_history = $this->db->get_where('users_history',array('history_ID'=>$params['history_id'], 'user_ID'=>$params['user_id']));
                }
                if($query_history->num_rows() <= 0){
                    return FALSE;
                }
                if($this->db->delete('users_history',$params)){
                    return TRUE;
                }
                
       }//public function clearMovieHistory         

}