<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    function __construct() {
        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('Md');
        $this->load->library('session');
        $this->load->library('encrypt');
        date_default_timezone_set('Africa/Kampala');
        $this->load->library('excel');
    }

    public function index() {

        $query = $this->Md->query("SELECT * FROM payment");

        if ($query) {
            $data['dis'] = $query;
        } else {
            $data['dis'] = array();
        }
        $this->load->view('view-payment', $data);
    }

    public function view() {
        $this->load->helper(array('form', 'url'));
        $id = urldecode($this->uri->segment(3));

        $query = $this->Md->query("SELECT * FROM payment WHERE accountID = '" . $id . "'");

        if ($query) {
            $data['dis'] = $query;
        } else {
            $data['dis'] = array();
        }
        $this->load->view('view-payment', $data);
    }

    public function add() {

        $query = $this->Md->query("SELECT *,product.name AS product,store.name AS store,inventory.id AS id FROM inventory LEFT JOIN store ON store.id = inventory.storeID LEFT JOIN product ON product.id = inventory.productID");

        if ($query) {
            $data['dis'] = $query;
        } else {
            $data['dis'] = array();
        }
        $this->load->view('new-pay', $data);
    }

    public function pay() {

        $query = $this->Md->query("SELECT *,product.name AS product,store.name AS store,inventory.id AS id FROM inventory LEFT JOIN store ON store.id = inventory.storeID LEFT JOIN product ON product.id = inventory.productID");

        if ($query) {
            $data['dis'] = $query;
        } else {
            $data['dis'] = array();
        }
        $this->load->view('view-pay', $data);
    }

    public function details() {

        $this->load->helper(array('form', 'url'));
        $ID = trim($this->input->post('customerID'));
        $paid = trim($this->input->post('paid'));

        $date1 = new DateTime($start);
        $date2 = new DateTime($end);
        $diff = $date2->diff($date1)->format("%a");
        $interval = date_diff($date1, $date2);
        $months = $interval->m + ($interval->y * 12) . ' months';
        echo '<div class="panel-body container">';
        $get_result = $this->Md->query("SELECT * FROM  account  WHERE customerID='" . $ID . "'");

        if (!$get_result) {
            echo '<span style="color:#f00"> No information in the database </strong> does not exist in our database</span>';
        } else {
            echo '
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="col-sm-12" >Please select the account</label>
                        <select class="form-control" id="account" name="account">
                            <option value="">Select account ...</option>';
            foreach ($get_result as $res) {

                echo '<option value="' . $res->id . '">' . 'ACC ' . $res->id . '</option> ';
            }
            echo '</select> </div></div>';
        }
    }

    public function GUID() {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public function create() {
        
        $this->load->helper(array('form', 'url'));

        if ($this->input->post('account') != "") {
           
                $user = array('accountID' => $this->input->post('account'), 'date' => date('d-m-Y'), 'amount' => $this->input->post('paid'), 'interest' => $this->input->post('interest'), 'discount' => $this->input->post('discount'), 'commission' => $this->input->post('commission'), 'previous' => date("d-m-Y", strtotime($this->input->post('ending'))), 'current' => $this->input->post('enddate'), 'period' => $this->input->post('period'));
                $this->Md->save($user, 'payment');
                
            $task = array('balance' => $this->input->post('balance'),'start' => date("d-m-Y", strtotime($this->input->post('ending'))), 'end' => $this->input->post('enddate'), 'complete' => $this->input->post('complete'));
                    // $this->Md->update($user_id, $task, 'tasks');
           $this->Md->update_dynamic($this->input->post('account'), 'id', 'account', $task);
            
            $status .= '<div class="alert alert-success">  <strong>Information submitted</strong></div>';
            $this->session->set_flashdata('msg', $status);
            redirect('payment/', 'refresh');
        }
        else{
            
              
            $status .= '<div class="alert alert-success">  <strong>Missing account details</strong></div>';
            $this->session->set_flashdata('msg', $status);
            redirect('payment/pay', 'refresh');
        }
    }

    public function update() {

        $this->load->helper(array('form', 'url'));

        if (!empty($_POST)) {

            foreach ($_POST as $field_name => $val) {
                //clean post values
                $field_id = strip_tags(trim($field_name));
                $val = strip_tags(trim($val));
                //from the fieldname:user_id we need to get user_id
                $split_data = explode(':', $field_id);
                $user_id = $split_data[1];
                $field_name = $split_data[0];
                if (!empty($user_id) && !empty($field_name) && !empty($val)) {
                    //update the values
                    $task = array($field_name => $val);
                    // $this->Md->update($user_id, $task, 'tasks');
                    $this->Md->update_dynamic($user_id, 'id', 'inventory', $task);
                    echo "Updated Inventory " . $user_id . " " . $val;
                } else {
                    echo "Invalid Requests";
                }
            }
        } else {
            echo "Invalid Requests";
        }
    }

    public function lists() {
        $query = $this->Md->query("SELECT * FROM payment");
        //$query = $this->Md->query("SELECT * FROM client");
        echo json_encode($query);
    }

    public function delete() {

        $this->load->helper(array('form', 'url'));
        $id = urldecode($this->uri->segment(3));

        $query = $this->Md->cascade($id, 'payment', 'id');

        if ($this->db->affected_rows() > 0) {

            $this->session->set_flashdata('msg', '<div class="alert alert-error">
                                                   
                                                <strong>
                                                Information deleted	</strong>									
						</div>');
            redirect('payment', 'refresh');
        }
    }

}
