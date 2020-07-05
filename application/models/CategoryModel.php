<?php
/**
 * Created by PhpStorm.
 * User: Miko
 * Date: 7/13/2017
 * Time: 1:57 PM
 */
class CategoryModel extends MY_Model{

	public function __construct() {
		parent::__construct();
		$this->table = "category";
	}
}