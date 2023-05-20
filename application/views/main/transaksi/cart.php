
<?php foreach($data as $da){?>

<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="main.css">
	<title>Keranjang</title>
</head>
<body>
<div class="app-title">
	<div class="row">
		<a href="<?=base_url('transaksi')?>" class="btn btn-default"><i class="fa fa-chevron-left"></i></a><h1><i class="fa fa-cart-plus"></i> Keranjang</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
		<li class="breadcrumb-item"><a href="<?=base_url()?>transaksi">Transaksi</a></li>
		<li class="breadcrumb-item"><a href="javascript:void(0)">Keranjang</a></li>
	</ul>
</div>
<div class="tile">
		<?php if($this->session->flashdata('error')){ echo $this->session->flashdata('error');} ?>
   
    <div class="col-md-12">
        <form  action="<?=base_url('transaksi/cart/a/').$da->id_transaksi?>"  method="POST">
        <datalist id="auto-product">
            <?php $lists = $this->db->query("SELECT nama_product FROM tbl_product where stok > 0 order by nama_product asc");
			$list = $lists->result();
            foreach($list as $li){
                echo "<option value='".$li->nama_product."'>";
            }
            ?>    
        </datalist>
        <div class="row">
            <div class="col-md-10">
                <input type="text" name="id_transaksi" value="<?=$da->id_transaksi?>" hidden>
                <input type="text" name="product" onkeyup="cekNamaProduct()" id="product" list="auto-product" placeholder="Masukan nama barang untuk menambah barang" class="form-control">
            </div>
                <button type="submit" class="btn btn-lg btn-primary col-md-2" disabled name="add-product" id="add-product"><i class="fa fa-cart-plus"></i></button>
        </div>
		</form>
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
                    <th colspan="2">Subtotal</td>
                 </tr>
                <?php 
                $total = 0;

                $d = $this->db->query("SELECT tbl_cart.*, tbl_product.*
                FROM tbl_cart 
                JOIN tbl_product ON tbl_cart.id_product = tbl_product.id_product 
                WHERE tbl_cart.id_transaksi = '$da->id_transaksi'");
                           
                if($d->num_rows() > 0){
                    foreach($d->result() as $i){?>
                 <tr>
                    <td><?= $i->nama_product?></td>
                    <td>Rp. <?= buatRupiah($i->harga_jual)?></td>
                    <td>
                        <form action='<?=base_url('transaksi/cart/b/').$i->id_cart?>' method='post'>
                            <input type="text" name="id_product" value="<?=$i->id_product?>" hidden>
                            <input type="text" name="qty_before" value="<?=$i->qty?>" hidden>
                            <input type="text"  pattern="[0-9]+" min="1" onchange="this.value = Math.max(Math.ceil(Math.abs(this.value || 1)) || 1); submit();" max="<?=$i->stok + $i->qty?>" style="width:50px" required name="qty" class="" value="<?=$i->qty?>">
                            <!-- <button type="submit" name="upCart" ><i class="fa fa-save"></i></button> -->
                        </form>
                    </td>
                    <td><?php 
                        $sub = $i->harga_jual * $i->qty;
                        $total += $sub;
                        echo 'Rp. '.buatRupiah($sub);
                    ?></td>
                    <td>
                        <form method="post" action="<?=base_url('transaksi/cart/c/').$i->id_cart?>">
                            <input type="text" name="id_product" value="<?=$i->id_product?>" hidden>
                            <input type="text" name="qty_before" value="<?=$i->qty?>" hidden>
                            <button type="submit" name="delCart" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                 </tr>
                 <?php }}?>

                 <tr>
                    <th colspan="3">Total pembelian :</td>
                    <th colspan="2">Rp. <?= buatRupiah($total)?></td>
                    
                 </tr>
                 <tr>
                    <th colspan="3">Tunai :</td>
                    <th colspan="2">Rp. <input type="text" id="uang" onkeyup="kembalian();" style="width:130px;" maxlength="99999999999" value="0"?></td>
                 </tr>
                 <tr>
                    <th colspan="3">Total Kembalian :</td>
                    <th colspan="2"><span id="kembalian">Rp. <?= buatRupiah(0)?></span></td>
                 </tr>
             </table>
            </td>
        </tr>
    </table>
    
    </div>
    <div class="row">
            <div class="col-md-4 text-left">
                <a href="<?=base_url()?>transaksi" class="btn btn-lg btn-warning"><i class="fa fa-chevron-left"></i> Kembali</a></div>
            <div class="col-md-4 text-center">
                <form action="<?=base_url('transaksi/cart/d/').$da->id_transaksi?>" method="post">
                <button class="btn btn-sm btn-danger"type="submit"><i class="fa fa-trash"></i> Reset Pesanan</button>
            </form>
            </div>
            <div class="col-md-4 text-right">
            <form action="<?=base_url('transaksi/cart/save/').$da->id_transaksi?>" method="post">
                <input type="text" hidden name="data-1" id="data-1" value="<?=$total?>">
                <input type="text" hidden name="data-2" id="data-2">
                <input type="text" hidden name="data-3" id="data-3">
                <button type="submit" disabled name="data-post" id="data-post" class="btn btn-lg btn-info"><i class="fa fa-save" onclick="return confirm('apakah yakin untuk submit')"></i> Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>

<script>
function cekNamaProduct() {
    var product = document.getElementById("product").value;
    var options = document.getElementById("auto-product").options;
    var addButton = document.getElementById("add-product");
    var found = false;

    // Loop through options to check if value exists
    for (var i = 0; i < options.length; i++) {
        if (product == options[i].value) {
            found = true;
            break;
        }
    }

    // Enable/disable button based on value existence
    if (found) {
        addButton.disabled = false;
    } else {
        addButton.disabled = true;
    }
}
</script>
<script>
  function kembalian() {
  var uang = parseFloat(document.getElementById('uang').value);
  var total = parseFloat(document.getElementById('data-1').value);
  var kembalian = uang - total;
  if(uang >= total && total > 0){
    document.getElementById('data-post').disabled = false;
  }else{
    document.getElementById('data-post').disabled = true;
  }

  if (!isNaN(kembalian)) {
    document.getElementById('data-2').value = uang;
    document.getElementById('data-3').value = kembalian;
    document.getElementById('kembalian').innerHTML = buatRupiah(kembalian);
  } 
  
}

function buatRupiah(angka) {
  var hasil = angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  hasil = "Rp. " + hasil + ",-";
  return hasil;
}
</script>

<?php }?>
