<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{	
		parent::__construct();
		$this->load->library('form_validation'); 
		$this->load->view('lib/f_library'); 
		$this->load->model('Pegawai');
	}

	public function index()
	{	
		if ($this->session->userdata('logged_in')) {
			redirect('dashboard');
		  }else{
			$data['title'] = "Kasirku";
			$this->load->view('auth/auth_head', $data);
			$this->load->view('auth/login');
			$this->load->view('auth/auth_foot');
		  }
	}

	public function login() {
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('auth/login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$id_pegawai = $this->Pegawai->login($username, $password);
			
			if ($id_pegawai) {
				$this->session->set_userdata('logged_in', TRUE);
				$this->session->set_userdata('username', $username);
				$this->session->set_userdata('id_pegawai', $id_pegawai);
				redirect('dashboard');
			} else {
				$errors[] = 'Username atau password yang Anda masukkan salah.';
				$this->session->set_flashdata('error', display_errors($errors));
				redirect('auth');
			}
		}
	}
	

  public function logout() {
    $this->session->unset_userdata('id_pegawai');
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('logged_in');
	$this->session->sess_destroy();

    redirect('auth');
  }
}
