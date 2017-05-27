<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('Md');
        $this->load->library('session');
        $this->load->library('encrypt');
    }

    public function index() {

        $this->load->view('login-page');
    }

    public function version() {

        $this->load->view('version');
    }

    public function home() {
        if ($this->session->userdata('name') != "") {
            $this->load->view('home-page');
            return;
        } else {

            $this->session->sess_destroy();
            redirect('welcome', 'refresh');
            return;
        }
    }

    public function page() {

        $this->load->view('page');
    }

    public function register() {

        $this->load->view('register-page');
    }

    public function logout() {

        $this->session->sess_destroy();
        redirect('welcome', 'refresh');
    }

    public function login() {

        $this->load->helper(array('form', 'url'));

        $get_result = $this->Md->query("SELECT *,user.id AS userID,role.name AS role,role.actions AS permission,user.name AS name,user.contact AS contact,user.email AS email,user.image AS image FROM user LEFT JOIN role ON role.id = user.role WHERE (user.name ='" . $this->input->post('name') . "' OR user.contact ='" . $this->input->post('name') . "' OR user.email = '" . $this->input->post('name') . "' ) AND user.password = '" . md5($this->input->post('password')) . "' ");
        // var_dump($get_result);
        // return;
        if (is_array($get_result) && count($get_result) > 0) {
            foreach ($get_result as $res) {
                $storeID = $this->Md->query_cell("SELECT id FROM store where id= '" . $res->store . "'", 'id');
                $store = $this->Md->query_cell("SELECT name FROM store where id= '" . $res->store . "'", 'name');

                $newdata = array(
                    'userID' => $res->userID,
                    'name' => $res->name,
                    'email' => $res->email,
                    'contact' => $res->contact,
                    'image' => $res->image,
                    'permission' => $res->permission,
                    'storeID' => $storeID,
                    'store' => $store,
                    'views' => $res->views,
                    'role' => $res->role,
                    'active' => $res->active
                );

                $this->session->set_userdata($newdata);
                redirect('/welcome/home', 'refresh');
            }
        } else {
            echo 'F';
            $this->session->set_flashdata('msg', '<div class="alert alert-error">  <strong>  ! User does not exist</div>');
            redirect('welcome', 'refresh');
        }
    }

    public function student() {
        $this->load->view('private');
    }

    public function info() {

        $this->load->view('info-page', $data);
    }

    public function help() {

        $this->load->view('help-page', $data);
    }

    public function management() {

        $cty = $this->session->userdata('country');

        $name = $this->session->userdata('name');
        $query = $this->Md->get('reciever', $name, 'chat');
//  var_dump($query);
        if ($query) {
            $data['chats'] = $query;
        } else {
            $data['chats'] = array();
        }
        $query = $this->Md->query("SELECT * FROM outbreak where country = '" . $cty . "'");
//  var_dump($query);
        if ($query) {
            $data['outbreaks'] = $query;
        } else {
            $data['outbreaks'] = array();
        }

        $query = $this->Md->query("SELECT * FROM publication where country = '" . $cty . "'");
//  var_dump($query);
        if ($query) {
            $data['pubs'] = $query;
        } else {
            $data['pubs'] = array();
        }
        $query = $this->Md->query("SELECT * FROM student where status = 'false'");
//  var_dump($query);
        if ($query) {
            $data['student_cnt_false'] = $query;
        } else {
            $data['student_cnt_false'] = array();
        }

        $query = $this->Md->query("SELECT * FROM publication where verified = 'false'");
//  var_dump($query);
        if ($query) {
            $data['publication_cnt_review'] = $query;
        } else {
            $data['publication_cnt_review'] = array();
        }
        $query = $this->Md->query("SELECT * FROM publication where accepted = 'no'");
//  var_dump($query);
        if ($query) {
            $data['publication_cnt_accepted'] = $query;
        } else {
            $data['publication_cnt_accepted'] = array();
        }

        $query = $this->Md->query("SELECT * FROM presentation where accepted = 'no'");
//  var_dump($query);
        if ($query) {
            $data['present_cnt_accepted'] = $query;
        } else {
            $data['present_cnt_accepted'] = array();
        }


        $this->load->view('center_page', $data);
    }

    public function projects() {

        $query = $this->Md->show('project');
        if ($query) {
            $data['projects'] = $query;
        } else {
            $data['projects'] = array();
        }


        $this->load->view('projects', $data);
    }

    public function services() {

        $query = $this->Md->show('service');
        if ($query) {
            $data['services'] = $query;
        } else {
            $data['services'] = array();
        }
        $this->load->view('services', $data);
    }

    public function profile() {

        $query = $this->Md->show('profile');
        if ($query) {
            $data['profiles'] = $query;
        } else {
            $data['profiles'] = array();
        }
        $this->load->view('profile', $data);
    }

    public function contact() {
        $this->load->view('contact');
    }

    public function project() {
        $this->load->view('project');
    }

}
