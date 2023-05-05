<?php if($dataku['is_admin'] == 1){?>
<div class="row">
    <div class="col-md-12 col-xs-8 col-sm-8">
        <form  action="<?=base_url('main/add_pegawai')?>"  method="POST">
				<h3 class="login-head text-center"><i class="fa fa-user-plus"></i> Add Pegawai</h3><br>
				<div class="form-group">
					<label class="control-label">Silahkan Isi data dibawah:</label>
					<input class="form-control" name="username" type="text" maxlength="30" placeholder="Username" onkeyup="this.value = this.value.toUpperCase();removeSpaces(this);" autofocus required>
                </div>
                <div class="form-group">
                    <input class="form-control" name="password" type="password" minlength="6" maxlength="50" placeholder="Password (min 6)" autofocus required>
                </div>
                <div class="form-group">
                     <input class="form-control" name="nama_pegawai" type="text" maxlength="50" placeholder="Nama Lengkap" autofocus required>
                </div>
                <div class="form-group">
                    <input class="form-control" name="email" type="email" maxlength="255" placeholder="Email" autofocus required>
				</div>
				<div class="form-group">
                    <input class="form-control" name="no_hp" type="number" maxlength="99999999999999" placeholder="No. HP" autofocus>
				</div>
				<div class="form-group form-control">
                    <input type="checkbox" value="1" name="is_admin"> Is Admin?
                </div>
				<div class="form-group btn-container">
					<button class="btn btn-primary btn-block" type="submit" name="do_register"><i class="fa fa-check fa-lg fa-fw"></i>Register</button>
				</div>
				
			</form>
    </div>
</div>
<?php }?>
