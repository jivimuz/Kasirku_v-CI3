<?php
class Pegawai extends CI_Model {
	
	public function login($username, $password) {
		$options = ['cost' => 10];
		$this->db->where('username', $username);
		$query = $this->db->get('tbl_pegawai');
		$data = $query->row_array();
		if ($query->num_rows() == 1 && password_verify($password, $data['password'])) {
			return $data['id_pegawai'];
		} else {
			return false;
		}
	}
	public function dataku($idgue) {
		$query = $this->db->get_where('tbl_pegawai', array('id_pegawai' => $idgue), 1);
        return $query->row_array();
	}
	
	public function get_all_pegawai()
	{
		$this->db->select('*');
        $this->db->from('tbl_pegawai');
        $query = $this->db->get();
        return $query->result();
	}

}
