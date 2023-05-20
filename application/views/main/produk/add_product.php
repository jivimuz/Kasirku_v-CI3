<div class="row">
    <div class="col-md-12 col-xs-8 col-sm-8">
        <form  action="<?=base_url('main/add_produk')?>"  method="POST" enctype="multipart/form-data">
				<h3 class="login-head text-center"><i class="fa fa-plus"></i> Add Product</h3><br>
				<div class="form-group">
					<label class="control-label">Silahkan Isi data dibawah:</label>
					<input class="form-control" name="nama_product" type="text" maxlength="30" placeholder="Nama Produk" autofocus required>
                </div>
                <div class="form-group">
                <select name="id_jenis_product" class="form-control" required>
                    <option value="" hidden>Pilih</option>
					<?php 
						$jenis_products = $this->db->get('tbl_jenis_product')->result_array();
						foreach ($jenis_products as $jenis_product) {?>
						<option value="<?= $jenis_product['id_jenis_product'] ?>"><?= $jenis_product['nama_jenis_product'] ?></option>
					<?php } ?>
                </select>
                </div>
                <div class="form-group">
                    <input class="form-control" name="stok" min='1' type="number" max="9999" placeholder="Stok" autofocus required>
                </div>
                <div class="form-group">
                     <input class="form-control" name="harga_beli" min='100' type="number" max="99999999" placeholder="Harga Beli (satuan)" autofocus required>
                </div>
                <div class="form-group">
                    <input class="form-control" name="harga_jual" min='100' type="number" max="99999999" placeholder="Harga Jual (satuan)" autofocus required>
				</div>
				<div class="form-group">
                    <input class="form-control" name="foto" type="file" accept="image/png, image/gif, image/jpeg" placeholder="Tipe JPG,PNG & GIF" autofocus>
				</div>
				
				<div class="form-group btn-container">
					<button class="btn btn-primary btn-block" type="submit" name="add_product"><i class="fa fa-check fa-lg fa-fw"></i>Add</button>
				</div>
				
			</form>
    </div>
</div>
