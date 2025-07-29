<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('AuthModel');
	}


	public function index()
	{

		$user_id = $this->session->userdata('id');
		$profile_data['user'] = $this->AuthModel->getUsersProfile($user_id);

		return $this->load->view('/dashboard', $profile_data);
	}
}
