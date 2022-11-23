<html>
    <body style="margin: 30px;">
        <table style="width: 700px;" border="1">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>Website Logo</td>
                        </tr>
                        <tr>
                            <td>Order From, {{ $order_customer_name }}</td>
                        </tr>
                        <tr>
                            <td>Dear {{ $delivery_customer_name }} your order #{{ $order_id }}  has been <strong> {{ $order_status }}</strong> . your order info below :-</td>
                        </tr>
                        @if (!empty($courier_name) && !empty($tracking_number))
                        <tr>
                            <td>Your Courier name is <strong>{{ $courier_name }}</strong> and tracking number is <strong>{{ $tracking_number }}</strong></td>
                        </tr>
                        @endif
                    </table>
                </td>
            </tr>
            <tr>
                <td>Order No #{{ $order_id }};</td>
            </tr>
            <tr>
                <td>
                    <table style="width: 100%" bgcolor="#f7f4f4" cellpadding="5" cellspacing="5">
                        <tr bgcolor="#ccccc">
                            <td>Product Name</td>
                            <td>Product Code</td>
                            <td>Product Size</td>
                            <td>Product Color</td>
                            <td>Product Price</td>
                            <td>Product Quantity</td>
                        </tr>
                        <?php $total = 0; ?>
                        @foreach ($orderDetails['orders_products'] as $orderProduct)
                        <tr>
                            <td>{{ $orderProduct['product_name'] }}</td>
                            <td>{{ $orderProduct['product_code'] }}</td>
                            <td>{{ $orderProduct['product_size'] }}</td>
                            <td>{{ $orderProduct['product_color'] }}</td>
                            <td>{{ $orderProduct['product_price'] }}</td>
                            <td>{{ $orderProduct['product_quantity'] }}</td>
                        </tr>
                        <?php $total = $total + $orderProduct['product_price'] * $orderProduct['product_quantity']; ?>
                        @endforeach
                        <tr>
                            <td colspan="5" align="right">Shipping Charge</td>
                            <td>TK.{{ $orderDetails['shipping_charge'] }}</td>
                        </tr>
                        <tr>
                            <td colspan="5" align="right">Product Total Price</td>
                            <td>TK.{{ $total }} <td>
                        </tr>
                        @if (!empty($orderDetails['coupon_amount']))
                        <tr>
                            <td colspan="5" align="right">Coupon Discount</td>
                            @if ($amount_type == 'percentage')
                                <td>TK.{{ $orderDetails['coupon_amount'] }} %</td>
                            @else
                                <td>TK.{{ $orderDetails['coupon_amount'] }}</td>
                            @endif
                        </tr>
                        @endif
                        <tr>
                            <td colspan="5" align="right">Grand Total</td>
                            <td>TK.{{ $orderDetails['grand_total'] - $orderDetails['shipping_charge'] }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr><td>For any queryes you can contract with <a href="mailto:jtjewel1743@gmail.com">info@ecom.bd</a></td></tr>
                        <tr><td>Best Regards, <br> <strong>Team Ecom Advance</strong></td></tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>

