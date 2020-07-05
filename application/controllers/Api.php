<?php
/**
 * Created by PhpStorm.
 * User: feyzi
 * Date: 26.10.2017
 * Time: 11:48
 */

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("NewsModel", "news");
    }

    public function index()
    {
        show_404();
    }

    public function home()
    {
        $this->load->model("HomeModel", "home");

        $items = $this->home->all();

        foreach ($items as $k => $item){
            $items[$k]->all = false;
            if ($item->items=='featured') {
                $items[$k]->items = $this->news->news_list(0, 'n.is_active = 1 AND featured=1', $item->length);
            }elseif ($item->items=='latest'){
                $items[$k]->items = $this->news->news_list(0, 'n.is_active = 1', $item->length);
                $items[$k]->all = 'all';
            }elseif ($item->items=='popular'){
                $items[$k]->items = $this->news->popular(0, $item->length);
            }elseif (is_numeric($item->items)){
                $items[$k]->all = $item->items;
                $items[$k]->items = $this->news->news_list(0, 'n.is_active = 1 AND category_id='.$item->items, $item->length);
            }
        }

        $data = array('items' => $items);

        $this->load->view('json', array('data' => $data));
    }

    public function Category()
    {
        $this->load->model("CategoryModel");

        $data = array('items' => $this->CategoryModel->all_list());

        $viewData["data"] = $data;
        $this->load->view('json', $viewData);
    }

    public function News($category_id = 0)
    {
        $where = 'n.is_active = 1';
        if (intval($category_id) > 0) {
            $where .= ' AND n.category_id = ' . $category_id;
        }

        $page = $this->input->get('page') ? $this->input->get('page') : 0;

        $search = $this->input->get('search') ? $this->input->get('search') : null;
        if ($search) {
            $where .= ' AND (LOWER(n.title) LIKE \'%' . strtolower($search) . '%\' OR LOWER(n.content) LIKE \'%' . strtolower($search) . '%\')';
        }

        $data = array(
            'limit' => $this->config->item('per_page'),
            'news' => $this->news->news_list($page, $where)
        );

        $viewData["data"] = $data;
        $this->load->view('json', $viewData);
    }

    public function NewsDetail($news_id = 0)
    {
        $news = $this->news->detail(array('n.id' => $news_id));
        $this->news->update(array('views' => $news->views + 1), array('id' => $news_id));

        $data = array(
            'news' => $news,
            'releated_news' => is_object($news) ? $this->news->news_list(0,
                array(
                    'n.category_id' => $news->category_id,
                    'n.id!=' => $news_id,
                    'n.is_active' => 1
                )) : null
        );

        $viewData["data"] = $data;
        $this->load->view('json', $viewData);
    }
}