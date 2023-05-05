<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	public function __construct()
	{	
		parent::__construct();
		$this->load->library('form_validation'); 
		if ($this->session->userdata('logged_in') == false) {
			redirect('auth');
		}
		$this->load->view('lib/f_library');
		$this->load->view('lib/f_notification');
		$this->load->model('Pegawai');
        $this->load->helper('security');

		$idgue = $this->session->userdata('id_pegawai');
		$dataku['dataku'] = $this->Pegawai->dataku($idgue);
		
		$this->load->view('main/extend/header', $dataku);
		$this->load->model('Product_model');
		$this->load->model('Transaksi_model');
	}

	public function transaksi_index()
	{
		$this->load->model('Transaksi_model');
		$data['list'] = $this->Transaksi_model->get_all_transaksi();
		$this->load->view('main/transaksi/transaksi', $data);
		$this->load->view('main/extend/footer');
		
	}
	public function transaksi_show($id)
	{
		// return "hello world";
		$data['data'] = $this->Transaksi_model->get_transaksi_by_id($id);
		// var_dump($data['data']);
		$this->load->view('main/transaksi/show_transaksi', $data);
		$this->load->view('main/extend/footer');
	}

	public function cart_index()
	{	
		$data['data']  = $this->Transaksi_model->get_transaksi_by_pegawai($_SESSION['id_pegawai']);
		if(!empty($data['data']))
		{
			$this->load->view('main/transaksi/cart', $data);
		}else{
			$this->Transaksi_model->create_cart($_SESSION['id_pegawai']);
			redirect('transaksi/cart');
		}

		$this->load->view('main/extend/footer');
	}

	public function cart_add_produk($id)
	{
		$this->form_validation->set_rules('product', 'Nama Jenis', 'required|trim');
        if ($this->form_validation->run() == true) {
				$product = $this->input->post('product');
				$cekProduk = $this->db->query("SELECT * FROM tbl_product WHERE nama_product = '$product' LIMIT 1");
				if ($cekProduk->num_rows() > 0) {
					$tcek = $cekProduk->row();
					$cekProduk2 = $this->db->get_where('tbl_cart', array('id_transaksi' => $id, 'id_product' => $tcek->id_product));

					if ($cekProduk2->num_rows() > 0) {
						$errors[] = "Produk sudah ada pada list";
					} 
				}else{
					$errors[] = "Masukan nama produk yang sesuai";
					// redirect('transaksi/cart');
				}
				if(!empty($errors)){
					$this->session->set_flashdata('error', display_errors($errors));
				}else{
					$this->db->set('id_product', $tcek->id_product);
					$this->db->set('id_transaksi', $id);
					$this->db->set('modal', $tcek->harga_beli);
					$this->db->set('harga_satuan', $tcek->harga_jual);
					$this->db->insert('tbl_cart');

					$this->db->set('stok', 'stok - 1', FALSE);
					$this->db->where('id_product', $tcek->id_product);
					$this->db->update('tbl_product');

					$success[] = "Barang berhasil ditambahkan.";
					$this->session->set_flashdata('error',  display_success($success));
				}
				
				redirect('transaksi/cart');
		}
	}

	public function cart_qty_produk($id)
	{
		// return "hello world";	
		$this->form_validation->set_rules('qty', 'QTY', 'required|trim');
		$this->form_validation->set_rules('id_product', 'ID Produk', 'required|trim');
		$this->form_validation->set_rules('qty_before', '-', 'required|trim');
        if ($this->form_validation->run() == true) {
				

			$id_product = $this->input->post('id_product', true);
			$qty_before = $this->input->post('qty_before', true);
			$qty = $this->input->post('qty', true);


			$ce = $this->db->select('stok')->get_where('tbl_product', array('id_product' => $id_product))->row_array();
			if($qty < 0 || $qty > ($ce['stok'] + $qty_before)){
				$errors[] = "Masukan jumlah yang sesuai, stok tersisa adalah ".($ce['stok']+$qty_before);
			}

			if(!empty($errors)){
				$this->session->set_flashdata('error', display_errors($errors));
			}else{

				if($qty > $qty_before && $qty != $qty_before){

				$jumlah = $qty - $qty_before; 
					$this->db->query("UPDATE tbl_product set stok = stok - '$jumlah' where id_product='$id_product'");
					$this->db->query("UPDATE tbl_cart set qty='$qty' where id_cart='$id'");
					
				}elseif($qty < $qty_before && $qty != $qty_before){
					$jumlah = $qty_before - $qty; 
					$this->db->query("UPDATE tbl_product set stok = stok + '$jumlah' where id_product='$id_product'");
					$this->db->query("UPDATE tbl_cart set qty='$qty' where id_cart='$id'");
				}
			}
		}
	 	redirect('transaksi/cart');
	}
	public function cart_delete_produk($id)
	{
		$this->form_validation->set_rules('id_product', 'ID Produk', 'required|trim');
		$this->form_validation->set_rules('qty_before', '-', 'required|trim');

		if ($this->form_validation->run() == true) {
			$id_product = $this->input->post('id_product', true);
			$qty = $this->input->post('qty_before', true);

			$this->db->set('stok', "stok + $qty", false);
			$this->db->where('id_product', $id_product);
			$this->db->update('tbl_product');

			if ($this->db->affected_rows() > 0) {
				$this->db->query("DELETE FROM tbl_cart where id_cart = '$id'");

				$success[] = "Barang berhasil dihapus.";
				$this->session->set_flashdata('error',  display_success($success));
			}
		}

		redirect('transaksi/cart');
	}
	public function cart_reset_produk($id)
	{
		$trans = $this->Transaksi_model->get_transaksi_paid($id);
		if($trans->num_rows() > 0)
		{
		$produk = $this->Transaksi_model->get_cart_by_id($id);
		// var_dump($produk);
		foreach($produk as $p)
		{
			$this->db->set('stok', "stok +  $p->qty", false);
			$this->db->where('id_product', $p->id_product);
			$this->db->update('tbl_product');
			if ($this->db->affected_rows() > 0) {
				$this->db->query("DELETE FROM tbl_cart where id_cart = '$p->id_cart'");

				
			}
		}
		$success[] = "Barang berhasil dihapus.";
		$this->session->set_flashdata('error',  display_success($success));
		redirect('transaksi/cart');
		}
	}
	public function cart_save($id)
	{
		$this->form_validation->set_rules('data-1', '-', 'required|trim');
		$this->form_validation->set_rules('data-2', '-', 'required|trim');
		$this->form_validation->set_rules('data-3', '-', 'required|trim');
			
		if ($this->form_validation->run() == true) {
			$data1 = $this->input->post('data-1', true);
			$data2 = $this->input->post('data-2', true);
			$data3 = $this->input->post('data-3', true);
			$now = date("Y-m-d H:i:s");

			$this->db->set('total_tunai', $data2);
			$this->db->set('total_harga', $data1);
			$this->db->set('total_kembali', $data3);
			$this->db->set('is_paid', 1);
			$this->db->set('paid_at', $now);
			$this->db->where('id_transaksi', $id);
			$this->db->update('tbl_transaksi');

		if ($this->db->affected_rows() > 0) {
			$success[] = "Data Berhasil ditambahkan";
			$this->session->set_flashdata('error',  display_success($success));
		}
		}

		redirect('transaksi');
	}

	public function cetak()
	{
		$this->form_validation->set_rules('date-to', '-', 'required|trim');

		if ($this->form_validation->run() == true) {
			$id_pegawai = $this->input->post('id_pegawai', true);
			$date_from = $this->input->post('date-from', true);
			$date_to = $this->input->post('date-to', true).' 23:59:59';
			if(!empty($date_from))
			{
				$date_from = $date_from.' 00:00:01';
			}

			if (!empty($id_pegawai)) {
				$data['data'] = $this->db->query("SELECT tbl_transaksi.*, tbl_pegawai.nama_pegawai FROM tbl_transaksi 
				JOIN tbl_pegawai ON tbl_transaksi.id_pegawai = tbl_pegawai.id_pegawai WHERE tbl_transaksi.id_pegawai = '$id_pegawai' AND tbl_transaksi.is_paid = 1 AND tbl_transaksi.paid_at BETWEEN '$date_from' AND '$date_to'");
			} else {
				$data['data'] = $this->db->query("SELECT tbl_transaksi.*, tbl_pegawai.nama_pegawai FROM tbl_transaksi 
				JOIN tbl_pegawai ON tbl_transaksi.id_pegawai = tbl_pegawai.id_pegawai WHERE tbl_transaksi.is_paid = 1 AND tbl_transaksi.paid_at BETWEEN '$date_from' AND '$date_to'");
				
				
				
			}
			$data['id_pegawai'] = $id_pegawai;
			$data['date_from'] = $date_from;
			$data['date_to'] = $date_to;
		$this->load->view('main/transaksi/cetak', $data);
		$this->load->view('main/extend/footer');
		}

	}

}
