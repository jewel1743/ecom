<?php

namespace App\Http\Middleware;

use App\Cart;
use Closure;
use Illuminate\Http\Request;

class CheckoutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $cartItems= Cart::getCartItems();

        if (empty($cartItems)) {
            return redirect()->back();
        }else {
            return $next($request);
        }

    }
}
