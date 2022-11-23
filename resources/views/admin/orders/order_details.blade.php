@extends('master.admin-master.master')

@section('title')
    Products
@endsection

@section('admin-css')
    <link rel="stylesheet" href="{{ asset('/') }}admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('body')
    <section class="content">
        <div class="container-fluid">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Order #{{ $ordersDetails->id }} Details</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item "><a href="{{ route('admin-orders') }}">Orders</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Order Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Order Date</td>
                                            <td>{{ $ordersDetails->created_at->format('d-M-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Order Status</td>
                                            <td>{{ $ordersDetails->order_status }}</td>
                                        </tr>
                                        <tr>
                                            <td>Order Total</td>
                                            <td>TK. {{ $ordersDetails->grand_total }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Charge</td>
                                            <td>{{ $ordersDetails->shipping_charge }}</td>
                                        </tr>
                                        <tr>
                                            <td>Coupon Code</td>
                                            <td>{{ $ordersDetails->coupon_code }}</td>
                                        </tr>
                                        <tr>
                                            <td>Coupon Amount</td>
                                            <td>
                                                @if (!empty($coupon))
                                                    @if ($coupon->amount_type == 'percentage')
                                                        {{ $ordersDetails->coupon_amount }} %
                                                    @else
                                                        TK. {{ $ordersDetails->coupon_amount }}
                                                    @endif
                                                @else
                                                    {{ $ordersDetails->coupon_amount }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Payment Method</td>
                                            <td>{{ $ordersDetails->payment_method }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Delivery Address</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Name</td>
                                            <td>{{ $ordersDetails->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>{{ $ordersDetails->address }}</td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td>{{ $ordersDetails->city }}</td>
                                        </tr>
                                        <tr>
                                            <td>District</td>
                                            <td>{{ $ordersDetails->district }}</td>
                                        </tr>
                                        <tr>
                                            <td>Division</td>
                                            <td>{{ $ordersDetails->division }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pincode</td>
                                            <td>
                                                {{ $ordersDetails->pincode }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td>{{ $ordersDetails->mobile }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Customer Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $userDetails->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $userDetails->email }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Billing Address</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Address</th>
                                            <td>{{ $userDetails->address }}</td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <td>{{ $upazila->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>District</th>
                                            <td>{{ $district->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Division</th>
                                            <td>{{ $division->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile</th>
                                            <td>{{ $userDetails->mobile }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            @if (Session::has('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <h4>{{ Session::get('message') }}</h4>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Update Order Status</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form
                                        action="{{ route('admin-update-order-status', ['order_id' => $ordersDetails->id]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <select name="order_status" style="width: 120px;" id="order_status">
                                                    <option value="">Select Order Status</option>
                                                    @foreach ($orderStatuses as $orderStatus)
                                                        <option value="{{ $orderStatus->name }}"
                                                            {{ strtolower($ordersDetails->order_status) == strtolower($orderStatus->name) ? 'selected' : '' }}>
                                                            {{ $orderStatus->name }}</option>
                                                    @endforeach
                                                </select>
                                                <input style="width: 120px;" type="text" name="courier_name"
                                                    @if(empty($ordersDetails->courier_name)) id="courier_name" @endif placeholder="courier name" value="{{ $ordersDetails->courier_name }}">
                                                <input style="width: 120px;" type="text" name="tracking_number"
                                                @if(empty($ordersDetails->courier_name)) id="tracking_number" @endif placeholder="tracking number" value="{{ $ordersDetails->tracking_number }}">
                                                <input type="submit" value="Submit">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Order log history</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    @foreach ($orderLogs as $orderLog)
                                        <div>
                                            <strong style="margin: 0px;">Order status:
                                                {{ $orderLog->order_status }}</strong><br>
                                            <small>Date: {{ date('d-M-Y h:i a', strtotime($orderLog->created_at)) }}</small>
                                        </div>
                                        <hr>
                                    @endforeach

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ordered Products</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Size</th>
                                                <th>Color</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ordersDetails->orders_products as $orderProduct)
                                                <tr>
                                                    <td><img src="{{ asset('images/product-image/small/' . $orderProduct->product->main_image) }}"
                                                            alt="" width="60" height="60"></td>
                                                    <td>{{ $orderProduct->product_code }}</td>
                                                    <td>{{ $orderProduct->product_name }}</td>
                                                    <td>{{ $orderProduct->product_size }}</td>
                                                    <td>{{ $orderProduct->product_color }}</td>
                                                    <td>{{ $orderProduct->product_price }}</td>
                                                    <td>{{ $orderProduct->product_quantity }}</td>
                                                    <td><a
                                                            href="{{ route('admin-product-details', ['id' => $orderProduct->product_id]) }}">View</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

@section('admin-js')
    <script>
        $(document).ready(function() {
            $('#courier_name').hide();
            $('#tracking_number').hide();

            $(document).on('change','#order_status', function(){
                var status= $(this).val();
                if(status == 'Shipped'){
                    $('#courier_name').show();
                    $('#tracking_number').show();
                }else{
                    $('#courier_name').hide();
                    $('#tracking_number').hide();
                }
            });
        });
    </script>
@endsection
