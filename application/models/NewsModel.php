<?php

/**
 * Created by PhpStorm.
 * User: Miko
 * Date: 7/13/2017
 * Time: 1:57 PM
 */
class NewsModel extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = "news";
    }

    public function search($start = 0, $keyword = '', $select = '*')
    {
        $this->db->select($select);
        $this->db->where(array('is_active' => 1));
        $this->db->like('title', $keyword);
        $this->db->or_like('content', $keyword);
        $this->db->limit($this->config->item('per_page'), $start);
        return $this->db->get($this->table)->result();
    }

    public function get_search_count($keyword)
    {
        return $this->db->select('id')->where(array('is_active' => 1))->like('title', $keyword)->or_like('content', $keyword)->get($this->table)->num_rows();
    }

    public function view_count($where = array())
    {
        $this->db->select_sum('views');
        $this->db->where($where);
        return $this->db->get($this->table)->row()->views;
    }

    public function news_list($start = 0, $where = '', $limit = 0)
    {
        $this->db->select('n.id,n.title,n.image,n.views,n.published_at,c.title as category');
        $this->db->from($this->table . ' n');
        $this->db->join('category c', 'n.category_id=c.id', 'left');
        $this->db->where($where);
        $this->db->order_by('n.id', 'desc');
        $this->db->limit($limit ? $limit : $this->config->item('per_page'), $start);
        return $this->db->get()->result();
    }

    public function popular($start = 0, $limit = 0)
    {
        $this->db->select('n.id,n.title,n.image,n.views,n.published_at,c.title as category');
        $this->db->from($this->table . ' n');
        $this->db->join('category c', 'n.category_id=c.id', 'left');
        $this->db->where(array('n.is_active' => 1, 'n.published_at >' => date('Y-m-d H:i:s', strtotime('-10 day'))));
        $this->db->order_by('n.views', 'desc');
        $this->db->limit($limit ? $limit : $this->config->item('per_page'), $start);
        return $this->db->get()->result();
    }

    public function detail($where = array())
    {
        $this->db->select('n.id,n.title,n.content,n.views,n.published_at,n.image,c.title AS category,n.category_id');
        $this->db->from($this->table . ' n');
        $this->db->join('category c', 'n.category_id=c.id', 'left');
        $this->db->where($where);
        return $this->db->get()->row();
    }
}