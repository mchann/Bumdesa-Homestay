<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     * Add Midtrans notification endpoint so Midtrans can POST without CSRF token.
     *
     * @var array
     */
    protected $except = [
        'midtrans/notification',
    ];
}
