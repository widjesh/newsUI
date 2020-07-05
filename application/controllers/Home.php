<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    private $userLevel;
    private $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("HomeModel", "model");

        $this->userLevel = $this->session->userdata('level');
        $this->user_id = $this->session->userdata('user_id');
        if ($this->userLevel < 2) {
            redirect('Dashboard');
        }
    }

    public function index()
    {
        $delete = intval($this->input->get("del"));
        if ($delete > 0) {
            if ($this->user_id != 2) {
                $this->model->delete_by_id($delete);
            }
            $viewData["message"] = "Item delete successfuly.";
        }

        $viewData["items"] = $this->model->all();
        $viewData["title"] = "Home items";
        $this->load->view('list/home', $viewData);
    }

    public function add()
    {
        $title = $this->input->post("title");
        $type = $this->input->post("type");
        $items = $this->input->post("items");
        $limit = intval($this->input->post("limit"));
        if (!empty($title) && !empty($items) && !empty($type) && $limit) {
            if ($this->user_id != 2) {
                $insertData = array(
                    'title' => $title,
                    'type'  => $type,
                    'items' => $items,
                    'length' => $limit
                );
                $insert = $this->model->insert($insertData);
                if ($insert) {
                    $viewData["message"] = "New item added successful.";
                } else {
                    $viewData["message"] = "System error. Please try again later.";
                }
            }else{
                $viewData["message"] = "You have not access for this.";
            }
        }

        $this->load->model('CategoryModel');
        $viewData['categories'] = $this->CategoryModel->all_list();
        $viewData["title"] = "Add home item";
        $this->load->view('add/home', $viewData);
    }

    public function sort()
    {
        $post_data = $this->input->post('sort');
        $output = array('data' => 0);
        if ($post_data) {
            $sort = json_decode($post_data, true);
            if (is_array($sort)) {
                $output['data'] = $this->model->update_sort($sort);
            }
        }
        $this->load->view('json', $output);
    }
}