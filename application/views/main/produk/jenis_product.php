<?php 
if ($edit = $this->uri->segment(2)) {
	$nama_jenis_product = ((isset($_POST['nama_jenis_product']))?sanitize($_POST['nama_jenis_product']):$data->nama_jenis_product);
	$nama_jenis_product = trim($nama_jenis_product);
}
$this->load->model('product_model');

$errors = array();
?><div class="app-title">
	<div class="row">
		<a href="<?= base_url('produk')?>" class="btn btn-default"><i class="fa fa-chevron-left"></i></a><h1> Jenis</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
		<li class="breadcrumb-item"><a href="<?=base_url()?>produk">Produk</a></li>
		<li class="breadcrumb-item"><a href="javascript:void(0)">jenis</a></li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
	<?php if($this->session->flashdata('error')){ echo $this->session->flashdata('error');} ?>
	</div>
	<div class="col-md-4">
		<div class="tile">
			<?php if($edit): ?>
				<form action="<?= base_url('jenis_produk/update/'). $data->id_jenis_product; ?>" method="POST">
					<div class="tile-body">
						<div class="form-group">
							<label class="control-label col-md-4" for="nama_jenis_product">Jenis</label>
							<div class="col-md-12">
								<input class="form-control" id="nama_jenis_product" type="text" placeholder="Nama Jenis Product" name="nama_jenis_product" autofocus value="<?= $nama_jenis_product; ?>">
							</div>
						</div>
					</div>
					<div class="tile-footer">
						<div class="row">
							<div class="col-md-12 row">
								<div class="col-md-5">
								<button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
								</div>
								<div class="col-md-6">
									<a href="<?=base_url('jenis_produk')?>" class="btn btn-default">Batal <i class="fa fa-fw fa-remove"></i></a>
								</div>
							</div>
						</div>
					</div>
					</form>
			<?php else: ?>
				<form action="<?= base_url('jenis_produk/add')?>" method="POST">
						<div class="tile-body">
							<div class="form-group">
								<p>Nama Jenis Produk </p>
								<div class="col-md-12">
									<input class="form-control" id="nama_jenis_product" type="text" placeholder="Nama Jenis Produk" name="nama_jenis_product" autofocus value="">
								</div>
							</div>
						</div>
						<div class="tile-footer">
							<div class="row">
								<div class="col-md-8 col-md-offset-3">
									<button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
								</div>
							</div>
						</div>
					</form>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-md-8">
			<div class="tile">
				<div class="tile-body">
					<div class="table-responsive">
						<table class="table table-hover" id="tabelKu">
							<thead>
								<tr>
									<th class="text-center">Jenis</th>
									<th class="text-center">Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach ($data_jenis as $data) :
								$r = $this->Product_model->get_by_jenis($data->id_jenis_product);?>
									<tr>
										<td class="text-center"><?= $data->nama_jenis_product; ?> <span class="badge badge-warning">
										<?= $r?>
										</span></td>
										<td class="text-center">				
											<a href="<?=base_url('jenis_produk/'). $data->id_jenis_product; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
									<?php
									if($r==0){?>
											<a href="<?=base_url('jenis_produk/hapus/'). $data->id_jenis_product; ?>" class="btn btn-sm btn-danger tombol-hapus"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php } endforeach; ?>
							</tbody>
						</table><br>
					</div><div class="alert alert-warning">
			<strong>*Notes :</strong><br>
			Hanya dapat menghapus jenis product yang kosong 
				</div>
			</div>
		</div>
		
		</div>
	</div>
	
	
