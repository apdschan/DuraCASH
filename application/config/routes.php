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
$route['default_controller'] = 'Beranda';
$route['api/demo'] = 'api/ApiDemoController/index';
//login user
$route['user/login'] = 'user/Login/index';
//Register user
$route['user/register'] = 'user/Login/register';
//dashboard admin
$route['admin/dashboard/(:any)'] = 'admin/Admin/index/$1';
//akun admin
$route['admin/akun/(:any)'] = 'admin/Admin/akun/$1';
//manage kasir admin
$route['admin/kasirpelanggan/(:any)'] = 'admin/Admin/kasirpelanggan/$1';
//manage produk admin
$route['admin/produk/(:any)'] = 'admin/Admin/produk/$1';
//get kategori
$route['admin/kategori/(:any)'] = 'admin/Admin/kategori/$1';
//data toko
$route['admin/toko/(:any)'] = 'admin/Admin/toko/$1';
//transaski
$route['admin/transaksi/(:any)'] = 'admin/Admin/transaksi/$1';
//laporan penjualan
$route['admin/laporan/(:any)'] = 'admin/Admin/penjualan/$1';
//laporan transaksi
$route['admin/riwayatTransaksi/(:any)'] = 'admin/Admin/riwayatTransaksi/$1';
//edit transaksi
$route['admin/editTransaksi/(:any)'] = 'admin/Admin/editTransaksi/$1';
//Cetak Struk
$route['admin/struk/(:any)'] = 'admin/Admin/struk/$1';


//akun kasir
$route['kasir/akun/(:any)'] = 'kasir/Kasir/akun/$1';
//kasir dashboard
$route['kasir/dashboard/(:any)'] = 'kasir/Kasir/index/$1';
//customer admin
$route['kasir/customer/(:any)'] = 'kasir/Kasir/customer/$1';
//manage produk kasir
$route['kasir/produk/(:any)'] = 'kasir/Kasir/produk/$1';
//get kategori
$route['kasir/kategori/(:any)'] = 'kasir/Kasir/kategori/$1';
//data toko
$route['kasir/toko/(:any)'] = 'kasir/Kasir/toko/$1';
//laporan penjualan
$route['kasir/laporan/(:any)'] = 'kasir/Kasir/penjualan/$1';
//transaski
$route['kasir/transaksi/(:any)'] = 'kasir/Kasir/transaksi/$1';
//laporan transaksi
$route['kasir/riwayatTransaksi/(:any)'] = 'kasir/Kasir/riwayatTransaksi/$1';
//Cetak Struk
$route['kasir/struk/(:any)'] = 'kasir/Kasir/struk/$1';

//get produk
$route['api/dataproduk'] = 'api/ApiGetProduk/index';
//by id get
$route['api/dataproduk/editproduk/(:any)'] = 'api/ApiGetProduk/getupdateproduk/$1';
//add produk
$route['api/dataproduk/tambahproduk'] = 'api/ApiGetProduk/postproduk';
//update produk
$route['api/dataproduk/updateproduk/(:any)'] = 'api/ApiGetProduk/updateproduk/$1';
//delete produk
$route['api/dataproduk/deleteproduk/(:any)'] = 'api/ApiGetProduk/deleteproduk/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
