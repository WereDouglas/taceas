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
        if ($this->session->userdata('username') != "") {

            $query = $this->Md->query("SELECT * FROM sync_data where org = '" . $this->session->userdata('orgid') . "' ");
            //  var_dump($query);
            if ($query) {
                $data['logs'] = $query;
            } else {
                $data['logs'] = array();
            }

            $query = $this->Md->query("SELECT * FROM users WHERE types='client' AND org = '" . $this->session->userdata('orgid') . "'");
            //  var_dump($query);
            if ($query) {
                $data['clients'] = $query;
            } else {
                $data['clients'] = array();
            }
            $query = $this->Md->query("SELECT * FROM schedule where org = '" . $this->session->userdata('orgid') . "' and dated ='" . date('Y-m-d') . "'");
            //  var_dump($query);
            if ($query) {
                $data['schedules'] = $query;
            } else {
                $data['schedules'] = array();
            }
            $query = $this->Md->query("SELECT * FROM schedule where org = '" . $this->session->userdata('orgid') . "' and dated ='" . date('d-m-Y') . "'");
            //  var_dump($query);
            if ($query) {
                $data['schedules'] = $query;
            } else {
                $data['schedules'] = array();
            }
            $query = $this->Md->query("SELECT * FROM files where org = '" . $this->session->userdata('orgid') . "'");
            //  var_dump($query);
            if ($query) {
                $data['files'] = $query;
            } else {
                $data['files'] = array();
            }

            $this->load->view('home', $data);
        } else {

            $this->session->sess_destroy();
            redirect('welcome', 'refresh');
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
        
          $this->load->view('home-page');
          return;

        $this->load->helper(array('form', 'url'));
        $email = $this->input->post('email');
        $password_now = $this->input->post('password');
        $get_user = $this->Md->check($email, 'email', 'users');

        if (!$get_user) {

            $results = $this->Md->get('email', $email, 'users');
            //var_dump($results);
            foreach ($results as $resv) {
                $key = $email;
                $password = $this->encrypt->decode($resv->password, $key);
                $org = $res->org;

                $orgs = $this->Md->get('id', $resv->org, 'organisation');
                foreach ($orgs as $res) {
                    $name = $res->name;
                    $orgimage = $res->image;
                    $starts = $res->starts;
                    $ends = $res->ends;
                    $code = $res->code;
                    $license = $res->keys;
                    $address = $res->address;
                    $emails = $res->sync;
                }
                $this->session->set_userdata('name', $name);
                $this->session->set_userdata('orgimage', $orgimage);
                $this->session->set_userdata('address', $address);
                $this->session->set_userdata('starts', $starts);
                $this->session->set_userdata('ends', $ends);
                $this->session->set_userdata('code', $code);
                $this->session->set_userdata('emails', $emails);
                $this->session->set_userdata('license', $license);
                $this->session->set_userdata('username', $resv->name);
                $this->session->set_userdata('orgid', $resv->org);

                $newdata = array(
                    'id' => $resv->id,
                    'email' => $resv->email,
                    'userimage' => $resv->image,
                    'title' => $resv->types,
                    'level' => $resv->level,
                    'status' => $resv->status,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);
            }

            if ($password_now == $password) {
                redirect('/welcome/home', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-error">  <strong>  ! invalid login credentials</div>');
                redirect('welcome', 'refresh');
            }
        } else {

            $this->session->set_flashdata('msg', '<div class="alert alert-error">  <strong>  ! This user does not exist</div>');
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
