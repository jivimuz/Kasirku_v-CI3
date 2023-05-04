<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modal extends CI_Controller {

	public function __construct()
	{	
		parent::__construct();
		$this->load->model('Pegawai');
		$idgue = $this->session->userdata('id_pegawai');
		// var_dump($idgue);
		$data['dataku'] = $this->Pegawai->dataku($idgue);
	}
	public function add_pegawai()
	{
		if($this->input->is_ajax_request())
		{
			$idgue = $this->session->userdata('id_pegawai');
			$dataku['dataku'] = $this->Pegawai->dataku($idgue);
			$this->load->view('main/pegawai/add_pegawai', $dataku);
		}
		else
		{
			show_404();
		}
	}

	public function edit_pegawai()
	{
		if($this->input->is_ajax_request())
		{
		$idgue = $this->session->userdata('id_pegawai');
		$dataku['dataku'] = $this->Pegawai->dataku($idgue);
		// var_dump($idgue);
		$this->load->view('main/pegawai/edit_pegawai', $dataku);
		}
		else
		{
			show_404();
		}
	}

	public function add_produk()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->view('main/produk/add_product');
		}
		else
		{
			show_404();
		}
	}

	public function edit_produk()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->view('main/produk/edit_product');
		}
		else
		{
			show_404();
		}
	}
}
