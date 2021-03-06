<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

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

        $query = $this->Md->query("SELECT *,product.name AS product,store.name AS store,inventory.id AS id FROM inventory LEFT JOIN store ON store.id = inventory.storeID LEFT JOIN product ON product.id = inventory.productID");
    
        if ($query) {
            $data['dis'] = $query;
        } else {
            $data['dis'] = array();
        }
        $this->load->view('view-inventory', $data);
    }
    
      public function package() {

        $query = $this->Md->query("SELECT *,package.name AS package,store.name AS store,package_inventory.id AS id FROM package_inventory LEFT JOIN store ON store.id = package_inventory.storeID LEFT JOIN package ON package.id = package_inventory.packageID");
    
        if ($query) {
            $data['dis'] = $query;
        } else {
            $data['dis'] = array();
        }
        $this->load->view('view-inventory-package', $data);
    }

    public function GUID() {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public function create() {
        $this->load->helper(array('form', 'url'));
      
        if ($this->input->post('productID') != "") {
            
            $comp = array('productID' => $this->input->post('productID'),'storeID'=>$this->input->post('storeID'),'quantity'=>$this->input->post('quantity'));
            $this->Md->save($comp, 'inventory');
            $status .= '<div class="alert alert-success">  <strong>Information submitted</strong></div>';
            $this->session->set_flashdata('msg', $status);
            redirect('inventory', 'refresh');
        }
    }
    
    public function create_package() {
        $this->load->helper(array('form', 'url'));
      
        if ($this->input->post('packageID') != "") {
            
            $comp = array('packageID' => $this->input->post('packageID'),'storeID'=>$this->input->post('storeID'),'qty'=>$this->input->post('qty'),'date'=>  date('d-m-Y'));
            $this->Md->save($comp, 'package_inventory');
            $status .= '<div class="alert alert-success">  <strong>Information submitted</strong></div>';
            $this->session->set_flashdata('msg', $status);
            redirect('inventory/package', 'refresh');
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
                    echo "Updated Inventory ".$user_id." ".$val;
                } else {
                    echo "Invalid Requests";
                }
            }
        } else {
            echo "Invalid Requests";
        }
    }

    public function lists() {
        $query = $this->Md->query("SELECT * FROM inventory");
        //$query = $this->Md->query("SELECT * FROM client");
        echo json_encode($query);
    }

    public function delete() {

        $this->load->helper(array('form', 'url'));
        $id = urldecode($this->uri->segment(3));

        $query = $this->Md->cascade($id, 'inventory', 'id');

        if ($this->db->affected_rows() > 0) {

            $this->session->set_flashdata('msg', '<div class="alert alert-error">
                                                   
                                                <strong>
                                                Information deleted	</strong>									
						</div>');
            redirect('inventory', 'refresh');
        }
    }

}
