<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller
{
    private $userData;

    public function __construct()
    {
        parent::__construct();

        $this->userData = $this->session->userdata();
        $this->load->model("NewsModel");
        $this->load->model("CategoryModel");
    }

    public function index($category_id = 0)
    {
        $post_id = $this->input->post("id");
        $active = intval($this->input->post("active"));
        if ($post_id) {
            $news = $this->NewsModel->get(array('id' => $post_id));
            if ($news->author_id != $this->userData['user_id'] && $this->userData['level'] < 2) echo 0;
            else echo $this->NewsModel->update(array("is_active" => $active), array("id" => $post_id));
            exit;
        }

        $news_id = $this->input->post("news_id");
        $featured = intval($this->input->post("featured"));
        if ($news_id) {
            if ($this->userData['level'] < 2) echo 0;
            else echo $this->NewsModel->update(array("featured" => $featured), array("id" => $news_id));
            exit;
        }

        $delete = intval($this->input->get("del"));
        if ($delete > 0) {
            $news = $this->NewsModel->get(array('id' => $delete));
            if ($news->author_id != $this->userData['user_id'] && $this->userData['level'] < 2) {
                $viewData["message"] = "You have not access delete news.";
            } else {
                $this->NewsModel->delete_by_id($delete);
                $viewData["message"] = "News delete successful.";
            }
        }

        $where = array();
        if (intval($category_id) > 0) {
            $where['category_id'] = $category_id;
        }

        $page = $this->input->get('page') ? $this->input->get('page') : 0;
        $config['attributes'] = array('class' => 'page-link');
        $search = $this->input->get('search') ? $this->input->get('search') : '';
        if (strlen($search) > 0) {
            $category_id = 0;
            $config["base_url"] = base_url() . $this->router->fetch_class() . '/index/?search=' . $search;
            $config["total_rows"] = $this->NewsModel->get_search_count($search);
            $this->pagination->initialize($config);
            $items = $this->NewsModel->search($page, $search);
            $viewData['message'] = 'Results for: ' . $search;
        } else {
            $config["base_url"] = base_url() . $this->router->fetch_class() . '/index/' . $category_id;
            $config["total_rows"] = $this->NewsModel->get_count($where);
            $this->pagination->initialize($config);
            $items = $this->NewsModel->get_all($page, $where);
        }

        $viewData["categories"] = $this->CategoryModel->all_list();
        $viewData["items"] = $items;
        $viewData["selected_id"] = $category_id;
        $viewData["title"] = "News list";
        $this->load->view('list/news', $viewData);
    }

    public function add()
    {
        $viewData["categories"] = $this->CategoryModel->all_list();
        $viewData["title"] = "Add news";

        $title = $this->input->post("title");
        $publish_date = $this->input->post("publish_date");
        $category = $this->input->post("category");
        $featured = $this->input->post("featured") == 'on';
        $content = $this->input->post("content", false);

        if (!empty($title) && !empty($publish_date) && !empty($category) && !empty($content)) {
            $data = array(
                'title' => $title,
                'content' => $content,
                'published_at' => $publish_date,
                'category_id' => $category,
                'featured' => $featured,
                'author_id' => $this->userData['user_id']
            );
            $check = $this->NewsModel->get($data);
            if ($check) {
                $viewData['message'] = 'This is news already added.';
            } else {
                $config['upload_path'] = './assets/images/news/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 5 * 1024;
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $viewData["message"] = $this->upload->display_errors();
                } else {
                    $data['image'] = base_url('assets/images/news/') . $this->upload->data('file_name');
                    $insert = $this->NewsModel->insert($data);
                    if ($insert) {
                        $viewData["message"] = "News added successful.";
                    }
                }
            }
        }

        $this->load->view('add/news', $viewData);
    }

    public function edit($id)
    {
        $news = $this->NewsModel->get(array('id' => $id));
        if ($news->author_id != $this->userData['user_id'] && $this->userData['level'] < 2) {
            redirect('News');
        }

        $viewData["categories"] = $this->CategoryModel->all_list();
        $viewData["title"] = "Edit news";

        $title = $this->input->post("title");
        $publish_date = $this->input->post("publish_date");
        $category = $this->input->post("category");
        $featured = $this->input->post("featured") == 'on';
        $content = $this->input->post("content", false);
        if (!empty($title) && !empty($publish_date) && !empty($category) && !empty($content)) {
            $data = array(
                'title' => $title,
                'content' => $content,
                'published_at' => $publish_date,
                'featured' => $featured,
                'category_id' => $category
            );

            $viewData["message"] = "";
            $config['upload_path'] = './assets/images/news/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 5 * 1024;
            $config['encrypt_name'] = true;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $data['image'] = base_url('assets/images/news/') . $this->upload->data('file_name');
            }
            $update = $this->NewsModel->update($data, array('id' => $id));
            if ($update) {
                $viewData["message"] .= "News update successful.<br>";
                $news = $this->NewsModel->get(array('id' => $id));
            }
        }
        $viewData['news'] = $news;
        $this->load->view('edit/news', $viewData);
    }
}
