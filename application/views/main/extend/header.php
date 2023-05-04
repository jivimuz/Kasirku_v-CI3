<?php $page = $this->uri->segment(1);?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="#">

	<!-- og:property -->
	
<meta name="mobile-web-app-capable" content="yes">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/main.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/dropify.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/sweetalert2.css">

	<script src="<?=base_url('assets/')?>js/jquery-3.3.1.min.js"></script>
	
	<script src="<?=base_url('assets/')?>js/dropify.min.js"></script>
	<script src="<?=base_url('assets/')?>js/popper.min.js"></script>
	<script src="<?=base_url('assets/')?>js/bootstrap.min.js"></script>
	<script src="<?=base_url('assets/')?>js/sweetalert.min.js"></script>


</head>
<body class="app sidebar-mini">
<header class="app-header">
	<a class="app-header__logo text-left" href="<?=base_url()?>">KASIRKU</a>
	<a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
	<?php if($page == 'cetak') {?>
	<a class="app-nav__item btn btn-default"  onclick="printIni()" style="text-decoration: none;"><i class="fa fa-print"></i>Print Page</a>
	<?php }?>
		<ul class="app-nav ">

			<li class="dropdown"><a class="app-nav__item" href="javascript:void(0)" style="text-decoration: none;" data-toggle="dropdown" aria-label="Open Profile Menu">
				<i class="fa fa-user fa-lg"></i>&nbsp; <?= $dataku['nama_pegawai']; ?></a>
				<ul class="dropdown-menu settings-menu dropdown-menu-right">
				    <li><a class="dropdown-item" style="font-size:14px;" data-toggle="modal" data-target="#logoutModal" href="<?=base_url('logout')?>"  id="logout" >&nbsp;&nbsp;<i class="fa fa-sign-out fa-lg"></i> &nbsp;Logout</a></li>
				</ul>
			</li>
		</ul>
</header>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
	<aside class="app-sidebar">
		<ul class="app-menu">
			<h6 class="title-menu">Dashboard</h6>
			<li><a class="app-menu__item <?php if($page=='' || $page=='dashboard'){echo "active";} ?>" href="<?=base_url('dashboard')?>"><i class="app-menu__icon fa fa-dashboard"></i>
			<span class="app-menu__label">Dashboard</span></a></li>
			
			<?php if($dataku['is_admin'] == 1):?>
			<h6 class="title-menu">Menu Admin</h6>
			<li><a class="app-menu__item <?php if($page=='pegawai'){echo "active";} ?>" href="<?=base_url('pegawai')?>"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Pegawai</span></a></li>
			<?php endif;?>

			<h6 class="title-menu">Menu Kasir</h6>
			<li><a class="app-menu__item <?php if($page=='produk'){echo "active";} ?>" href="<?=base_url('produk')?>"><i class="app-menu__icon fa fa-cube"></i><span class="app-menu__label">Produk</span></a></li>
			<li><a class="app-menu__item <?php if($page=='transaksi'){echo "active";} ?>" href="<?=base_url('transaksi')?>"><i class="app-menu__icon fa fa-cart-arrow-down"></i><span class="app-menu__label">Transaksi</span></a></li>
			<li><a class="app-menu__item"  data-toggle="modal" data-target="#logoutModal"  href="<?=base_url('logout')?>"><i class="app-menu__icon fa fa-sign-out"></i><span class="app-menu__label">Logout</span></a></li>
		</ul>
	</aside>
<div>
	
<!-- logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin Log out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="<?= base_url('logout')?>" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>

<main class="app-content">
