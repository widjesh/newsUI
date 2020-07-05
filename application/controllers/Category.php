<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{
    private $userLevel;
    private $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("CategoryModel");
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
            $this->CategoryModel->delete_by_id($delete);
            $viewData["message"] = "Category delete successfuly.";
        }

        $config["base_url"] = base_url() . $this->router->fetch_class();
        $config["total_rows"] = $this->CategoryModel->get_count();
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $page = $this->input->get('page') ? $this->input->get('page') : 0;
        $items = $this->CategoryModel->get_all($page);

        $viewData["items"] = $items;
        $viewData["title"] = "Category list";
        $this->load->view('list/category', $viewData);
    }

    public function add()
    {
        $title = $this->input->post("title");
        if (!empty($title)) {
            $check = $this->CategoryModel->get(array('title' => $title));
            if ($check) {
                $viewData['message'] = 'This category already added.';
            } else {
                $config['upload_path'] = './assets/images/category/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 5 * 1024;
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    $viewData["message"] = $this->upload->display_errors();
                } else {
                    $insertData = array(
                        'title' => $title,
                        'image' => base_url('assets/images/category/') . $this->upload->data('file_name'));
                    $insert = (int)$this->CategoryModel->insert($insertData);
                }
                if (isset($insert) && $insert > 0) {
                    $viewData["message"] = "New category added successful. Category ID: " . $insert;
                }else{
                    $viewData["message"] = "System error. Please try again later.";
                }
            }
        }

        $viewData["title"] = "Add Category";
        $this->load->view('add/category', $viewData);
    }

    public function edit($id)
    {
        $category = $this->CategoryModel->get(array('id' => $id));

        $title = $this->input->post("title");
        if (!empty($title)) {
            $check = $this->CategoryModel->get(array('title' => $title,'id !='=>$id));
            if ($check) {
                $viewData['message'] = 'This category already added.';
            } else {
                $config['upload_path'] = './assets/images/category/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 5 * 1024;
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);

                $updateData = array('title' => $title);
                if ($this->upload->do_upload('image')) {
                    $updateData['image'] = base_url('assets/images/category/') . $this->upload->data('file_name');
                }

                $update = $this->CategoryModel->update($updateData, array('id' => $id));
                if (isset($update) && $update) {
                    $category = $this->CategoryModel->get(array('id' => $id));
                    $viewData["message"] = "Category successful updated.";
                }
            }
        }

        $viewData['item'] = $category;
        $viewData["title"] = "Edit Category: " . $category->title;
        $this->load->view('edit/category', $viewData);
    }
}
