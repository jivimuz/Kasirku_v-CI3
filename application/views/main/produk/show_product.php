

<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="main.css">
	<title>Detail Produk</title>
</head>
<body>
<div class="app-title">
    <div class="row">
		<a href="<?=base_url('produk')?>" class="btn btn-default"><i class="fa fa-chevron-left"></i></a><h1><i class="fa fa-cube"></i> Detail Produk</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
		<li class="breadcrumb-item"><a href="<?=base_url('produk')?>">Produk</a></li>
		<li class="breadcrumb-item"><a href="javascript:void(0)">detail</a></li>
	</ul>
</div>

<!-- Main Content -->
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Produk</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4  text-center">
					<?php if(!empty($data_produk->foto)){?>
                    <img src="<?=base_url('assets/')?>images/products/<?= $data_produk->foto?>" class="img-fluid rounded" alt="Produk">
					<?php }else{?>
						<i style="font-size:200px" class="fa fa-cube" alt="Produk"></i>

					<?php }?>
                </div>
                <div class="col-md-8">
                    <h2 class="mb-3"><?= $data_produk->nama_product; ?></h2>
                    <!-- <p class="lead"><?php // $data_produk->deskripsi; ?></p> -->
                    <hr>
                    <h3 class="mb-3">Detail Produk</h3>
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th>Kategori</th>
                                <td>
								<?php
									if (!empty($data_produk->id_jenis_product)) {
										$query = $this->db->get_where('tbl_jenis_product', array('id_jenis_product' => $data_produk->id_jenis_product));
										echo $query->row()->nama_jenis_product;
									}
									?>
							</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>Rp <?= buatRupiah($data_produk->harga_jual); ?></td>
                            </tr>
                            <tr>
                                <th>Stok</th>
                                <td><?= $data_produk->stok; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- <a href="<?php echo site_url('produk/edit/' . $data_produk->id_produk); ?>" class="btn btn-warning btn-block">Edit</a> -->
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteModal">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus produk ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="<?= base_url('main/hapus_produk/') . $data_produk->id_product ?>" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
