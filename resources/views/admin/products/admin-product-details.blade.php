@extends('master.admin-master.master')
@section('title')
    Product Details
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto py-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Product Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Product Name</th>
                            <td>{{ $product->product_name }}</td>
                        </tr>
                        <tr>
                            <th>Product Color</th>
                            <td>{{ $product->product_color }}</td>
                        </tr>
                        <tr>
                            <th>Product Code</th>
                            <td>{{ $product->product_code }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>{{ $product->product_price }}</td>
                        </tr>
                        <tr>
                            <th>Discount</th>
                            <td>{{ $product->product_discount }}</td>
                        </tr>
                        <tr>
                            <th>Product Video</th>
                            <td>
                                @if (!empty($product->product_video))
                                    <video src="{{ asset($product->product_video) }}" controls width="320" height="320"></video>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Main Image</th>
                            <td>
                                @if (!empty($product->main_image))
                                    <img src="{{ asset('images/product-image/small/'.$product->main_image) }}" alt="Product-image">
                                    @else
                                    <img src="{{ asset('images/product-image/dummy-image.png') }}" alt="Product-image">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td>{{ $product->short_description }}</td>
                        </tr>
                        <tr>
                            <th>Long Description</th>
                            <td>{{ $product->long_description }}</td>
                        </tr>
                        <tr>
                            <th>Wash Care</th>
                            <td>{{ $product->wash_care }}</td>
                        </tr>
                        <tr>
                            <th>Fabric</th>
                            <td>{{ $product->fabric }}</td>
                        </tr>
                        <tr>
                            <th>Pattern</th>
                            <td>{{ $product->pattern }}</td>
                        </tr>
                        <tr>
                            <th>Fit</th>
                            <td>{{ $product->fit }}</td>
                        </tr>
                        <tr>
                            <th>Sleeve</th>
                            <td>{{ $product->sleeve }}</td>
                        </tr>
                        <tr>
                            <th>Occasion</th>
                            <td>{{ $product->occasion }}</td>
                        </tr>
                        <tr>
                            <th>Meta title</th>
                            <td>{{ $product->meta_title }}</td>
                        </tr>
                        <tr>
                            <th>Meta Description</th>
                            <td>{{ $product->meta_description }}</td>
                        </tr>
                        <tr>
                            <th>Meta Keywords</th>
                            <td>{{ $product->meta_keywords }}</td>
                        </tr>
                        <tr>
                            <th>Featured Product</th>
                            <td>{{ $product->is_featured }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $product->status == 1 ? 'Active' : 'Inactive' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
