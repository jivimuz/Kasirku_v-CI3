<?php foreach($data as $d){?>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="main.css">
	<title>Cetak Invoice</title>
</head>
<body onload="printIni()">
<div class="app-title">
	<div class="row">
		<a href="<?=base_url('transaksi')?>" class="btn btn-default"><i class="fa fa-chevron-left"></i></a><h1><i class="fa fa-cart-plus"></i> Cetak Invoice</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
		<li class="breadcrumb-item"><a href="<?=base_url('transaksi')?>">Transaksi</a></li>
		<li class="breadcrumb-item"><a href="javascript:void(0)">Cetak Invoice</a></li>
	</ul>
</div>
<div class="tile">
<img src="<?=base_url('assets/images/assets/')?>kop.png" class="table-responsive p-3" with="100%"><br><br>
    <div class="col-md-12 p-3">
    	<strong>ID Transaksi :</strong> TRX-<?=$d->id_transaksi?><br>
        <strong>Tanggal Transaksi :</strong> <?=tgl_indonesia(date('Y-m-d', strtotime($d->paid_at)))?><br>
        <!-- <strong>Nama Penerima :</strong><br> -->
	</div>
    <div class="col-md-12 ">
    <div class="table-responsive">
     <table class="table" width="100%"  border="1">
        <tr style="background-color: gold;">
            <th> Keranjang Pesanan
            </th>
        </tr>
        <tr>
            <td>
            <table class="table table-hover" width="100%"  id="">
                 <tr>
                    <th>Produk</td>
                    <th>Harga</td>
                    <th>Qty</td>
                    <th >Subtotal</td>
                 </tr>
                <?php
				$this->load->model('Transaksi_model') ;
                $dd = $this->Transaksi_model->get_cart_by_id($d->id_transaksi);
                $total = 0;
                    foreach($dd as $i){?>
                 <tr>
                    <td><?= $i->nama_product?></td>
                    <td>Rp. <?= buatRupiah($i->harga_satuan)?></td>
                    <td><?=$i->qty?></td>
                    <td><?php 
                        $sub = $i->harga_satuan * $i->qty;
                        $total += $sub;
                        echo 'Rp. '.buatRupiah($sub);
                    ?></td>
                    
                 </tr>
                 <?php }?>

                 <tr>
                    <th colspan="3">Total pembelian :</td>
                    <th >Rp. <?= buatRupiah($total)?></td>
                    
                 </tr>
                 <tr>
                    <th colspan="3">Tunai :</td>
                    <th >Rp. <?= buatRupiah($d->total_tunai)?></td>
                 </tr>
                 <tr>
                    <th colspan="3">Total Kembalian :</td>
                    <th >Rp. <?= buatRupiah($d->total_kembali)?></td>
                 </tr>
             </table>
            </td>
        </tr>
    </table>
    
    </div>
        <div class="row">
          <p class="col-md-8" ><p>
            <h6 class="col-md-4 text-center" style="padding-bottom:70px;padding-top:20px;">
                Kasir : <?= $d->nama_pegawai?>
            </h6>
        </div>
        <p class="text-center">Terimakasih telah belanja di toko kami</p> 
    </div>
</div>
<?php }?>
