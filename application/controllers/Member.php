<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller { 

    public function __construct() {
        parent::__construct();

        $this->load->model('easybro_model');
    }

    public function login() {
        if($this->isLogin()) {
            redirect('dashboard');
        }
        else {
            $this->load->view('member/login');
        }
    }

    public function loginProcess() {
        
    }

    private function isLogin() {
        if($this->session->username_member != '') {
            return true;
        }
        else {
            return false;
        }
    }
}