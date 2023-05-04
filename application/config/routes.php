<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['auth'] = 'auth/index';
$route['logout'] = 'auth/logout';


$route['dashboard'] = 'main/index';


$route['pegawai'] = 'main/pegawai';
$route['pegawai/add'] = 'modal/add_pegawai';
$route['pegawai/edit'] = 'modal/edit_pegawai';


$route['produk'] = 'main/produk';
$route['produk/add'] = 'modal/add_produk';
$route['produk/edit'] = 'modal/edit_produk';
$route['produk/(:num)'] = 'main/show_produk/$1';


$route['jenis_produk'] = 'main/jenis_produk';
$route['jenis_produk/add'] = 'main/jenis_produk_add';
$route['jenis_produk/hapus/(:num)'] = 'main/jenis_produk_delete/$1';
$route['jenis_produk/update/(:num)'] = 'main/jenis_produk_update/$1';
$route['jenis_produk/(:num)'] = 'main/jenis_produk_edit/$1';


$route['transaksi'] = 'transaksi/transaksi_index';
$route['transaksi/show/(:num)'] = 'transaksi/transaksi_show/$1';
$route['transaksi/cart'] = 'transaksi/cart_index';
$route['transaksi/cart/a/(:num)'] = 'transaksi/cart_add_produk/$1';
$route['transaksi/cart/b/(:num)'] = 'transaksi/cart_qty_produk/$1';
$route['transaksi/cart/c/(:num)'] = 'transaksi/cart_delete_produk/$1';
$route['transaksi/cart/d/(:num)'] = 'transaksi/cart_reset_produk/$1';
$route['transaksi/cart/save/(:num)'] = 'transaksi/cart_save/$1';
$route['laporan/cetak'] = 'transaksi/cetak';

