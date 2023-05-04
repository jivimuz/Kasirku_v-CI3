<?php if($dataku['is_admin'] == 1){

if(isset($_POST["idnya"])){
     $id_pegawai = $_POST["idnya"];
     $dataa = $this->db->query("SELECT * FROM tbl_pegawai WHERE id_pegawai = '$id_pegawai'");
     $data = $dataa->row_array();
}
?>
<div class="row">
    <div class="col-md-12 col-xs-8 col-sm-8">
        <form  action="<?=base_url('main/edit_pegawai')?>"  method="POST">
				<h3 class="login-head text-center"><i class="fa fa-user-plus"></i> Edit Pegawai</h3><br>
				<div class="form-group">
					<label class="control-label">Silahkan Isi data dibawah:</label>
					<input class="form-control" name="id_pegawai" value="<?= $data['id_pegawai']?>" hidden>
					<input class="form-control" name="pass_before" value="<?= $data['password']?>" hidden>
					<input class="form-control" name="username" readonly value="<?= $data['username']?>" type="text" maxlength="30" placeholder="Username" onkeyup="this.value = this.value.toUpperCase()" autofocus required>
                </div>
                <div class="form-group">
                    <input class="form-control" name="password"  type="password" maxlength="50" placeholder="Password (min 6) /  Kosongkan jika tidak diedit" autofocus>
                </div>
                <div class="form-group">
                     <input class="form-control" name="nama_pegawai" value="<?= $data['nama_pegawai']?>" type="text" maxlength="50" placeholder="Nama Lengkap" autofocus required>
                </div>
                <div class="form-group">
                    <input class="form-control" name="email" value="<?= $data['email']?>" type="email" maxlength="255" placeholder="Email" autofocus required>
				</div>
               <div class="form-group">
                    <input class="form-control" name="no_hp" value="<?= $data['no_hp']?>" type="number" maxlength="99999999999999" placeholder="No. HP" autofocus>
               </div>
               <div class="form-group form-control"<?php if($data['id_pegawai'] == 1){echo 'hidden';} ?>>
                    <input type="checkbox" value="1" name="is_admin" 
                    <?php if($data['is_admin'] == 1){echo 'checked';} ?>

                    
                    > Is Admin?
               </div>
               <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block" type="submit" name="do_edit"><i class="fa fa-check fa-lg fa-fw"></i>Update</button>
               </div>
				
			</form>
    </div>
</div>
<?php }?>
