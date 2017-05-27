<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('Md');
        $this->load->library('session');
        $this->load->library('encrypt');
        date_default_timezone_set('Africa/Kampala');
        $this->load->library('excel');
        $this->load->library('email');
    }

    public function index() {
        //  $query = $this->Md->query("SELECT * FROM client where org = '" . $this->session->userdata('orgID') . "' ");
        $query = $this->Md->query("SELECT *,customer.name AS customer,agent.name AS agent,package.name AS package,account.id AS id  FROM account LEFT JOIN customer ON customer.id = account.customerID LEFT JOIN agent ON agent.id = account.agentID LEFT JOIN package ON package.id = account.packageID");

        if ($query) {
            $data['accs'] = $query;
        } else {
            $data['accs'] = array();
        }
        $this->load->view('view-accounts', $data);
    }

    public function GUID() {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public function details() {

        $this->load->helper(array('form', 'url'));
        $ID = trim($this->input->post('accountID'));
        $paid = trim($this->input->post('paid'));
        $start = trim($this->input->post('start'));

        $starting = new DateTime($start);


        $get_result = $this->Md->query("SELECT *,agent.name AS agent,account.id AS id FROM  account LEFT JOIN agent ON agent.id= account.agentID  WHERE account.id='" . $ID . "'");

        if (!$get_result) {
            echo '<span style="color:#f00"> No information in the database </strong> does not exist in our database</span>';
        } else {
            foreach ($get_result as $res) {

                echo 'Agent<input type="text" name="agent" value="' . $res->agent . '"  class="receipt"/>';
                echo 'Starts :' . $res->start . ' Ends: ' . $res->end;
                echo '<br>' . ' Expires : ' . $res->expiry;
                echo '<br>' . 'Commission : ' . $res->commission . '%<br>';
                echo '' . 'Daily : ' . number_format($res->daily) . '<br>';
                echo '' . 'Monthly : ' . number_format($res->monthly) . '<br>';
                //$months = $paid / $res->monthly;

                $days_paid = round($paid / $res->daily) . '';

                $fiveDays = date("d-m-Y", strtotime($res->end . "+" . $days_paid . "days"));
                $balance = $res->balance - $paid;
                if ($balance > 0) {
                    $complete = "false";
                } else {
                    $complete = "true";
                }
                $interest = (($res->interest) / 100) * $paid;
                $discount = (($res->discount ) / 100) * $paid;
                $commission = (($res->commission) / 100) * $paid;
                $get_result2 = $this->Md->query("SELECT * FROM  package  WHERE package.id='" . $res->packageID . "'");

                if (!$get_result2) {
                    echo '<span style="color:#f00"> No information in the database </strong> does not exist in our database</span><br>';
                } else {
                    echo '<span style="color:#D3DCE3"> PACKAGE DETAILS</strong></span>';

                    foreach ($get_result2 as $res2) {
                        echo '<input type="hidden" name="package" value="' . $res2->id . '"  class="receipt"/><br>';

                        $pc = $this->Md->query("SELECT id,name,cost FROM product");

                        $ct = 0;
                        $cost = 0;
                        echo '<table id="items">
                     <tr>
		      <th>Item</th>
		      <th>Description</th>
		      <th>Unit Cost</th>
		      
		  </tr>';
                        foreach ($pc as $bus) {
                            $ct = $ct + 1;
                            if (strpos($res2->products, $bus->id) !== false) {
                                $cost = $cost + $bus->cost;
                                echo ' <tr class="item-row">
		      <td class="item-name">' . $ct . '</td>

		      <td class="description">' . $bus->name . '</td>
		      <td class=""><font color="green">' . number_format($bus->cost) . '</font></td>
		     
		  </tr>';
                            }
                        }
                        echo ' <tr class="item-row">
		      <td class="item-name"></td>

		      <td class="description"><strong style="color:#D3DCE3">TOTAL:</strong></td>
		      <td class="total-value balance"><font color="green">' . number_format($cost) . '</font></td>
		     
		  </tr>';
                        echo '</table>';
                    }
                }
                echo '<table id="items">
                     <tr>
		     
		      <th>Description</th>
		      <th>Unit Cost</th>
		      
		  </tr>';



                echo '
                    
                     
		  <tr class="item-row">
                  <td><strong style="color:#D3DCE3">Start date:</strong></td>
		   <td><input type="text" name="ending" value="' . $res->end . '"  class="receipt"/></td>
		     
		  </tr>
                
                <tr>
                    <td><strong style="color:#D3DCE3"> Ending date:</strong></td>
                    <td><input type="text" name="enddate" value="' . $fiveDays . '"  class="receipt"/></td>
                </tr>
                <tr>

                   
                    <td class="total-value balance" ><strong style="color:#D3DCE3" > Balance:</strong></td>
                    <td ><input type="text" name="balance" value="' . $balance . '"  class="receipt"/></td>
                </tr>
                <tr>       
                    <td><strong style="color:#D3DCE3">Complete:</strong></td>
                    <td><input type="text" name="complete" value="' . $complete . '"  class="receipt"/></td>
                </tr>
                <tr>
                    <td><strong style="color:#D3DCE3">Period :</strong> </td>
                    <td><input type="text" name="period" value="' . $days_paid . '"  class="receipt"/></td>

                </tr>
                <tr>                   
                    <td><strong style="color:#D3DCE3">Interest:</strong></td>
                    <td><input type="text" name="interest" value="' . $interest . '"  class="receipt"/></td>
                </tr>
                <tr>                   
                    <td><strong style="color:#D3DCE3">Discount:</strong></td>
                    <td><input type="text" name="discount" value="' . $discount . '"  class="receipt"/></td>
                </tr>
                <tr>                   
                    <td><strong style="color:#D3DCE3"> Commission:</strong></td>
                    <td><input type="text" name="commission" value="' . $commission . '"  class="receipt"/></td>
                </tr>

            ';
                echo '</table>';
            }
        }
    }

    public function create() {

        $this->load->helper(array('form', 'url'));
        //user information
        // $userID = $this->GUID();
        $name = $this->input->post('name') . ' ' . $this->input->post('last_name');

        if ($name != "") {
            ///organisation image uploads
            $file_element_name = 'userfile';
            $config['file_name'] = $this->input->post('name');
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = FALSE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'errors';
                $msg = $this->upload->display_errors('', '');
                $status .= '<div class="alert alert-error"> <strong>' . $msg . '</strong></div>';
            }
            $paid = $this->input->post('paid');


            $data = $this->upload->data();
            $userfile = $data['file_name'];
            $comp = array('name' => $this->input->post('name'), 'contact' => $this->input->post('contact'), 'email' => $this->input->post('email'), 'nok' => $this->input->post('nok'), 'agentID' => $this->input->post('agentID'), 'image' => $userfile, 'created' => date('Y-m-d H:i:s'), 'village' => $this->input->post('village'), 'subcounty' => $this->input->post('subcounty'), 'district' => $this->input->post('district'), 'idno' => $this->input->post('idno'), 'kin_name' => $this->input->post('kin_name'), 'kin_contact' => $this->input->post('kin_contact'), 'kin_district' => $this->input->post('kin_district'), 'relationship' => $this->input->post('relationship'), 'lc' => $this->input->post('lc'));
            $last_id = $this->Md->save($comp, 'customer');
            if ($last_id) {
                $user = array('customerID' => $last_id, 'agentID' => $this->input->post('agentID'), 'start' => date("d-m-Y", strtotime($this->input->post('start'))), 'end' => date("d-m-Y", strtotime($this->input->post('enddate'))), 'created' => date('Y-m-d'), 'expiry' => date("d-m-Y", strtotime($this->input->post('end'))), 'cost' => $this->input->post('cost'), 'packageID' => $this->input->post('packageID'), 'productID' => $this->input->post('productID'), 'interest' => $this->input->post('interestID'), 'period' => $this->input->post('period'), 'daily' => $this->input->post('daily'), 'monthly' => $this->input->post('monthly'), 'commission' => $this->input->post('commission'), 'meterNo' => $this->input->post('meterNo'), 'complete' => $this->input->post('complete'), 'active' => $this->input->post('active'), 'balance' => $this->input->post('balance'), 'installation_cost' => $this->input->post('installation'), 'installed_by' => $this->input->post('installed_by'), 'barcode' => $this->input->post('barcode'), 'vpc' => $this->input->post('region'));
                $account_id = $this->Md->save($user, 'account');

                $packageID = $this->input->post('packageID');
                $qty = $this->Md->query_cell("SELECT qty FROM package_inventory WHERE storeID= '" . $this->session->userdata('storeID') . "' AND packageID= '" . $packageID . "'", 'qty');
                $ID = $this->Md->query_cell("SELECT id FROM package_inventory WHERE storeID= '" . $this->session->userdata('storeID') . "' AND packageID= '" . $packageID . "'", 'id');

                $bal = $qty - $this->input->post('qty');
                $task = array('qty' => $bal);                
                $this->Md->update_dynamic($ID, 'id', 'package_inventory', $task);
            }
            if ($account_id) {
                $user = array('accountID' => $account_id, 'date' => date('d-m-Y'), 'amount' => $this->input->post('totalPay'), 'interest' => $interest, 'discount' => $discount, 'commission' => $commission, 'previous' => date("d-m-Y", strtotime($this->input->post('start'))), 'current' => $this->input->post('enddate'), 'period' => $this->input->post('period'));
                $account_id = $this->Md->save($user, 'payment');
            }
            $status .= '<div class="alert alert-success">  <strong>Information submitted</strong></div>';
            $this->session->set_flashdata('msg', $status);
            redirect('account', 'refresh');
        }
    }

    public function profile() {

        $this->load->helper(array('form', 'url'));
        $name = urldecode($this->uri->segment(3));
        $query = $this->Md->query("SELECT * FROM user where id ='" . $name . "'");

        if ($query) {
            $data['users'] = $query;
        } else {
            $data['users'] = array();
        }

        $this->load->view('user-profile', $data);
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
                    $this->Md->update_dynamic($user_id, 'id', 'user', $task);
                    echo "Updated";
                } else {
                    echo "Invalid Requests";
                }
            }
        } else {
            echo "Invalid Requests";
        }
    }

    public function reset() {
        $password = $this->generateRandomString();

        $userID = trim($this->input->post('id'));
        // $userid = 'CB501C98-74B4-4480-BFBE-6447CF3BBB18';
        //query_cell($string, $cell)
        $email = $this->Md->query_cell("SELECT * FROM user where id= '" . $userID . "'", 'email');
        if ($email == "") {
            echo 'No email specified';
            return;
        }
        $key = $email;
        $password_new = $this->encrypt->encode($password, $key);
        $newer = $password;

        $user = array('password' => $password_new);
        $this->Md->update($userID, $user, 'user');
        echo 'New Password is reset please check mail( SPAM MAIL ESPECIALLY ) ' . $password;

        $reciever = $this->Md->query_cell("SELECT email FROM users WHERE id ='$userID' ", 'email');
        $body = $reciever . ' Your Password has been changed to  <b>' . $newer . '</b> for Estate professional login panel';
        $subject = 'Password reset,changed password Online Property Professional Account ';

        //$mail = array('message' => $message, 'subject' => $subject, 'schedule' => date('d-m-Y'), 'reciever' => $email, 'created' => date('Y-m-d H:i:s'), 'org' => "", 'sent' => 'false', 'guid' => '');
        //$this->Md->save($mail, 'emails');

        $from = "noreply@estateprofessional.pro";
        // $subject = " ";
        if ($email != "") {

            $this->email->from($from, 'Estate professionl');
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($body);
            $this->email->send();
            echo $this->email->print_debugger();
            echo "email has been sent";
            //return;
        }
    }

    public function update_profile() {
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
                    $this->Md->update_dynamic($user_id, 'id', 'user', $task);
                    echo "Updated";
                } else {
                    echo "Invalid Requests";
                }
            }
        } else {
            echo "Invalid Requests";
        }
    }

    public function update_password() {

        $this->load->helper(array('form', 'url'));
        //user information
        $this->load->library('email');
        $password = $this->input->post('password');
        //$password = '123456';
        $this->load->helper(array('form', 'url'));
        $id = $this->input->post('userID');
        $email = $this->Md->query_cell("SELECT email FROM user WHERE userID ='" . $id . "'", 'email');
        $name = $this->Md->query_cell("SELECT name FROM user WHERE userID='" . $id . "'", 'name');

        $new_password = md5($password);

        $info = array('password' => $new_password);
        $this->Md->update_dynamic($id, 'userID', 'user', $info);

        $body = $name . '  ' . ' Your password has been reset to ' . $password . " Please click the link below to access your Case Professional account: caseprofessional.org";

        $from = "noreply@estateprofessional.pro";
        $subject = "Password reset ";
        if ($email != "") {

            $this->email->from($from, 'Estate professionl');
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($body);
            $this->email->send();
            echo $this->email->print_debugger();
            echo "email has been sent";
            //return;
        }

        echo 'INFORMATION UPDATED';
        $this->session->set_flashdata('msg', '<div class="alert alert-success">  <strong>USER PASSWORD CHANGED</strong></div>');

        redirect('/user/profile/' . $name, 'refresh');
    }

    public function update_image() {

        $this->load->helper(array('form', 'url'));
        //user information

        $userID = $this->input->post('userID');
        $namer = $this->input->post('namer');

        $fileUrl = $this->Md->query_cell("SELECT image FROM user WHERE userID ='" . $userID . "'", 'image');

        $this->Md->file_remove($fileUrl, 'uploads');
        $file_element_name = 'userfile';
        // $new_name = $userID;
        $config['file_name'] = $userID;
        $config['upload_path'] = 'uploads/';
        $config['encrypt_name'] = FALSE;
        $config['allowed_types'] = 'jpg';
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_element_name)) {
            $status = 'error';
            $msg = $this->upload->display_errors('', '');
            $this->session->set_flashdata('msg', '<div class="alert alert-error"> <strong>' . $msg . '</strong></div>');
            redirect('/user/profile/' . $userID, 'refresh');

            return;
        }
        $data = $this->upload->data();
        $userfile = $data['file_name'];
        $user = array('image' => $userfile);
        $this->Md->update_dynamic($userID, 'userID', 'user', $user);

        $this->session->set_flashdata('msg', '<div class="alert alert-success">  <strong>Image updated saved</strong></div>');

        redirect('/user/profile/' . $userID, 'refresh');
    }

    public function users() {
        //  $query = $this->Md->query("SELECT * FROM user WHERE  orgID='" . $this->session->userdata('orgID') . "'");
        $query = $this->Md->query("SELECT * FROM user");

        echo json_encode($query);
    }

    public function lists() {
        //  $query = $this->Md->query("SELECT * FROM client WHERE  orgID='" . $this->session->userdata('orgID') . "'");
        $query = $this->Md->query("SELECT * FROM user");
        echo json_encode($query);
    }

    public function delete() {

        $this->load->helper(array('form', 'url'));
        $id = urldecode($this->uri->segment(3));
        $query = $this->Md->delete($id, 'user');
        //cascade($id,$table,$field)
        //$query = $this->Md->cascade($id, 'user', 'id');
        if ($this->db->affected_rows() > 0) {

            $this->session->set_flashdata('msg', '<div class="alert alert-error">
                                                   
                                                <strong>
                                                Information deleted	</strong>									
						</div>');
            redirect('user', 'refresh');
        }
    }

    public function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}

?>