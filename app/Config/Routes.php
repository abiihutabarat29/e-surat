<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/home', 'Home::index');
//Routes Login
$routes->get('/', 'Auth::index');
$routes->add('/auth/verify', 'Auth::cek');
$routes->get('/auth/logout', 'Auth::logout');
//Routes User Desa
$routes->get('data-user', 'User::user');
$routes->get('data-user/add', 'User::add');
$routes->post('data-user/save', 'User::save');
$routes->delete('data-user/(:num)', 'User::delete/$1');
$routes->get('data-user/edit/(:segment)', 'User::edit/$1');
$routes->add('data-user/update/(:segment)', 'User::update/$1');
//Routes User Admin Desa
$routes->get('user-admin-desa', 'UserKab::useradmdes');
$routes->get('user-admin-desa/add', 'UserKab::addadm');
$routes->post('user-admin-desa/save', 'UserKab::saveadm');
$routes->delete('user-admin-desa/(:num)', 'UserKab::deleteadm/$1');
$routes->get('user-admin-desa/edit/(:segment)', 'UserKab::editadm/$1');
$routes->add('user-admin-desa/update/(:segment)', 'UserKab::updateadm/$1');
//Routes User Kab
$routes->get('user', 'UserKab::userkab');
$routes->get('user/add', 'UserKab::add');
$routes->post('user/save', 'UserKab::save');
$routes->delete('user/(:num)', 'UserKab::delete/$1');
$routes->get('user/edit/(:segment)', 'UserKab::edit/$1');
$routes->add('user/update/(:segment)', 'UserKab::update/$1');
//Routes Desa
$routes->get('desa', 'Desa::data');
$routes->get('desa/add', 'Desa::add');
$routes->post('desa/save', 'Desa::save');
$routes->delete('desa/(:num)', 'Desa::delete/$1');
$routes->get('desa/edit/(:segment)', 'Desa::edit/$1');
$routes->add('desa/update/(:segment)', 'Desa::update/$1');
//Routes Penandatangan
$routes->get('penandatangan', 'Penandatangan::data');
$routes->get('penandatangan-kabupaten', 'Penandatangan::datakab');
$routes->get('penandatangan/add', 'Penandatangan::add');
$routes->post('penandatangan/save', 'Penandatangan::save');
$routes->delete('penandatangan/(:num)', 'Penandatangan::delete/$1');
$routes->get('penandatangan/edit/(:segment)', 'Penandatangan::edit/$1');
$routes->add('penandatangan/update/(:segment)', 'Penandatangan::update/$1');
//Routes Surat Masuk
$routes->get('tambah-surat-masuk', 'SuratMasuk::add');
$routes->post('tambah-surat-masuk/save', 'SuratMasuk::save');
$routes->get('surat-masuk', 'SuratMasuk::data');
$routes->get('surat-masuk-desa', 'SuratMasuk::datadesa');
$routes->get('surat-masuk-kabupaten', 'SuratMasuk::datakab');
$routes->delete('surat-masuk/(:num)', 'SuratMasuk::delete/$1');
$routes->get('surat-masuk/edit/(:segment)', 'SuratMasuk::edit/$1');
$routes->add('surat-masuk/update/(:segment)', 'SuratMasuk::update/$1');
$routes->add('surat-masuk/detail/(:segment)', 'SuratMasuk::detail/$1');
//Routes Surat Keluar
$routes->get('tambah-surat-keluar', 'SuratKeluar::add');
$routes->post('tambah-surat-keluar/save', 'SuratKeluar::save');
$routes->get('surat-keluar', 'SuratKeluar::data');
$routes->get('surat-keluar-desa', 'SuratKeluar::datadesa');
$routes->get('surat-keluar-kabupaten', 'SuratKeluar::datakab');
$routes->add('surat-keluar-kabupaten/detail/(:segment)', 'SuratKeluar::details/$1');
$routes->get('surat-keluar-kabupaten/print/(:segment)', 'SuratKeluar::prints/$1');
$routes->get('data-surat-keluar', 'SuratKeluar::datasurat');
$routes->delete('surat-keluar/(:num)', 'SuratKeluar::delete/$1');
$routes->get('surat-keluar/edit/(:segment)', 'SuratKeluar::edit/$1');
$routes->add('surat-keluar/update/(:segment)', 'SuratKeluar::update/$1');
$routes->add('surat-keluar/detail/(:segment)', 'SuratKeluar::detail/$1');
$routes->get('surat-keluar/print/(:segment)', 'SuratKeluar::print/$1');
//Routes My Profil
$routes->get('my-profil', 'MyProfil::myprofil');
$routes->get('my-profil/edit/(:segment)', 'MyProfil::edit/$1');
$routes->add('my-profil/update/(:segment)', 'MyProfil::update/$1');
//Routes Setting Profil
$routes->get('setting-profil', 'SettingProfil::data');
$routes->get('setting-profil/add', 'SettingProfil::add');
$routes->post('setting-profil/save', 'SettingProfil::save');
$routes->get('setting-profil/edit/(:segment)', 'SettingProfil::edit/$1');
$routes->add('setting-profil/update/(:segment)', 'SettingProfil::update/$1');
//Routes Laporan Kegiatan
$routes->get('tambah-laporan-kegiatan', 'Laporan::add');
$routes->post('tambah-laporan-kegiatan/save', 'Laporan::save');
$routes->get('laporan-kegiatan', 'Laporan::data');
$routes->get('laporan-kegiatan-desa', 'Laporan::datadesa');
$routes->get('laporan-kegiatan-kabupaten', 'Laporan::datakab');
$routes->get('data-laporan-kegiatan', 'Laporan::datalaporan');
$routes->delete('laporan-kegiatan/(:num)', 'Laporan::delete/$1');
$routes->get('laporan-kegiatan/edit/(:segment)', 'Laporan::edit/$1');
$routes->add('laporan-kegiatan/update/(:segment)', 'Laporan::update/$1');
$routes->add('laporan-kegiatan/detail/(:segment)', 'Laporan::detail/$1');
$routes->get('laporan-kegiatan/print/(:segment)', 'Laporan::print/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
