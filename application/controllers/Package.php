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

    public function view() {

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
        $this->load->view('view-packages', $data);
    }

    public function details() {

        $this->load->helper(array('form', 'url'));
        $ID = trim($this->input->post('packageID'));
        $start = trim(date('d-m-Y', strtotime($this->input->post('start'))));
        $period = trim($this->input->post('period'));
        $end = trim(date('d-m-Y', strtotime('+' . $period . ' month', strtotime($start))));
        $paid = trim($this->input->post('paid'));

        $months = $period;
        echo '<div class="panel-body container">';
        $get_result = $this->Md->query("SELECT * FROM  package  WHERE package.id='" . $ID . "'");
        // var_dump($get_result);
        if (!$get_result) {
            echo '<span style="color:#f00"> No information in the database </strong> does not exist in our database</span>';
        } else {

            echo ' <div class="form-group">
                    <label ">End date</label>                     
                            <input type="text" name="end" value="' . $end . '"  class="form-control"/>
                     
                    </div>';
            foreach ($get_result as $res) {
                $costing = $res->cost;
                $initial = $res->initial;
                $interest = $res->interest;

                echo ' <div class="form-group row">
                    <label class="col-sm-4">Cost</label>
                        <div class="col-sm-4 ">
                            <input type="text" name="cost" value="' . $res->cost . '"  class="receipt"/>
                        </div>
                    </div>';
                echo '<input type="hidden" name="package" value="' . $res->id . '"  class="receipt"/>';

                $pc = $this->Md->query("SELECT id,name,cost FROM product");
                echo ' <div class="form-group">';
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
       
        
        $fiveDays = date("d-m-Y", strtotime($start . "+" . $days_paid . "days"));
        if ($balance > 0) {
            $complete = "false";
        } else {
            $complete = "true";
        }
       

        echo '<div>';
        $interest = $interest;
        $cost = $costing;
        $initial = $initial;

        $initial_pay = ($initial / 100) * $cost;
        echo'<div class="form-group">
                            <label>Down payment</label>
                            <input type="number" name="down" value="' . $initial_pay . '" placeholder="Down payment" id="down"  class="form-control"/>
                        </div>';


        $debt_principal = $cost - $initial_pay;
        echo ' <div class="form-group row">
                    <label class="col-sm-4">Balance</label>
                        <div class="col-sm-4 ">
                            <input type="text" name="balance" value="' . $debt_principal . '"  class="receipt"/>
                        </div>
                    </div>';
         $days = ($months * 4.33) * 7;

       
        $interest_on_loan = ($interest / 100) * $debt_principal;

        $total_loan = $debt_principal + $interest_on_loan;
         echo ' <div class="form-group row">
                    <label class="col-sm-4">Period(Days)</label>
                        <div class="col-sm-2 ">
                            <input type="text" name="days" value="' . round($days ). '"  class="receipt"/>
                        </div>
                        <label class="col-sm-4">Daily cost</label>
                        <div class="col-sm-2 ">
                            <input type="text" name="daily" value="' .round(($total_loan / $days), -3) . '"  class="receipt"/>
                        </div>
                    </div>';
             echo ' <div class="form-group row">
                    <label class="col-sm-4">Period(Months)</label>
                        <div class="col-sm-2 ">
                            <input type="text" name="months" value="' . round($months) . '"  class="receipt"/>
                        </div>
                         <label class="col-sm-4">Monthly cost</label>
                        <div class="col-sm-2 ">
                            <input type="text" name="monthly" value="' . round(($total_loan  / $months), -3) . '"  class="receipt"/>
                        </div>
                    </div>';



        $monthly_12 = ($total_loan / 12);
        $monthly_9 = ($total_loan / 9);
        $monthly_6 = (($total_loan / 6) );
        $monthly_3 = (($total_loan / 3));
        $weekly_12 = round(($monthly_12 / 4.33), -3);
        $daily_12 = round(($weekly_12 / 7), -2);
        $weekly_9 = round(($monthly_9 / 4.33), -3);
        $daily_9 = round(($weekly_9 / 7), -2);
        $weekly_6 = round(($monthly_6 / 4.33), -3);
        $daily_6 = round(($weekly_6 / 7), -2);
        $weekly_3 = round(($monthly_3 / 4.33), -3);
        $daily_3 = round(($weekly_3 / 7), -2);


        echo '<table style="width:100%">
  <tr>
    <th>MONTHS</th>
    <th>DAILY</th> 
    <th>WEEKLY</th>
    <th>MONTHLY</th>
    <th>TOTAL</th>
  </tr>
  <tr>
    <td>3</td>
    <td>' . number_format($daily_3) . '</td> 
    <td>' . number_format($weekly_3) . '</td>
    <td>' . number_format($monthly_3) . '</td> 
    <td>' . number_format($total_loan) . '</td>
  </tr>
  <tr>
    <td>6 </td>
    <td>' . number_format($daily_6) . '</td> 
    <td>' . number_format($weekly_6) . '</td>
    <td>' . number_format($monthly_6) . '</td> 
    <td>' . number_format($total_loan) . '</td>
  </tr>
  <tr>
    <td>9 </td>
     <td>' . number_format($daily_9) . '</td> 
    <td>' . number_format($weekly_9) . '</td>
    <td>' . number_format($monthly_9) . '</td> 
    <td>' . number_format($total_loan) . '</td>
  </tr>
  <tr>
    <td>12</td>
    <td>' . number_format($daily_12) . '</td> 
    <td>' . number_format($weekly_12) . '</td>
    <td>' . number_format($monthly_12) . '</td> 
    <td>' . number_format($total_loan) . '</td>
  </tr>
</table>';
    }

    public function payments() {

        $this->load->helper(array('form', 'url'));

        $interest = $this->input->post('interest');
        $cost = $this->input->post('cost');
        $initial = $this->input->post('initial');
// $interest = 25;
//        $cost = 360000;
//        $initial = 20;
        $initial_pay = ($initial / 100) * $cost;

        $debt_principal = $cost - $initial_pay;
        $interest_on_loan = ($interest / 100) * $debt_principal;

        $total_loan = $debt_principal + $interest_on_loan;

        $monthly_12 = ($total_loan / 12);
        $monthly_9 = ($total_loan / 9);
        $monthly_6 = (($total_loan / 6) );
        $monthly_3 = (($total_loan / 3));
        $weekly_12 = round(($monthly_12 / 4.33), -3);
        $daily_12 = round(($weekly_12 / 7), -2);
        $weekly_9 = round(($monthly_9 / 4.33), -3);
        $daily_9 = round(($weekly_9 / 7), -2);
        $weekly_6 = round(($monthly_6 / 4.33), -3);
        $daily_6 = round(($weekly_6 / 7), -2);
        $weekly_3 = round(($monthly_3 / 4.33), -3);
        $daily_3 = round(($weekly_3 / 7), -2);


        echo '<table style="width:100%">
  <tr>
    <th>MONTHS</th>
    <th>DAILY</th> 
    <th>WEEKLY</th>
    <th>MONTHLY</th>
    <th>TOTAL</th>
  </tr>
  <tr>
    <td>3</td>
    <td>' . number_format($daily_3) . '</td> 
    <td>' . number_format($weekly_3) . '</td>
    <td>' . number_format($monthly_3) . '</td> 
    <td>' . number_format($total_loan) . '</td>
  </tr>
  <tr>
    <td>6 </td>
    <td>' . number_format($daily_6) . '</td> 
    <td>' . number_format($weekly_6) . '</td>
    <td>' . number_format($monthly_6) . '</td> 
    <td>' . number_format($total_loan) . '</td>
  </tr>
  <tr>
    <td>9 </td>
     <td>' . number_format($daily_9) . '</td> 
    <td>' . number_format($weekly_9) . '</td>
    <td>' . number_format($monthly_9) . '</td> 
    <td>' . number_format($total_loan) . '</td>
  </tr>
  <tr>
    <td>12</td>
    <td>' . number_format($daily_12) . '</td> 
    <td>' . number_format($weekly_12) . '</td>
    <td>' . number_format($monthly_12) . '</td> 
    <td>' . number_format($total_loan) . '</td>
  </tr>
</table>';
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
            $comp = array('itemIDS' => $encode, 'products' => $productString, 'name' => $this->input->post('name'), 'initial' => $this->input->post('initial'), 'description' => $this->input->post('description'), 'interest' => $this->input->post('interest'), 'discount' => $this->input->post('discount'), 'cost' => $this->input->post('cost'));
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
