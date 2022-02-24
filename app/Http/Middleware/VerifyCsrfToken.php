<?php
namespace Tazper\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/usuarios_remove',
        '/productos_remove',
        '/productos_mod_mas',
        '/personal_remove',
        '/proveedores_remove',        
        '/categorias_remove',        
        '/materiales_remove',        
    ];
}