<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

    public function __construct() {
    	parent::__construct();
        
        $this->load->model('musers');
        $this->load->model('mgeneral');
        $this->load->model('mhome');
        $this->load->library('breadcrumbs');

        $this->musers->access();        
        $this->usertype = $this->musers->usertype();
        $this->userinfo = $this->mgeneral->getUserInfo($this->mgeneral->getCurrUserId());
        $this->support = $this->mgeneral->getSupport();
        $this->cur_class = strtolower(__CLASS__);
    }

    public function _remap($method) {
        $method = camelize($method);
        if(method_exists($this, $method))
            $this->$method();
        else
            show_error ('Page not found.');
    }

    public function index() {
    	$page['title'] = 'cPanel - Dashboard';
        $page['header'] = 'Dashboard';
        $data['pageInfo'] = $page;

        $data['userType'] = $this->usertype;
        $data['userName'] = $this->userinfo['name'];
        $data['userLevel'] = $this->userinfo['account_type'];
        $data['support'] = $this->support;
        $data['results'] = null;

        $this->breadcrumbs->push('Dashboard', '#');
            
        $this->load->view('main/'.$this->cur_class.'_view', $data);
    }

    public function export() {
        $csv_file_name =  uniqid('csv_report_', true) .'.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$csv_file_name.'"');
        if (isset($_POST['csv'])) {
            $csv = $_POST['csv'];
            echo $csv;
        }
    }

}
