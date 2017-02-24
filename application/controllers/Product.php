<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

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
        //  $query = $this->Md->query("SELECT * FROM client where org = '" . $this->session->productdata('orgID') . "' ");
        $query = $this->Md->query("SELECT * FROM product");

        if ($query) {
            $data['products'] = $query;
        } else {
            $data['products'] = array();
        }
        $this->load->view('view-products', $data);
    }

    public function GUID() {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public function create() {

        $this->load->helper(array('form', 'url'));
        //product information
        // $productID = $this->GUID();
        $name = $this->input->post('name');

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
            $data = $this->upload->data();
            $userfile = $data['file_name'];
            $product = array('name' => $this->input->post('name'), 'description' => $this->input->post('description'), 'cost' => $this->input->post('cost'),'image' => $userfile,);
            $this->Md->save($product, 'product');

            $status .= '<div class="alert alert-success">  <strong>Information submitted</strong></div>';
            $this->session->set_flashdata('msg', $status);
            redirect('product', 'refresh');
        }
    }

    public function profile() {

        $this->load->helper(array('form', 'url'));
        $name = urldecode($this->uri->segment(3));
        $query = $this->Md->query("SELECT * FROM product where id ='" . $name . "'");

        if ($query) {
            $data['products'] = $query;
        } else {
            $data['products'] = array();
        }

        $this->load->view('product-profile', $data);
    }

    public function update() {

        $this->load->helper(array('form', 'url'));

        if (!empty($_POST)) {

            foreach ($_POST as $field_name => $val) {
                //clean post values
                $field_id = strip_tags(trim($field_name));
                $val = strip_tags(trim($val));
                //from the fieldname:product_id we need to get product_id
                $split_data = explode(':', $field_id);
                $product_id = $split_data[1];
                $field_name = $split_data[0];
                if (!empty($product_id) && !empty($field_name) && !empty($val)) {
                    //update the values
                    $task = array($field_name => $val);
                    // $this->Md->update($product_id, $task, 'tasks');
                    $this->Md->update_dynamic($product_id, 'id', 'product', $task);
                    echo "Updated";
                } else {
                    echo "Invalid Requests";
                }
            }
        } else {
            echo "Invalid Requests";
        }
    }   

    public function products() {
        //  $query = $this->Md->query("SELECT * FROM product WHERE  orgID='" . $this->session->productdata('orgID') . "'");
        $query = $this->Md->query("SELECT * FROM product");

        echo json_encode($query);
    }

    public function lists() {
        //  $query = $this->Md->query("SELECT * FROM client WHERE  orgID='" . $this->session->productdata('orgID') . "'");
        $query = $this->Md->query("SELECT * FROM product");
        echo json_encode($query);
    }

    public function delete() {

        $this->load->helper(array('form', 'url'));
        $id = urldecode($this->uri->segment(3));
        $query = $this->Md->delete($id, 'product');
        //cascade($id,$table,$field)
        //$query = $this->Md->cascade($id, 'product', 'id');
        if ($this->db->affected_rows() > 0) {

            $this->session->set_flashdata('msg', '<div class="alert alert-error">
                                                   
                                                <strong>
                                                Information deleted	</strong>									
						</div>');
            redirect('product', 'refresh');
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