<?php
/**
 * Created by PhpStorm.
 * User: Miko
 * Date: 7/13/2017
 * Time: 1:57 PM
 */
class HomeModel extends MY_Model{

	public function __construct() {
		parent::__construct();
		$this->table = "home";
	}

	public function all(){
	    return $this->db->order_by('sort','asc')->get($this->table)->result();
    }

    public function update_sort($data = array()){
        return $this->db->update_batch($this->table, $data, 'id');
    }
}