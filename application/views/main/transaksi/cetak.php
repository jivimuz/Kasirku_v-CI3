
<!-- Template Umum Jivi-->
<body onload="printIni()">
<div class="app-title">
	<div>
		<h1><a href="<?=base_url('transaksi')?>" class="btn btn-sm btn-default"><i class="fa fa-chevron-left"></i> </a><i class="fa fa-print"></i> Cetak Report</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
		<li class="breadcrumb-item"><a href="javascript:void(0)">Cetak Report</a></li> <!-- Ini Sesuaikan menu -->
	</ul>
</div>
<div class="tile row">
		
   <!---------------------------------------- Ini yang di edit dari bawah -------------------------------------------->
   <div class="table-responsive">
	<img src="<?=base_url('assets/')?>images/assets/kop.png" class="table-responsive " with="100%"><br><br>
   	<h5 class="text-center">Laporan  
        <?php 
		if(!empty($date_from)){echo 'dari  '. date('d-m-Y', strtotime($date_from));}?> 
		sampai 
		<?=date('d-m-Y', strtotime($date_to)) ?> :</h5>
   	<table class="table " width="100%"  style="font-size:12px">
   		<thead>
		<tr  bgcolor="#f0f0f0">
   			<th>No.</th>
   			<th>Waktu Transaksi</th>
   			<th>Nama Kasir</th>
   			<th>Total Harga</th>
   		</tr>
		</thead>
		<tbody>
   		<?php $no = 0;
		$total = 0;
   		if ($data->num_rows() > 0) {
   		 foreach($data->result() as $i) { 
			$total =$total + $i->total_harga;
   		 	$no++;?>
   		<tr>
   			<td><?= $no;?></td>
   			<td><?= $i->paid_at;?></td>
   			<td><?= $i->nama_pegawai;?></td>
   			<td>Rp. <?= buatRupiah($i->total_harga);?></td>
   		</tr>
   	<?php }}else{?>
		<tr>
			<td colspan="4" class="text-center">Tidak Ada Data</td>
		</tr>
   	<?php }?>
	   <tr bgcolor="#f0f0f0">
			<td colspan="3" class="text-right">Total :</td>
			<td colspan="1" >Ro. <?=buatRupiah($total)?></td>
		</tr>
		</tbody>
   	</table>
   </div>
</div>
</body>
