<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	public function get_all_products() {
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->join('tbl_jenis_product', 'tbl_jenis_product.id_jenis_product = tbl_product.id_jenis_product', 'left');
        $query = $this->db->get();
        return $query->result();
    }
	
	public function get_product($id) {
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->join('tbl_jenis_product', 'tbl_jenis_product.id_jenis_product = tbl_product.id_jenis_product', 'left');
        $this->db->where('id_product', $id);
        $query = $this->db->get();
        return $query->row();
    }

	function update_product($id_product, $data) {
        $this->db->where('id_product', $id_product);
        $this->db->update('tbl_product', $data);
        return $this->db->affected_rows();
    }

	public function delete_product($del_id) {
        $this->db->select('foto');
        $this->db->where('id_product', $del_id);
        $query = $this->db->get('tbl_product');
        $result = $query->row_array();
        if ($query->num_rows() > 0 && file_exists("./assets/images/products/".$result['foto'])) {
            unlink("./assets/images/products/".$result['foto']);
        }
        $this->db->where('id_product', $del_id);
        $this->db->delete('tbl_product');
        return true;
    }

	public function get_by_jenis($id) {
		$this->db->select('id_product');
        $this->db->from('tbl_product');
        $this->db->where('id_jenis_product', $id);
        $query = $this->db->get();
        return $query->num_rows();
	}

	public function get_jenis($id)
	{
        $this->db->select('*');
        $this->db->from('tbl_jenis_product');
        $this->db->where('id_jenis_product', $id);
        $query = $this->db->get();
        return $query->row();
	}

	public function get_all_jenis() {
        $this->db->select('*');
        $this->db->from('tbl_jenis_product');
        $query = $this->db->get();
        return $query->result();
    }

	public function get_jenis_name($name) {
		$this->db->select('nama_jenis_product');
        $this->db->from('tbl_jenis_product');
        $this->db->where('nama_jenis_product', $name);
        $query = $this->db->get();
        return $query->num_rows();
	}

	public function get_jenis_name_update($name, $id) {
		$this->db->select('nama_jenis_product');
        $this->db->from('tbl_jenis_product');
        $this->db->where('nama_jenis_product', $name, "and id_jenis_product != $id");
        $query = $this->db->get();
        return $query->num_rows();
	}
}
