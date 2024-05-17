<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'filteradmkab' => \App\Filters\FilterAdmKab::class,
        'filteradmin' => \App\Filters\FilterAdmin::class,
        'filteruser' => \App\Filters\FilterUser::class,
        'filtersek' => \App\Filters\FilterSek::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'filteradmin' => ['except' => [
                '/', 'auth/*',
            ]],
            'filteradmkab' => ['except' => [
                '/', 'auth/*',
            ]],
            'filtersek' => ['except' => [
                '/', 'auth/*',
            ]],
            'filteruser' => ['except' => [
                '/', 'auth/*',
            ]],
        ],
        'after' => [
            'toolbar',
            'filteradmin' => ['except' => [
                'home', 'home/*',
                'data-user',
                'data-user/*',
                'surat-masuk',
                'surat-masuk/*',
                'surat-keluar',
                'surat-keluar/*',
                'data-surat-keluar',
                'my-profil',
                'my-profil/*',
                'penandatangan',
                'penandatangan/*',
                'setting-profil',
                'setting-profil/*',
                'laporan-kegiatan/*',
                'data-laporan-kegiatan',
            ]],
            'filteradmkab' => ['except' => [
                'home', 'home/*',
                // 'data-user',
                // 'data-user/*',
                'user',
                'user/*',
                'user-admin-desa',
                'user-admin-desa/*',
                'desa',
                'desa/*',
                'surat-masuk',
                'surat-masuk/*',
                'surat-masuk-desa',
                'surat-masuk-kabupaten',
                'surat-keluar',
                'surat-keluar/*',
                'surat-keluar-desa',
                'surat-keluar-desa/*',
                'surat-keluar-kabupaten',
                'surat-keluar-kabupaten/*',
                'my-profil',
                'my-profil/*',
                'penandatangan-kabupaten',
                'penandatangan/*',
                'setting-profil',
                'setting-profil/*',
                'laporan-kegiatan/*',
                'laporan-kegiatan-desa',
                'laporan-kegiatan-kabupaten',
                'laporan-kegiatan-kabupaten/*',
            ]],
            'filtersek' => ['except' => [
                'home', 'home/*',
                'surat-masuk',
                'surat-masuk/*',
                'tambah-surat-masuk',
                'tambah-surat-masuk/*',
                'surat-keluar/*',
                'data-surat-keluar',
                'tambah-surat-keluar',
                'tambah-surat-keluar/*',
                'my-profil',
                'my-profil/*',
                'laporan-kegiatan/*',
                'tambah-laporan-kegiatan',
                'tambah-laporan-kegiatan/*',
                'data-laporan-kegiatan',
            ]],
            'filteruser' => ['except' => [
                'home', 'home/*',
                'surat-masuk',
                'surat-masuk/*',
                'tambah-surat-masuk',
                'tambah-surat-masuk/*',
                'surat-keluar',
                'surat-keluar/*',
                'tambah-surat-keluar',
                'tambah-surat-keluar/*',
                'my-profil',
                'my-profil/*',
                'laporan-kegiatan',
                'laporan-kegiatan/*',
                'tambah-laporan-kegiatan',
                'tambah-laporan-kegiatan/*',
            ]],
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
