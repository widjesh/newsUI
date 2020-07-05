<?php
/**
 * Created by PhpStorm.
 * User: Miko
 * Date: 7/26/2017
 * Time: 5:23 PM
 */

class Users extends CI_Controller{

    private $levels;
    private $userLevel;
    private $user_id;

	public function __construct() {
        parent::__construct();
        $this->load->model("UserModel");
        $this->levels = array('User', 'Moderator', 'Admin', 'Root Administrator');
        $this->userLevel = $this->session->userdata('level');
        $this->user_id = $this->session->userdata('user_id');
        if ($this->userLevel < 3){
            redirect('Dashboard');
        }
	}

	public function index()
	{
		$delete = intval($this->input->get("del"));
		if ($delete > 0){
            $this->UserModel->delete_by_id($delete);
			$viewData["message"] = "User delete successful.";
		}

        $config["base_url"] = base_url().$this->router->fetch_class();
        $config["total_rows"] = $this->UserModel->get_count();
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $page = $this->input->get('page') ? $this->input->get('page') : 0;

		$viewData["users"] = $this->UserModel->get_all($page);
		$viewData["title"] = "User list";
		$viewData["levels"] = $this->levels;
		$this->load->view('list/user', $viewData);
	}

	public function edit($user_id){
		$viewData['user'] = $this->UserModel->get(array('id'=> $user_id));
		if (empty($viewData['user'])){
			redirect('Users');
		}else{
			if (isset($_GET['reset'])){
                $update = $this->UserModel->update(array('password' => md5(sha1('12345'))), array('id' => $user_id));
				if ($update){
					$viewData['message'] = 'User password reseted to 12345';
				}
			}

			if (isset($_POST['email'])){
				$viewData['user']->email = $this->input->post('email');
				$viewData['user']->first_name = $this->input->post('first_name');
				$viewData['user']->last_name = $this->input->post('last_name');
				$viewData['user']->level = $this->input->post('level');
                $update = $this->UserModel->update($viewData['user'], array('id' => $user_id));
				if ($update){
					$viewData['message'] = 'User data updated.';
				}
			}
            $viewData['levels'] = $this->levels;
			$this->load->view('edit/users', $viewData);
		}
	}
}