<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

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

        $query = $this->Md->query("SELECT * FROM package");

        if ($query) {
            $data['dis'] = $query;
        } else {
            $data['dis'] = array();
        }
        $query = $this->Md->query("SELECT id,name,cost FROM product");

        if ($query) {
            $data['prods'] = $query;
        } else {
            $data['prods'] = array();
        }
        $this->load->view('view-package', $data);
    }

    public function details() {

        $this->load->helper(array('form', 'url'));
        $ID = trim($this->input->post('packageID'));
        $start = trim(date('d-m-Y', strtotime($this->input->post('start'))));
        $end = trim(date('d-m-Y', strtotime($this->input->post('end'))));
        $interest = trim(date('d-m-Y', strtotime($this->input->post('interest'))));
        $paid = trim($this->input->post('paid'));

        $date1 = new DateTime($start);
        $date2 = new DateTime($end);
        $diff = $date2->diff($date1)->format("%a");
        $interval = date_diff($date1, $date2);
        $months = $interval->m + ($interval->y * 12) . ' months';
        echo '<div class="panel-body container">';
        $get_result = $this->Md->query("SELECT * FROM  package  WHERE package.id='" . $ID . "'");
        // var_dump($get_result);
        if (!$get_result) {
            echo '<span style="color:#f00"> No information in the database </strong> does not exist in our database</span>';
        } else {
            foreach ($get_result as $res) {

                echo ' <div class="form-group row">
                    <label class="col-sm-4">Cost</label>
                        <div class="col-sm-4 ">
                            <input type="text" name="cost" value="' . $res->cost . '"  class="receipt"/>
                        </div>
                    </div>';
                echo '<input type="hidden" name="package" value="' . $res->id . '"  class="receipt"/>';

                $pc = $this->Md->query("SELECT id,name,cost FROM product");
                echo ' <div class="form-group row">';
                $ct = 0;
                $cost = 0;
                foreach ($pc as $bus) {
                    $ct = $ct + 1;
                    if (strpos($res->products, $bus->id) !== false) {
                        $cost = $cost + $bus->cost;
                        echo ' <div class="col-sm-4 "><font color="green">' . $ct . '. ' . $bus->name . ' ' . number_format($bus->cost) . '</font></div>' . '<br>';
                    }
                }
                echo ' <strong>TOTAL:</strong><font color="red" style="margin-left:50px;">' . number_format($cost) . '</font>' . '<br>';
                echo ' </div>';
            }
        }
        $overtotal = (($interest / 100) * $cost) + $cost;
        $balance = $overtotal - $paid;
        echo ' <div class="form-group row">
                    <label class="col-sm-4">Period(Days)</label>
                        <div class="col-sm-2 ">
                            <input type="text" name="days" value="' . $diff . '"  class="receipt"/>
                        </div>
                        <label class="col-sm-4">Daily cost</label>
                        <div class="col-sm-2 ">
                            <input type="text" name="daily" value="' . round($overtotal / $diff) . '"  class="receipt"/>
                        </div>
                    </div>';
        echo 'DAYS PAID ' . $days_paid = round($paid / (round($overtotal / $diff)));

        $fiveDays = date("d-m-Y", strtotime($start . "+" . $days_paid . "days"));
        if ($balance > 0) {
            $complete = "false";
        } else {
            $complete = "true";
        }
        //echo '<br>'. $fiveDays; // Will output 2015-06-20

        echo ' <div class="form-group row">
                    <label class="col-sm-4">Period(Months)</label>
                        <div class="col-sm-2 ">
                            <input type="text" name="months" value="' . round($months) . '"  class="receipt"/>
                        </div>
                         <label class="col-sm-4">Monthly cost</label>
                        <div class="col-sm-2 ">
                            <input type="text" name="monthly" value="' . round($overtotal / $months) . '"  class="receipt"/>
                        </div>
                    </div>';
         echo ' <div class="form-group row">
                    <label class="col-sm-4">Ending date</label>
                        <div class="col-sm-4 ">
                            <input type="text" name="startdate" value="' . $fiveDays . '"  class="receipt"/>
                        </div>
                    </div>';

        echo ' <div class="form-group row">
                    <label class="col-sm-4">Ending date</label>
                        <div class="col-sm-4 ">
                            <input type="text" name="enddate" value="' . $fiveDays . '"  class="receipt"/>
                        </div>
                    </div>';
        echo ' <div class="form-group row">
                    <label class="col-sm-4">Balance</label>
                        <div class="col-sm-4 ">
                            <input type="text" name="balance" value="' . $balance . '"  class="receipt"/>
                        </div>
                    </div>';
       
        echo ' <div class="form-group row">
                    <label class="col-sm-4">Complete</label>
                        <div class="col-sm-4 ">
                            <input type="text" name="complete" value="' . $complete . '"  class="receipt"/>
                        </div>
                    </div>';
        echo ' <div class="form-group row">
                    <label class="col-sm-4">Period</label>
                        <div class="col-sm-4 ">
                            <input type="text" name="period" value="' . $days_paid . '"  class="receipt"/>
                        </div>
                    </div>';

        echo '<div>';
    }

    public function GUID() {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public function create() {
        $this->load->helper(array('form', 'url'));
        $product = $this->input->post('productID');
        $productString = "";
        if ($this->input->post('productID') != "") {
            foreach ($product as $t) {
                $productString .= $t . '.';
            }
            $encode = json_encode($product);
            $comp = array('itemIDS' => $encode, 'products' => $productString, 'name' => $this->input->post('name'), 'description' => $this->input->post('description'), 'interest' => $this->input->post('interest'), 'discount' => $this->input->post('discount'), 'cost' => $this->input->post('cost'));
            $this->Md->save($comp, 'package');
            $status .= '<div class="alert alert-success">  <strong>Information submitted</strong></div>';
            $this->session->set_flashdata('msg', $status);
            redirect('package', 'refresh');
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
                    $this->Md->update_dynamic($user_id, 'id', 'package', $task);
                    echo "Updated";
                } else {
                    echo "Invalid Requests";
                }
            }
        } else {
            echo "Invalid Requests";
        }
    }

    public function lists() {
        $query = $this->Md->query("SELECT * FROM package");
        //$query = $this->Md->query("SELECT * FROM client");
        echo json_encode($query);
    }

    public function delete() {

        $this->load->helper(array('form', 'url'));
        $id = urldecode($this->uri->segment(3));

        $query = $this->Md->cascade($id, 'package', 'id');

        if ($this->db->affected_rows() > 0) {

            $this->session->set_flashdata('msg', '<div class="alert alert-error">
                                                   
                                                <strong>
                                                Information deleted	</strong>									
						</div>');
            redirect('package', 'refresh');
        }
    }

}
