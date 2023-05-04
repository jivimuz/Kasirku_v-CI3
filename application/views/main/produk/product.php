

<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="main.css">
	<title>Produk</title>
</head>
<body>
<div class="app-title">
	<div>
		<h1><i class="fa fa-cube"></i> Produk</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
		<li class="breadcrumb-item"><a href="javascript:void(0)">Produk</a></li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12 col-xs-12 col-sm-12">
		<div class="tile">
		<?php if($this->session->flashdata('error')){ echo $this->session->flashdata('error');} ?>
			
					<div class="col-md-12 col-md-offset-3">
						<div class="pull-right">
						    <a href="<?=base_url('jenis_produk')?>"  class="btn btn-warning"><i class="fa fa-fw fa-lg fa-eye"></i> Jenis Produk</a>
						    <button class="btn btn-primary add_p"><i class="fa fa-fw fa-lg fa-plus"></i> Produk</button>
                        </div><br><br><br>
						
					</div>
<div class="col-md-13">
		<div class="tab-content">
			<div class="tab-pane active" id="user-info">
				<div class="user-info">

		<div class="table-responsive">
        <table class="table table-hover table-bordered" id="tabelKu" width="100%">
            <thead>
                <tr><th class="text-center">No.</th>
                    <th class="text-center">-</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Jenis</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">Harga Jual</th>
                    <th class="text-center">Opsi</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                $noUrut = 0;
                $sql = $this->db->query("SELECT tbl_product.*, tbl_jenis_product.* FROM tbl_product 
                        JOIN tbl_jenis_product ON tbl_product.id_jenis_product = tbl_jenis_product.id_jenis_product 
                        ORDER BY tbl_product.id_product DESC");

					foreach($sql->result_array() as $data){
                    $file = file_exists('./assets/images/products/'.$data['foto']);

                        $noUrut++?>
                    <tr><td class="text-center"><?= $noUrut?>.</td>
                        <td class="text-center">
                        <?php if($file && !empty($data['foto'])): ?>
                            <a id="show_foto" data-toggle="modal" data-target="#img" href="javascript:void(0)" data-id="<?= $data['id_product']; ?>" data-foto="<?= $data['foto']; ?>">
                                <img class="img-responsive user-img-data img-thumbnail" alt="<?= $data['foto']; ?>" src="<?= './assets/images/products/'.$data['foto']; ?>" />
                            </a>
						<?php else: ?>
											<i class="fa fa-cube fa-fw"></i>
						<?php endif; ?></td>
                        <td><?= $data['nama_product'] ?></td>
                        <td class="text-center"><?= $data['nama_jenis_product'] ?></td>
                        <td class="text-center"><?php if($data['stok'] > 0){ echo $data['stok'];}else{ echo "<span class='text-danger'>Habis</span>";} ?></td>
                        <td class="text-center">Rp. <?= buatRupiah($data['harga_jual']) ?></td>
                        <td class="text-center">
                        <a href="<?= base_url('produk/') . $data['id_product'] ?>" class="btn btn-sm btn-info">&nbsp;<i class="fa fa-eye"></i></a>


                        <a class="btn btn-warning btn-sm edit_p" id="<?=$data['id_product']?>">&nbsp;<i class="fa fa-pencil" ></i></a>
                        
                        

						<a class="btn btn-sm btn-danger hapusModal" id="hapusModal__<?=$data['id_product']?>"  data-toggle="modal" data-target="#deleteModal">&nbsp;<i class="fa fa-trash"></i></a>
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



<div id="img" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body" id="modal-gambar">
				<div style="padding-bottom: 5px;">
					<center>
						<img src="" id="pict" alt="" class="img-responsive img-thumbnail">
					</center>
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
                <a href="<?= base_url('main/hapus_produk/') ?>" id="hapusLink" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<!--     end Modal      -->

<script>
   
$(document).ready(function(){
    $('.hapusModal').click(function(){
        let isi = $(this).text();
        let tid = $(this).prop('id');
        let rid = tid.split('__');
        let id_baris = rid[1];
		var hapuslink = document.getElementById('hapusLink');

        if(id_baris){
			hapuslink.href = "<?= base_url('main/hapus_produk/')?>"+id_baris;
        }
    })
})


//form input
$(document).on('click', '.add_p', function(){
  $.ajax({
   url:"<?= base_url('produk/add')?>",
   success:function(data){
    $('#form_add').html(data);
    $('#addModal').modal('show');
   }
  });
 });

 $(document).on('click', '.edit_p', function(){
  var idnya = $(this).attr("id");
  $.ajax({
   url:"<?= base_url('produk/edit')?>",
   method:"POST",
   data:{idnya:idnya},
   success:function(data){
    $('#form_edit').html(data);
    $('#editModal').modal('show');
   }
  });
 });

 $(document).on("click", "#show_foto", function() {
		var id = $(this).data('id');
		var ft = $(this).data('foto');
		$("#modal-gambar #id").val(id);
		$("#modal-gambar #pict").attr("src", "<?= base_url('assets/images/products/'); ?>"+ft);
	});
</script>
