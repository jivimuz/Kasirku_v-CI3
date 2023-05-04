<?php if($dataku['is_admin'] == 1){?>

<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="main.css">
	<title>Pegawai</title>
</head>
<body>
<div class="app-title">
	<div>
		<h1><i class="fa fa-users"></i> Pegawai</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
		<li class="breadcrumb-item"><a href="javascript:void(0)">Pegawai</a></li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12 col-xs-12 col-sm-12">
		<div class="tile">
			<?php if($this->session->flashdata('error')){ echo $this->session->flashdata('error');} ?>
						
					<div class="col-md-12 col-md-offset-3">
						<div class="pull-right">
						    <button class="btn btn-primary add_p"><i class="fa fa-fw fa-lg fa-user-plus"></i> User</button>
                        </div><br><br><br>
						
					</div>
<div class="col-md-13">
		<div class="tab-content">
			<div class="tab-pane active" id="user-info">
				<div class="user-info">

		<div class="table-responsive">
        <table class="table table-hover" id="tabelKu" width="100%">
            <thead>
                <tr><th class="text-center">No.</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">No. HP</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Opsi</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                $noUrut = 0;
                $sql = $this->db->query("SELECT * FROM tbl_pegawai order by id_pegawai desc");

                foreach($sql->result_array() as $data){
                        $noUrut++?>
                    <tr>
						<td><?= $noUrut?></td>
                        <td><?= $data['nama_pegawai'] ?></td>
                        <td class="text-center"><?= $data['email'] ?></td>
                        <td class="text-center"><?= $data['no_hp'] ?></td>
                        <td class="text-center">
                            <?php if($data['is_admin'] == 1) {?>
                                <img src="<?=base_url('assets/');?>images/assets/role1.png" width="50px">
                            <?php } else {?>
                                <img src="<?=base_url('assets/');?>images/assets/role2.png" width="50px">
                            <?php }?>
                        </td>

                        <td class="text-center">
                        <a class="btn btn-warning btn-sm edit_p" id="<?=$data['id_pegawai']?>">&nbsp;<i class="fa fa-pencil" ></i></a>
                        <?php if($data['id_pegawai']=="1"):?> 
                            <a href="#"  disabled class="btn btn-sm btn-light tombol-hapus" alt="Tidak menghapus Administrator"	>&nbsp;<i class="fa fa-trash"></i></a>
                        <?php elseif($data['id_pegawai']== $dataku['id_pegawai']):?> 
                            <a href="#"  disabled class="btn btn-sm btn-light tombol-hapus" alt="Tidak menghapus Administrator"	>&nbsp;<i class="fa fa-trash"></i></a>
                        <?php else :?>

							<a class="btn btn-sm btn-danger hapusModal" id="hapusModal__<?=$data['id_pegawai']?>"  data-toggle="modal" data-target="#deleteModal">&nbsp;<i class="fa fa-trash"></i></a>

                        <?php endif;?>
                        </td>
                        
                    </tr>

                <?php } ?>
            </tbody>
        </table>
				</div>
			</div>
		</div>

	</div>
</div>



<!--              Modal Add                   -->


<div id="addModal" class="modal fade" style="font-size: 12px;">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body" id="form_add">
     
   </div>                      
<div class="row text-right">
                        <div class="col-md-12">
<span>
    <button style="font-size:12px;" type="button" class="btn btn-dark" id="tutop" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;</span>
</div>
   </div>
  </div>
 </div>
</div>

<!--                 Modal Edit_Pegawai                   -->


<div id="editModal" class="modal fade" style="font-size: 12px;">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <br>
   <div class="modal-body" id="form_edit">  
   </div>
                      
<div class=" row text-right">

                        <div class="col-md-12">
<span>
    <button style="font-size:12px;" type="button" class="btn btn-dark" id="tutop" data-dismiss="modal">Close</button>&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;</span>
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
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus produk ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="<?= base_url('main/hapus_pegawai/') ?>" id="hapusLink" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
<!--       end Modal                    -->

<script>

	$(document).ready(function(){
    $('.hapusModal').click(function(){
        let isi = $(this).text();
        let tid = $(this).prop('id');
        let rid = tid.split('__');
        let id_baris = rid[1];
		var hapuslink = document.getElementById('hapusLink');

        if(id_baris){
			hapuslink.href = "<?= base_url('main/hapus_pegawai/')?>"+id_baris;
        }
    })
})

//form input
$(document).on('click', '.add_p', function(){
  $.ajax({
   url:"<?=base_url('pegawai/add');?>",
   success:function(data){
    $('#form_add').html(data);
    $('#addModal').modal('show');
   }
  });
 });

 $(document).on('click', '.edit_p', function(){
  var idnya = $(this).attr("id");
  $.ajax({
   url: "<?= base_url('pegawai/edit');?>",
   method:"POST",
   data:{idnya:idnya},
   success:function(data){
    $('#form_edit').html(data);
    $('#editModal').modal('show');
   }
  });
 });



</script>
<?php }?>
