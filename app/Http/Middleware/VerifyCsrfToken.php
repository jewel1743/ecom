<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/admin/check-current-password", "/admin/update-section-status","/admin/update-category-status",
        "/admin/append-category-level", "/admin/update-product-status", "/admin/update-attribute-status",
        "/admin/product-code-exist", "/admin/update-image-status", "/admin/update-brand-status", "/admin/update-feature-product-status",
        "/admin/update-banner-status", "/admin/update-fabric-status", "/admin/update-pattern-status", "/admin/update-sleeve-status",
        "/admin/update-fit-status", "/admin/update-occasion-status","/admin/update-coupon-status",
    ];
}
