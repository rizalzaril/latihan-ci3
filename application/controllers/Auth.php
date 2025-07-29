<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('AuthModel');
		$this->load->library(['session', 'form_validation']);
	}


	public function index()
	{

		echo 'Hello, ini halaman auth!<br>';

		//cek koneksi database

		//menjalankan query untuk get db
		$query = $this->db->query('SELECT DATABASE() AS db');

		//cek hasil query
		if ($query->num_rows() > 0) {
			$row = $query->row();
			echo "Database anda berhasil terkoneksi";
			echo 'Database anda adalah ' . $row->db;
		} else {
			echo 'Database tidak terkoneksi, silahkan cek kembali!';
		}
	}


	public function register()
	{


		$name = $this->input->post('name', true);
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);

		//create form validation
		$this->form_validation->set_rules('name', 'Nama', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|trim');


		//cek jika validasi gagal?
		if ($this->form_validation->run() == false) {
			//maka akan return ke view
			return $this->load->view('auth/register');
		} else {
			$data = [
				'name' => htmlspecialchars($name),
				'email' => htmlspecialchars($email),
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'role' => 'user',
				'created_at' => date('Y-m-d H:i:s')
			];

			// $this->AuthModel->register($data);
			$insert_id = $this->AuthModel->register($data);
			// echo 'insertID' . $insert_id;
			// exit;

			if ($insert_id > 0) {

				//create user_kode by date and id
				$kode_user = 'USR' . str_pad($insert_id, 4, '0', STR_PAD_LEFT) . '-' . date('Ymd');

				//ipdate user column
				$this->db->where('id', $insert_id);
				$this->db->update('users', ['kode_user' => $kode_user]);
			}

			echo "<script> alert('Akun anda berhasil di buat') </script>";
			$this->session->set_flashdata('success', 'Akun berhasil didaftarkan. Silahkan Login.');
			redirect('auth/login');
		}
	}

	public function login()
	{

		$email = $this->input->post('email', true);
		$password = $this->input->post('password');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|trim');

		//cek jika validasi gagal
		if ($this->form_validation->run() == false) {
			return $this->load->view('auth/login');
		} else {

			//cek email user
			$user = $this->AuthModel->getUsersEmail($email);

			//Jika password terverifikasi/benar
			if ($user && password_verify($password, $user->password)) {
				$data = [

					'id' => $user->id,
					'email' => $user->email,
					'name' => $user->name,
					'role' => $user->role,
					'created_at' => $user->created_at,

				];

				$this->session->set_userdata($data);
				redirect('/dashboard');
			} else {
				$this->session->set_flashdata('error', 'Email atau Password anda salah!');
				redirect('auth/login');
			}
		}
	}

	public function save_profile()
	{
		$this->form_validation->set_rules('address', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('phone', 'No. Telepon', 'required|trim|numeric');

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/dashboard');
		} else {
			$user_id = $this->session->userdata('id');
			$data_profile = [
				'user_id' => $user_id, // dibutuhkan untuk insert baru
				'address' => htmlspecialchars($this->input->post('address', true)),
				'phone' => htmlspecialchars($this->input->post('phone', true)),
				'photo' => htmlspecialchars('.png'),
			];

			// Cek apakah data profile user sudah ada
			$existing = $this->AuthModel->getProfileByUserId($user_id);

			if ($existing) {
				// Jika sudah ada, update
				$this->AuthModel->updateProfile($user_id, $data_profile);
			} else {
				// Jika belum ada, insert
				$this->AuthModel->insertProfile($data_profile);
			}

			$this->session->set_flashdata('success', 'Profile berhasil diperbarui');
			redirect('/dashboard');
		}
	}
}
