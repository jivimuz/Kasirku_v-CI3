<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
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

		$idgue = $this->session->userdata('id_pegawai');
		$dataku['dataku'] = $this->Pegawai->dataku($idgue);
		
		$this->load->view('main/extend/header', $dataku);
		$this->load->model('Product_model');
        $this->load->helper('security');
	}

	public function index()
	{
		$chart = $this->get_chart_data();
		$data['chart_labels'] = json_encode($chart['labels']);
		$data['chart_values'] = json_encode($chart['values']);
		// var_dump($data['chart_labels']);
		$this->load->view('main/dashboard', $data);

		$this->load->view('main/extend/footer');
	}

	
	public function get_chart_data()
	{
		$this->load->database();

		// Mengambil data dari database
		$query = $this->db->query("SELECT COUNT(tbl_cart.id_product) AS jumlah, tbl_product.nama_product 
								FROM tbl_cart 
								JOIN tbl_product ON tbl_cart.id_product = tbl_product.id_product 
								GROUP BY tbl_product.id_product");

		// Menyimpan data dalam array
		$data = $query->result_array();

		// Membuat data chart
		$labels = array();
		$values = array();
		foreach ($data as $d) {
			$labels[] = $d['nama_product'];
			$values[] = $d['jumlah'];	
		}

		$chart = array(
			'labels' => $labels,
			'values' => $values,
		);

		return $chart;
	}

	

	public function pegawai()
	{
		$this->load->database();
		$this->load->view('main/pegawai/pegawai');
		$this->load->view('main/extend/footer');
	}

	public function add_pegawai ()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'No. HP', 'trim|required');
		$this->form_validation->set_rules('is_admin', 'is Admin', 'trim');

		if ($this->form_validation->run() == true) {
			$nama_pegawai = $this->input->post('nama_pegawai');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$email = $this->input->post('email');
			$no_hp = $this->input->post('no_hp');

			if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
				$errors[] = 'Username tidak mendukung spesial karakter.';
			}
			
			if (!preg_match('/^[a-zA-Z ]+$/', $nama_pegawai)) {
				$errors[] = 'Nama pegawai Hanya memdukung a-Z.';
			}
			
			if(empty($this->input->post('is_admin'))){
				$is_admin = 0;
			}else{
				$is_admin = $this->input->post('is_admin');
			}
		
			$sel = $this->db->query("SELECT id_pegawai FROM tbl_pegawai WHERE username = '$username'");
		
			if($sel->num_rows() > 0){
				$errors[] = 'Username sudah terdaftar.';
				$this->session->set_flashdata('error', display_errors($errors));
			}
		
			if (strlen($password) < 6) {
				$errors[] = 'Password harus minimal 6 karakter.';
				$this->session->set_flashdata('error', display_errors($errors));
			}
		
			if (!empty($errors)) {
				$this->session->set_flashdata('error', display_errors($errors));
				redirect('pegawai');
			} else { 	
				$options = ['cost' => 10];
				$password_hash = password_hash($password, PASSWORD_DEFAULT, $options);
				$update = $this->db->query("INSERT INTO tbl_pegawai SET username='$username', password = '$password_hash', nama_pegawai = '$nama_pegawai', email='$email', no_hp='$no_hp', is_admin = '$is_admin'");
			
				if ($update == true) {
					$success = array("Data $username behasil di tambahkan");
					$this->session->set_flashdata('error', display_success($success));
					redirect('pegawai');
				}else{
					$errors[] = 'Database Error.';
					$this->session->set_flashdata('error', display_errors($errors));
					redirect('pegawai');
				}
			}
		}
	}

	public function edit_pegawai()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('pass_before', 'Password Before', 'trim');
		$this->form_validation->set_rules('password', 'Password', 'trim');
		$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'No. HP', 'trim|required');
		$this->form_validation->set_rules('is_admin', 'is Admin', 'trim');
		if ($this->form_validation->run() == true ) {
			$id_pegawai = $this->input->post('id_pegawai');    
			$nama_pegawai = $this->input->post('nama_pegawai');    
			$username = $this->input->post('username');    
			$password = $this->input->post('password');    
			$pass_before = $this->input->post('pass_before');    
			$email = $this->input->post('email');    
			$no_hp = $this->input->post('no_hp');

			if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
				$errors[] = 'Username tidak mendukung spesial karakter.';
			}
			
			if (!preg_match('/^[a-zA-Z ]+$/', $nama_pegawai)) {
				$errors[] = 'Nama pegawai Hanya memdukung a-Z.';
			}

			if(empty($this->input->post('is_admin'))){
				$is_admin = 0;
			}else{
				$is_admin = $this->input->post('is_admin');    
			}
			$sel = $this->db->query("select id_pegawai from tbl_pegawai where username = '$username' and id_pegawai != '$id_pegawai'");
		
			if($sel->num_rows() > 0){
				$errors[] = "Username Sudah Terdaftar.";
			}
		
			if (!empty($password) && strlen($password) < 6) {
				$errors[] = "Gunakan mininal 6 karakter untuk password.";
			}
			
			if (!empty($errors)) {
					$this->session->set_flashdata('error', display_errors($errors));
					redirect('pegawai');
			} else {
				$options = ['cost' => 10];           
					
				if(!empty($password)){
					$password_hash = password_hash($password, PASSWORD_DEFAULT, $options);
				}else{
					$password_hash = $pass_before;
				}    
				$update = $this->db->query("UPDATE tbl_pegawai SET username='$username', password = '$password_hash', nama_pegawai = '$nama_pegawai', email='$email', no_hp='$no_hp', is_admin = '$is_admin' where id_pegawai = '$id_pegawai' ");
		
				if ($update == true) {
					$success = array("Data $username behasil di edit");
					$this->session->set_flashdata('error', display_success($success));
					redirect('pegawai');
				}
			}
			echo "<hr>";
		}
		
	}

	public function hapus_pegawai($id_pegawai)
	{
		$delete = $this->db->query("DELETE FROM tbl_pegawai WHERE id_pegawai = '$id_pegawai'");
		if ($delete) {
			$success = array("Data behasil di hapus");
			$this->session->set_flashdata('error', display_success($success));
			redirect('pegawai');
		}
	}

	public function produk()
	{
		$this->load->database();
		$this->load->view('main/produk/product');
		$this->load->view('main/extend/footer');
	}
	public function add_produk()
	{

    $this->form_validation->set_rules('id_jenis_product', 'ID Jenis Product', 'required|numeric');
    $this->form_validation->set_rules('nama_product', 'Nama Product', 'required');
    $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
    $this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required|numeric');
    $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required|numeric');

    if ($this->form_validation->run() == FALSE) {
        $errors[] = validation_errors();
    } else {
        $id_jenis_product = $this->input->post('id_jenis_product');
        $nama_product = $this->input->post('nama_product');
        $stok = $this->input->post('stok');
        $harga_beli = $this->input->post('harga_beli');
        $harga_jual = $this->input->post('harga_jual');
        $gambar = "";

		if (!preg_match('/^[a-zA-Z0-9 ]+$/', $nama_product)) {
			$errors[] = 'Tidak mendukung spesial karakter.';
		}

        if (!is_numeric($stok) || !is_numeric($harga_beli) || !is_numeric($harga_jual)) {
            $errors[] = "Stok, harga beli, dan harga jual harus berupa angka. Silakan coba lagi.";
        } else {
            $dir = './assets/images/products/';

            if (!empty($_FILES['foto']['name'])) {
                $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
                if (in_array($_FILES['foto']['type'], $allowed_types)) {
                    if ($_FILES['foto']['size'] <= 1000000) {
                        $timestamp = time();
                        $gambar = $timestamp . '_' . $_FILES['foto']['name'];
                        move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $gambar);
                    } else {
                        $errors[] = "Gambar melebihi batas 1 MB.";
						$this->session->set_flashdata('error', display_errors($errors));
						redirect('produk');
                    }
                } else {
                    $errors[] = "Tipe file gambar tidak sesuai (harus JPG, PNG, atau GIF)";
                }
            }

            if (!empty($errors)) {
                if (file_exists($dir . $gambar)) {
                    unlink($dir . $gambar);
                    $this->session->set_flashdata('error', display_errors($errors));
                }
            } else {
                $data = array(
                    'id_jenis_product' => $id_jenis_product,
                    'nama_product' => $nama_product,
                    'stok' => $stok,
                    'harga_beli' => $harga_beli,
                    'harga_jual' => $harga_jual,
                    'foto' => $gambar
                );
                $this->db->insert('tbl_product', $data);
				$success = array("Data $nama_product behasil di edit");
				$this->session->set_flashdata('error', display_success($success));
            }
        }
    }
	redirect('produk');

	}

	public function edit_produk()
	{

        $id_product = $this->input->post('id_product');
        $file_before = $this->input->post('file_before');
        $id_jenis_product = $this->input->post('id_jenis_product');
        $nama_product = $this->input->post('nama_product');
        $stok = $this->input->post('stok');
        $harga_beli = $this->input->post('harga_beli');
        $harga_jual = $this->input->post('harga_jual');
        $gambar = "";

		if (!preg_match('/^[a-zA-Z0-9 ]+$/', $nama_product)) {
			$errors[] = 'Tidak mendukung spesial karakter.';
		}

        if (!is_numeric($stok) || !is_numeric($harga_beli) || !is_numeric($harga_jual)) {
            $errors[] = "Stok, harga beli, dan harga jual harus berupa angka. Silakan coba lagi.";
        }

        $dir = "./assets/images/products/";

        if ($_FILES['foto']['name']) {
            $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
            if (in_array($_FILES['foto']['type'], $allowed_types)) {
                if ($_FILES['foto']['size'] <= 1000000) {
                    $timestamp = time();
                    $gambar = $timestamp . '_' . $_FILES['foto']['name'];
                    move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $gambar);
                } else {
                    $errors[] = "Gambar melebihi batas 1 MB.";
                }
            } else {
                $errors[] = "Tipe file gambar tidak sesuai (harus JPG, PNG, atau GIF)";
            }
        }

        if (!empty($errors)) {
            $this->session->set_flashdata('error', display_errors($errors));
            redirect('produk');
        } else {
            if (empty($gambar)) {
                $gambar = $file_before;
            }
            $data = array(
                'id_jenis_product' => $id_jenis_product,
                'nama_product' => $nama_product,
                'stok' => $stok,
                'harga_beli' => $harga_beli,
                'harga_jual' => $harga_jual,
                'foto' => $gambar
            );
            $up = $this->Product_model->update_product($id_product, $data);
            if ($up == true) {
                $success[] = "Berhasil Mengupdate produk $nama_product";
            	$this->session->set_flashdata('error', display_success($success));
                redirect('produk');
            } else {
                $errors[] = "Tidak ada yang diupdate";
                $this->session->set_flashdata('error', display_errors($errors));
                redirect('produk');
            }
        }
    }

	public function hapus_produk($id_produk)
	{
		$del_id = $id_produk;
		$product = $this->Product_model->get_product($del_id);
		$img = $product->foto;
			$delete = $this->Product_model->delete_product($del_id);
			if($delete){
				$success[] = "Data produk berhasil dihapus.";
				$this->session->set_flashdata('error', display_success($success));
                redirect('produk');
			} else {
				$errors[] = "Data produk gagal dihapus.";
				$this->session->set_flashdata('error', display_errors($errors));
                redirect('produk');
			}
	}

	public function show_produk($id_produk)
	{
		if($id_produk){
			$data['data_produk'] = $this->Product_model->get_product($id_produk);
			// var_dump($datas);
			if($data['data_produk']==true){ 
			$this->load->view('main/produk/show_product', $data);
			}else{
			redirect('produk');
			}
		}else{
			redirect('produk');
		}
	}
	public function jenis_produk()
	{
		$data['data_jenis'] = $this->Product_model->get_all_jenis();
		$this->load->view('main/produk/jenis_product', $data);
		$this->load->view('main/extend/footer');

	}

	public function jenis_produk_edit($id)
	{
		$data['data_jenis'] = $this->Product_model->get_all_jenis();
		$data['data'] = $this->Product_model->get_jenis($id);
		// var_dump($data['data']);
		$this->load->view('main/produk/jenis_product', $data);
	}

	public function jenis_produk_add()
	{
        $this->form_validation->set_rules('nama_jenis_product', 'Nama Jenis', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
			 	$errors[] ="Ada yang salah.";
                $this->session->set_flashdata('error',  display_errors($errors));
                // redirect('jenis_produk');
				
        } else {
            // Jika form validation sukses
            $nama_jenis_product = $this->input->post('nama_jenis_product', true);
			$sqlCek = $this->Product_model->get_jenis_name($nama_jenis_product);
            
            if ($sqlCek > 0) {
                // Jika data sudah ada
				$errors[] = "$nama_jenis_product sudah ada.";
                $this->session->set_flashdata('error',  display_errors($errors));
            } else {
                // Jika data belum ada
                $insert = $this->db->query("INSERT INTO tbl_jenis_product SET nama_jenis_product = '$nama_jenis_product'");
                if ($insert) {
                    // Jika insert berhasil
					$success[] = "Berhasil menambah $nama_jenis_product pada data jenis."; 
                    $this->session->set_flashdata('error', display_success($success));
                } else {
                    // Jika insert gagal
                    $errors[] = "$nama_jenis_product sudah ada.";
                	$this->session->set_flashdata('error',  display_errors($errors));
                }
            }
				redirect('jenis_produk');
			}
	}

	public function jenis_produk_delete($id)
	{
		$delete = $this->db->query("DELETE FROM tbl_jenis_product WHERE id_jenis_product = '$id'");
		if ($delete) {
			$success = array("Data behasil di hapus");
			$this->session->set_flashdata('error', display_success($success));
			redirect('jenis_produk');
		}
	}
	
	public function jenis_produk_update($id)
	{
		$this->form_validation->set_rules('nama_jenis_product', 'Nama Jenis', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
			 	$errors[] ="Ada yang salah.";
                $this->session->set_flashdata('error',  display_errors($errors));
                // redirect('jenis_produk');
				
        } else {
            // Jika form validation sukses
            $nama_jenis_product = $this->input->post('nama_jenis_product', true);
			$sqlCek = $this->Product_model->get_jenis_name_update($nama_jenis_product, $id);
            
            if ($sqlCek > 0) {
                // Jika data sudah ada
				$errors[] = "$nama_jenis_product sudah ada.";
                $this->session->set_flashdata('error',  display_errors($errors));
            } else {
                // Jika data belum ada
                $insert = $this->db->query("UPDATE tbl_jenis_product SET nama_jenis_product = '$nama_jenis_product' where id_jenis_product = $id");
                if ($insert) {
                    // Jika insert berhasil
					$success[] = "Berhasil mengupdate $nama_jenis_product pada data jenis."; 
                    $this->session->set_flashdata('error', display_success($success));
                } else {
                    // Jika insert gagal
                    $errors[] = "$nama_jenis_product sudah ada.";
                	$this->session->set_flashdata('error',  display_errors($errors));
                }
            }
				redirect('jenis_produk');
			}
	}
	
	
}
