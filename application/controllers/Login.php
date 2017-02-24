<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {

        parent::__construct();
        //error_reporting(E_PARSE);
        $this->load->model('Md');
        $this->load->library('session');
        $this->load->library('encrypt');
        date_default_timezone_set('Africa/Kampala');
    }

    public function submit() {

        $this->load->helper(array('form', 'url'));

      
        $get_result = $this->Md->query("SELECT *,user.name AS username,organisation.name AS org,organisation.orgID as orgID,user.contact AS usercontact,user.email AS useremail FROM user INNER JOIN organisation ON user.orgID = organisation.orgID WHERE (user.name ='" . $this->input->post('name') . "' OR user.contact ='" . $this->input->post('name') . "' OR user.email = '" . $this->input->post('name') . "' ) AND user.password = '" . md5($this->input->post('password')) . "' ");
       // var_dump($get_result);
        if (is_array($get_result)&& count($get_result)>0) {
            foreach ($get_result as $res) {
               
                    $newdata = array(
                        'userID' => $res->userID,
                        'username' => $res->username,
                        'orgID' => $res->orgID,
                        'org' => $res->org,
                        'email' => $res->email,
                        'useremail' => $res->useremail,
                        'usercontact' => $res->usercontact,
                        'image' => $res->image,
                        'contact' => $res->contact,
                        'address' => $res->address,
                        'status' => $res->status,
                        'logged_in' => TRUE
                    );

                    $this->session->set_userdata($newdata);
                    redirect('home', 'refresh');
               
            }
        } else {
            echo 'F';
            $this->session->set_flashdata('msg', '<div class="alert alert-error">  <strong>  ! User does not exist</div>');
            redirect('welcome', 'refresh');
        }
    }

    public function logout() {

        $this->session->sess_destroy();
        redirect('welcome', 'refresh');
    }

}
