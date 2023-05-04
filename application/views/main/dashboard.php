
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="main.css">
	<title>Dashboard</title>
</head>
<body>
<div class="app-title">
	<div class="row"><h1><i class="fa fa-Dashboard"></i> Dashboard</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
		<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
	</ul>
</div>

<div class="tile row">
<div class="col-md-12">
    <h4 class="text-center">Selamat datang di aplikasi Kasirku</h4>
    <br>
</div>
<div class="col-md-7">
<div style="width: 500px;">
    <canvas id="myChart"></canvas>
</div>
</div>
<div class="col-md-5 row">
        
            <div class="col-md-6">

			<h4 class="text-danger " >Menu Kasir</h3>
            <div class='col-md-12 p-2'>
			<a class="btn btn-warning" href="<?=base_url('produk')?>"><i class=" fa fa-cube"></i>Produk</a>
            </div>
            <div class='col-md-12 p-2 text-left'>
			<a class="btn btn-warning" href="<?=base_url('transaksi')?>"><i class="fa fa-cart-arrow-down"></i>Transaksi</a>
            </div>
            </div>
            <?php if($dataku['is_admin'] == 1):?>
            <div class="col-md-6">
			<h4 class=" text-danger col-md-12">Menu Admin</h3>
            <div class='col-md-12 p-2'>
			<a class="btn btn-warning" href="<?=base_url('pegawai')?>"><i class=" fa fa-users"></i>Pegawai</a>
            </div>
            </div>
			<?php endif;?>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
 

var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: JSON.parse(<?php echo json_encode($chart_labels); ?>),
        datasets: [{
            label: 'Jumlah Transaksi Produk',
            data: JSON.parse(<?php echo json_encode($chart_values); ?>),
            backgroundColor: random_color(),
            borderColor: random_color(),
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

function random_color() {
    var red = Math.floor(Math.random() * 256);
    var green = Math.floor(Math.random() * 256);
    var blue = Math.floor(Math.random() * 256);
    var color = 'rgb(' + red + ', ' + green + ', ' + blue + ')';
    return color;
}
</script>
