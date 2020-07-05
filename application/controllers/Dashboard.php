<?php

/**
 * Created by PhpStorm.
 * User: Miko
 * Date: 7/13/2017
 * Time: 10:35 PM
 */
class Dashboard extends CI_Controller
{
    public function index()
    {
        $this->load->model("NewsModel");
        $this->load->model("CategoryModel");
        $this->load->model("UserModel");

        $viewData['news'] = $this->NewsModel->get_count();
        $viewData['category'] = $this->CategoryModel->get_count();
        $viewData['users'] = $this->UserModel->get_count();
        $viewData['views'] = $this->NewsModel->view_count();
        $viewData['items'] = $this->NewsModel->get_all(0, array('is_active' => 1, 'id,title,published_at,views'));

        $this->load->view('dashboard', $viewData);
    }
}