<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('AuthModel');
		$this->load->model('DashboardModel');
		$this->load->library(['session', 'form_validation', 'encryption']);
	}


	public function index()
	{

		$user_id = $this->session->userdata('id');
		if (!$user_id) {
			echo 'Anda belum melakukan login!';
			redirect('auth/login');
		} else {
			$profile_data['user'] = $this->AuthModel->getUsersProfile($user_id);
			return $this->load->view('/dashboard', $profile_data);
		}
	}

	public function list_anggota()
	{
		$data_anggota['list_anggota'] = $this->DashboardModel->get_all_anggota();
		//debug data anggota
		// echo '<pre>';
		// print_r($data_anggota['list_anggota']);
		// echo '</pre>';

		$this->load->view('/anggota/listAnggota', $data_anggota);
	}

	public function create_anggota()
	{
		$this->load->view('/anggota/addAnggota');
	}

	public function store_anggota()
	{
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('/dashboard/create_anggota');
		} else {
			$nama_lengkap   = $this->input->post('nama_lengkap', true);
			$jenis_kelamin  = $this->input->post('jenis_kelamin', true);
			$tempat_lahir   = $this->input->post('tempat_lahir', true);
			$tanggal_lahir  = $this->input->post('tanggal_lahir', true);
			$alamat         = $this->input->post('alamat', true);
			$no_telepon     = $this->input->post('no_telepon', true);
			$email          = $this->input->post('email', true);
			$status         = $this->input->post('status', true);

			$data = [
				'nama_lengkap'  => htmlspecialchars($nama_lengkap),
				'jenis_kelamin' => htmlspecialchars($jenis_kelamin),
				'tempat_lahir'  => htmlspecialchars($tempat_lahir),
				'tanggal_lahir' => htmlspecialchars($tanggal_lahir),
				'alamat'        => htmlspecialchars($alamat),
				'no_telepon'    => htmlspecialchars($no_telepon),
				'email'         => htmlspecialchars($email),
				'status'        => htmlspecialchars($status),
				'created_at'    => date('Y-m-d H:i:s'),
			];

			// Insert dulu tanpa kode_anggota
			$insert_id = $this->DashboardModel->insert_anggota($data);

			// Generate kode anggota setelah dapat insert_id
			$kode_anggota = 'AGT' . $insert_id . date('Ymd');

			// Update kode_anggota
			$this->DashboardModel->update($insert_id, ['kode_anggota' => $kode_anggota]);

			$this->session->set_flashdata('success', 'Anggota berhasil ditambahkan.');
			redirect('dashboard/list_anggota');
		}
	}
}
