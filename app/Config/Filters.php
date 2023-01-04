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
                'home', 'home/*',
                'data-user',
                'data-user/*',
            ]],
            'filtersek' => ['except' => [
                '/', 'auth/*',
                'home', 'home/*',
            ]],
            'filteruser' => ['except' => [
                '/', 'auth/*',
                'home', 'home/*',
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
                'my-profil',
                'my-profil/*',
            ]],
            'filtersek' => ['except' => [
                'home', 'home/*',
                'surat-masuk',
                'surat-masuk/*',
                'my-profil',
                'my-profil/*',
            ]],
            'filteruser' => ['except' => [
                'home', 'home/*',
                'surat-masuk',
                'surat-masuk/*',
                'my-profil',
                'my-profil/*',
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
