<?php use App\Cart; ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th colspan="2">Description</th>
            @if (!empty($page)  && $page == 'checkout')
                <th>Quantity</th>
                @else
                <th>Quantity/Update</th>
            @endif
            <th>Price</th>
            <th>Discount</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $total_price = 0;
            $total_discount = 0;

        ?>
        @foreach ($cartItems as $cartItem)
            <?php $price = Cart::getAttributePrice($cartItem['product_id'], $cartItem['size']);
            $stock = Cart::getAttributeStock($cartItem['product_id'], $cartItem['size']);
            $discounted_price = Cart::getProductDiscoutedPriceByAttribute($cartItem['product_id'], $cartItem['size']);
            ?>
            <tr>
                <td> <img width="60"
                        src="{{ asset('images/product-image/small/' . $cartItem['product']['main_image']) }}"
                        alt="" /></td>
                <td colspan="2">{{ $cartItem['product']['product_name'] }}
                    <br />Color : {{ $cartItem['product']['product_color'] }}
                    <br />Size : {{ $cartItem['size'] }}
                </td>
                <td>
                   @if (isset($page) && $page == 'checkout')
                        {{ $cartItem['quantity'] }}
                    @else
                    <div class="input-append">
                        <input id="cart-{{ $cartItem['id'] }}" class="span1" style="max-width:34px"
                            value="{{ $cartItem['quantity'] }}" id="appendedInputButtons" size="16" type="text">
                        <button class="btn qtyUpdateBtn qtyMinus" type="button" data-cartid="{{ $cartItem['id'] }}"><i
                                class="icon-minus"></i></button>
                        <button class="btn qtyUpdateBtn qtyPlus" type="button" data-cartid="{{ $cartItem['id'] }}"
                            data-stock="{{ $stock }}">
                            <i class="icon-plus"></i>
                        </button>
                        <button class="btn btn-danger" type="button" id="deleteItem" cart_id="{{ $cartItem['id'] }}"><i
                                class="icon-remove icon-white"></i></button>
                    </div>
                   @endif
                </td>
                <td>TK. {{ $price }}</td>
                <td>
                    @if ($discounted_price > 0)
                        TK. {{ $discounted_price * $cartItem['quantity'] }}
                    @else
                        TK. {{ $discounted_price }}
                    @endif
                </td>
                <td>TK. {{ $price * $cartItem['quantity'] }}</td>
            </tr>
            <?php $total_price = $total_price + $price * $cartItem['quantity'];
                $total_discount = $total_discount + $discounted_price * $cartItem['quantity'];
            ?>
        @endforeach

        <tr>
            <td colspan="6" style="text-align:right">Total Price: </td>
            <td> TK. {{ $total_price }}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align:right">Total Discount: </td>
            <td> TK. {{ $total_discount }}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align:right">Coupon Discount: </td>
            @if(Session::has('couponAmount'))
                <?php $grandTotal= $total_price - $total_discount; ?>
                @if (Session::get('amount_type') == 'percentage')
                    <td>{{ Session::get('couponAmount') }} % TK. {{ ($grandTotal * Session::get('couponAmount')) / 100; }}</td>
                @else
                    <td>TK. {{ Session::get('couponAmount') }}</td>
                @endif
            @else
                <td> TK. 0</td>
            @endif
        </tr>

        <tr>
            @if (Session::has('couponAmount'))
                <?php
                    $grandTotal= $total_price - $total_discount;
                    if (Session::get('amount_type') == 'percentage') {
                        $couponAmount= ($grandTotal * Session::get('couponAmount')) / 100;
                    }else {
                        $couponAmount= Session::get('couponAmount');
                    }
                ?>
                <td colspan="6" style="text-align:right"><strong> GRAND TOTAL (TK.{{ $total_price }} - TK.
                        {{ $total_discount }} - TK. {{ $couponAmount }}) =</strong></td>
                <td class="label label-important" style="display:block"> <strong> TK.
                        {{ $grandTotal - $couponAmount }}
                    </strong></td>
                    <input type="hidden" name="grand_total" value="{{ $grandTotal - $couponAmount }}">
            @else
                <td colspan="6" style="text-align:right"><strong> GRAND TOTAL (TK.{{ $total_price }} - TK.
                        {{ $total_discount }}) =</strong></td>
                <td class="label label-important" style="display:block"> <strong> TK.
                        {{ $total_price - $total_discount }}
                    </strong></td>
                    <input type="hidden" name="grand_total" value="{{ $total_price - $total_discount }}">
            @endif
        </tr>
    </tbody>
</table>
