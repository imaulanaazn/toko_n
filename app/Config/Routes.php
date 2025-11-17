<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

$routes->get('/owner/dashboard', 'Dashboard::owner_dashboard');
$routes->get('/owner/pembelian', 'Pembelian::admin_index');
$routes->post('/owner/pembelian/simpan', 'Pembelian::simpan');
$routes->get('/owner/pembelian/hapus/(:num)', 'Pembelian::hapus_pengeluaran/$1');

$routes->get('/owner/produk', 'Produk::index');
$routes->get('/owner/produk/tambah', 'Produk::form_tambah');
$routes->post('/owner/produk/simpan', 'Produk::simpan');
$routes->get('/owner/produk/edit/(:num)', 'Produk::form_edit/$1');
$routes->post('/owner/produk/update/(:num)', 'Produk::update/$1');
$routes->get('/owner/produk/hapus/(:num)', 'Produk::hapus/$1');

//Bahan Produk
$routes->post('/owner/produk/tambah_bahan/(:num)', 'Produk::tambah_bahan/$1');
$routes->get('/owner/produk/hapus_bahan/(:num)', 'Produk::hapus_bahan/$1');
$routes->get('/owner/produk/hapus_bahan/(:num)', 'Produk::hapus_bahan/$1');


//Penjualan
$routes->get('/owner/penjualan', 'Penjualan::admin_index');
$routes->post('/owner/penjualan/tambah_produk', 'Penjualan::tambah_produk');
$routes->get('/owner/penjualan/hapus_produk/(:num)', 'Penjualan::hapus_produk/$1');
$routes->get('/owner/penjualan/simpan/(:num)', 'Penjualan::simpan_penjualan/$1');
$routes->get('/owner/penjualan/batal/(:num)', 'Penjualan::batalkan_penjualan/$1');
$routes->get('/owner/penjualan/hapus/(:num)', 'Penjualan::hapus_penjualan/$1');


//Laba
$routes->get('/owner/laporan', 'Laporan::index');

$routes->get('/karyawan/dashboard', 'Dashboard::karyawan_dashboard');
$routes->get('/karyawan/pembelian', 'Pembelian::karyawan_index');
$routes->post('/karyawan/pembelian/simpan', 'Pembelian::simpan');
$routes->get('/owner/pembelian/hapus/(:num)', 'Pembelian::hapus_pengeluaran/$1');
