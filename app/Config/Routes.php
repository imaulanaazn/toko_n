<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

$routes->get('/login-as/(:num)', 'Auth::loginAs/$1');

$routes->group('owner', ['filter' => 'auth:owner'], function ($routes) {
    $routes->get('dashboard', 'Dashboard::owner_dashboard');
    $routes->get('pembelian', 'Pembelian::index');
    $routes->post('pembelian/simpan', 'Pembelian::simpan');
    $routes->get('pembelian/hapus/(:num)', 'Pembelian::hapus_pengeluaran/$1');

    $routes->get('produk', 'Produk::index');
    $routes->get('produk/tambah', 'Produk::form_tambah');
    $routes->post('produk/simpan', 'Produk::simpan');
    $routes->get('produk/edit/(:num)', 'Produk::form_edit/$1');
    $routes->post('produk/update/(:num)', 'Produk::update/$1');
    $routes->get('produk/hapus/(:num)', 'Produk::hapus/$1');
    $routes->get('produk/detail/(:num)', 'Produk::detail/$1');

    //Bahan Produk
    $routes->post('produk/tambah_bahan/(:num)', 'Produk::tambah_bahan/$1');
    $routes->get('produk/hapus_bahan/(:num)', 'Produk::hapus_bahan/$1');
    $routes->get('produk/hapus_bahan/(:num)', 'Produk::hapus_bahan/$1');

    //Penjualan
    $routes->get('penjualan', 'Penjualan::index');
    $routes->post('penjualan/tambah_produk', 'Penjualan::tambah_produk');
    $routes->get('penjualan/hapus_produk/(:num)', 'Penjualan::hapus_produk/$1');
    $routes->get('penjualan/simpan/(:num)', 'Penjualan::simpan_penjualan/$1');
    $routes->get('penjualan/batal/(:num)', 'Penjualan::batalkan_penjualan/$1');
    $routes->get('penjualan/hapus/(:num)', 'Penjualan::hapus_penjualan/$1');

    //Laba
    $routes->get('laporan', 'Laporan::index');
    $routes->get('laporan/cetak', 'Laporan::cetak_pdf');
});

$routes->group('karyawan', ['filter' => 'auth:karyawan'], function ($routes) {
    $routes->get('dashboard', 'Dashboard::karyawan_dashboard');
    $routes->get('pembelian', 'Pembelian::index');
    $routes->post('pembelian/simpan', 'Pembelian::simpan');
    $routes->get('pembelian/hapus/(:num)', 'Pembelian::hapus_pengeluaran/$1');

    $routes->get('penjualan', 'Penjualan::index');
    $routes->post('penjualan/tambah_produk', 'Penjualan::tambah_produk');
    $routes->get('penjualan/hapus_produk/(:num)', 'Penjualan::hapus_produk/$1');
    $routes->get('penjualan/simpan/(:num)', 'Penjualan::simpan_penjualan/$1');
    $routes->get('penjualan/batal/(:num)', 'Penjualan::batalkan_penjualan/$1');
    $routes->get('penjualan/hapus/(:num)', 'Penjualan::hapus_penjualan/$1');
});
