

<div class="app-title">
	<div>
		<h1><i class="fa fa-cart-arrow-down"></i> Transaksi</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
		<li class="breadcrumb-item"><a href="javascript:void(0)">Transaksi</a></li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12 col-xs-12 col-sm-12">
		<div class="tile">
		<?php if($this->session->flashdata('error')){ echo $this->session->flashdata('error');} ?>
			
					<div class="col-md-12 col-md-offset-3">
						<div class="pull-right">
						    <button class="btn btn-primary cetak"><i class="fa fa-fw fa-lg fa-print"></i> Print</button>
						    <a href="<?=base_url('transaksi/cart')?>"  class="btn btn-info"><i class="fa fa-fw fa-lg fa-cart-plus"></i> Keranjang</a>
                        </div><br><br><br>
						
					</div>
<div class="col-md-13">
		<div class="tab-content">
			<div class="tab-pane active" id="user-info">
				<div class="user-info">

		<div class="table-responsive">
        <table class="table table-hover " id="tabelKu" width="100%">
            <thead>
                <tr><th class="text-center">No.</th>
                    <th class="text-center">Nama Kasir</th>
                    <th class="text-center">Waktu Penjualan</th>
                    <th class="text-center">Total Harga</th>
                    <th class="text-center">Opsi</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach($list as $data):?>
                    <tr><td class="text-center"><?= $data->id_transaksi?>.</td>
                       
                        <td class="text-center">
                            <?= $data->nama_pegawai  ?>
                        </td>
                        <td class="text-center"><?= date('d-m-Y H:i:s ',strtotime("$data->paid_at")); ?></td>
                        <td class="text-center">Rp. <?= buatRupiah($data->total_harga) ?></td>
                        <td class="text-center">
                        <a href="<?=base_url('transaksi/show/').$data->id_transaksi ?>" class="btn btn-sm btn-info ">&nbsp;<i class="fa fa-print"></i></a>
                        </td>
                        
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
				</div>
			</div>
		</div>

	</div>
</div>



<!--              Modal Add                   -->


<div id="cetakModal" class="modal fade" style="font-size: 12px;">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body" id="form_cetak">
    <form action="<?= base_url('laporan/cetak')?>" method="post">
        <label for="">Nama Kasir:</label>
        <select class="form-control" name='id_pegawai'>
        <option value="" selected>Semua</option>
        <?php 
						$user = $this->Pegawai->get_all_pegawai();
            foreach($user as $i){
            echo '<option value="'.$i->id_pegawai.'">'.$i->nama_pegawai.'</option>';
            }
        ?>        
        </select><br>
        <label for="">Dari Tanggal:</label>
            <input type="date" class="form-control" name="date-from" id="date-from"><br>
        <label for="">Sampai Tanggal:</label>
            <input type="date" class="form-control" name="date-to" value="<?= date('Y-m-d')?>" required id="date-to"> <br>
        <div class="alert alert-warning" id="alert-nya" hidden></div> <br>
        <div class="pull-right"><button type="submit" class="btn btn-warning" name="cek">Cetak</button>
        </div><br>
    </form>
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

<!--                   end Modal                    -->

<script>
//form input
$(document).on('click', '.cetak', function(){
  
    $('#cetakModal').modal('show');
 });


  var dateFrom = document.getElementById('date-from');
  var dateTo = document.getElementById('date-to');
  var alerts = document.getElementById('alert-nya');
  
  dateFrom.addEventListener('change', function() {
    if (dateFrom.value > dateTo.value) {
      alerts.innerHTML = "Tanggal mulai tidak boleh melebihi tanggal akhir.";
      alerts.hidden = false;
      dateFrom.value = '';
    }else{
      alerts.hidden = true;
    }
  });
  
  dateTo.addEventListener('change', function() {
    if (dateFrom.value > dateTo.value) {
      alerts.innerHTML = "Tanggal mulai tidak boleh melebihi tanggal akhir.";
      alerts.hidden = false;
      dateTo.value = '';
    }else{
      alerts.hidden = true;
    }
  });
</script>
