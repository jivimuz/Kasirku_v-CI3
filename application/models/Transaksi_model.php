<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	public function get_all_transaksi()
	{
		$this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_pegawai', 'tbl_transaksi.id_pegawai = tbl_pegawai.id_pegawai');
		$this->db->where('is_paid', 1);
		$this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->result();
	}
	public function get_transaksi_by_id($id)
	{
		$query  = $this->db->query("SELECT tbl_transaksi.*, tbl_pegawai.*  from tbl_transaksi JOIN tbl_pegawai ON tbl_transaksi.id_pegawai = tbl_pegawai.id_pegawai where is_paid = 1 and id_transaksi = '$id'");
		
        return $query->result();
	} 
	public function get_transaksi_paid($id)
	{
		$query  = $this->db->query("SELECT id_transaksi  from tbl_transaksi where is_paid = 0 and id_transaksi = '$id'");
        return $query;
	} 

	public function get_cart_by_id($id) {
		$query  = $this->db->query("SELECT tbl_cart.*, tbl_product.*  from tbl_cart JOIN tbl_product ON tbl_cart.id_product = tbl_product.id_product where id_transaksi = $id");
        return $query->result();
	}
	
	public function get_transaksi_by_pegawai($id)
	{
		$query  = $this->db->query("SELECT * FROM tbl_transaksi WHERE id_pegawai = '$id' and is_paid=0 ORDER BY id_transaksi DESC LIMIT 1");
		return $result = $query->result();
	}

	public function create_cart($id)
	{
		if($id == $_SESSION['id_pegawai']){
			$quer  = $this->db->query("SELECT * FROM tbl_transaksi WHERE id_pegawai = '$id' and is_paid=0 ORDER BY id_transaksi DESC LIMIT 1");
			if($quer->num_rows() == 0){
				$now = date("Y-m-d H:i:s");
				$query  = $this->db->query("INSERT INTO tbl_transaksi set id_pegawai='$id', created_at='$now' ");
				return $result = true;
			}
		}
	}

	
}
