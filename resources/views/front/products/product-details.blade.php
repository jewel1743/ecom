<?php use App\Product; ?>
@extends('master.front-master.master')
@section('title')
    Product | Details
@endsection

@section('body')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ route('front-home') }}">Home</a> <span class="divider">/</span></li>
            <li><a href="{{ url('/' . $product['category']['url']) }}">{{ $product['category']['category_name'] }}</a> <span
                    class="divider">/</span></li>
            <li class="active">{{ $product['product_name'] }}</li>
        </ul>
        <div class="row">
            <div id="gallery" class="span3">
                <a href="{{ asset('images/product-image/small/' . $product['main_image']) }}" title="Blue Casual T-Shirt">
                    <img src="{{ asset('images/product-image/small/' . $product['main_image']) }}" style="width:100%"
                        alt="Blue Casual T-Shirt" />
                </a>
                <div id="differentview" class="moreOptopm carousel slide">
                    @if (!empty($product['sub_images']))
                        <div class="carousel-inner">
                            <div class="item active">
                                @foreach ($product['sub_images'] as $key => $subImage)
                                    <a href="{{ asset('images/product-image/sub-images/' . $subImage['images']) }}"> <img
                                            style="width:29%; height:100px;"
                                            src="{{ asset('images/product-image/sub-images/' . $subImage['images']) }}"
                                            alt="" /></a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <!--
                                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a> -->

                </div>

                <div class="btn-toolbar">
                    <div class="btn-group">
                        <span class="btn"><i class="icon-envelope"></i></span>
                        <span class="btn"><i class="icon-print"></i></span>
                        <span class="btn"><i class="icon-zoom-in"></i></span>
                        <span class="btn"><i class="icon-star"></i></span>
                        <span class="btn"><i class=" icon-thumbs-up"></i></span>
                        <span class="btn"><i class="icon-thumbs-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="span6">
                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
                @endif
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <h4>{{ Session::get('message') }}</h4>
                    </div>
                @endif
                @if (Session::has('error_message'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4>{{ Session::get('error_message') }}</h4>
                    </div>
                @endif
                <h3>{{ $product['product_name'] }} </h3>
                <small>{{ $product['brand']['brand_name'] }}</small>
                <hr class="soft" />
                <small id="stock">{{ $total_stock }} items in stock</small>
                <form action="{{ route('front-add-to-cart') }}" class="form-horizontal qtyFrm" method="POST">
                    @csrf
                        <?php $discounted_price = Product::getProductDiscountedPrice($product['id']); ?>
                    <div class="control-group">
                        @if ($discounted_price > 0)
                            <del style="display: inline-block;"><h4 id="price">BDT. {{ $product['product_price'] }}</h4></del>
                             <h4 style="display:inline-block;" id="discounted_price">BDT. {{ $discounted_price }}</h4>
                             <br/>
                            @else
                            <h4 id="price">BDT. {{ $product['product_price'] }}</h4>
                        @endif
                        @if ($discounted_price > 0)

                        @endif
                        <select name="size" class="span2 pull-left" product_id="{{ $product['id'] }}" id="size" required>
                            <option value="">Select Size</option>
                            @foreach ($product['attributes'] as $attribute)
                                <option value="{{ $attribute['size'] }}">
                                    {{ $attribute['size'] }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                        <input name="quantity" type="number" class="span1" placeholder="Qty." min="1" value="1" required/>
                        <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i
                                class=" icon-shopping-cart"></i></button>
                    </div>
                </form>
            </div>


            <hr class="soft clr" />
            <div style="margin-left:1%;">
                <p>
                    {!! $product['short_description'] !!}
                </p>
            </div>
            <hr class="soft clr" />
            <div style="margin-left: 1%;">
                <p>
                    {!! $product['long_description'] !!}
                </p>
            </div>

        </div>

        <div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
                <li><a href="#profile" data-toggle="tab">Related Products</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <h4>Product Information</h4>
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="techSpecRow">
                                <th colspan="2">Product Details</th>
                            </tr>
                            <tr class="techSpecRow">
                                <td class="techSpecTD1">Brand: </td>
                                <td class="techSpecTD2">{{ $product['brand']['brand_name'] }}</td>
                            </tr>
                            <tr class="techSpecRow">
                                <td class="techSpecTD1">Code:</td>
                                <td class="techSpecTD2">{{ $product['product_code'] }}</td>
                            </tr>
                            <tr class="techSpecRow">
                                <td class="techSpecTD1">Color:</td>
                                <td class="techSpecTD2">{{ $product['product_color'] }}</td>
                            </tr>

                            @if (!empty($product['fabric']))
                                <tr class="techSpecRow">
                                    <td class="techSpecTD1">Fabric:</td>
                                    <td class="techSpecTD2">{{ $product['fabric'] }}</td>
                                </tr>
                            @endif

                            @if (!empty($product['pattern']))
                                <tr class="techSpecRow">
                                    <td class="techSpecTD1">Pattern:</td>
                                    <td class="techSpecTD2">{{ $product['pattern'] }}</td>
                                </tr>
                            @endif

                            @if (!empty($product['sleeve']))
                                <tr class="techSpecRow">
                                    <td class="techSpecTD1">Sleeve:</td>
                                    <td class="techSpecTD2">{{ $product['sleeve'] }}</td>
                                </tr>
                            @endif

                            @if (!empty($product['fit']))
                                <tr class="techSpecRow">
                                    <td class="techSpecTD1">Fit:</td>
                                    <td class="techSpecTD2">{{ $product['fit'] }}</td>
                                </tr>
                            @endif

                            @if (!empty($product['occasion']))
                                <tr class="techSpecRow">
                                    <td class="techSpecTD1">Occasion:</td>
                                    <td class="techSpecTD2">{{ $product['occasion'] }}</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>

                    @if (!empty($product['wash_care']))
                        <h5>Washcare</h5>
                        <p>{{ $product['wash_care'] }}</p>
                    @endif
                </div>
                <div class="tab-pane fade" id="profile">
                    <div id="myTab" class="pull-right">
                        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i
                                    class="icon-list"></i></span></a>
                        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i
                                    class="icon-th-large"></i></span></a>
                    </div>
                    <br class="clr" />
                    <hr class="soft" />
                    <div class="tab-content">
                        <div class="tab-pane" id="listView">
                            @foreach ($relatedProducts as $product)
                            <?php $discounted_price = Product::getProductDiscountedPrice($product->id); ?>
                                <div class="row">
                                    <div class="span2">
                                        <img src="{{ asset('images/product-image/small/' . $product->main_image) }}"
                                            alt="" />
                                    </div>
                                    <div class="span4">
                                        <h3>Brand({{ $product->brand->brand_name }})</h3>
                                        <hr class="soft" />
                                        <h5>{{ $product->product_name }} </h5>
                                        <p>
                                            {!! $product->short_description !!}
                                        </p>
                                        <a class="btn btn-small pull-right"
                                            href="{{ route('front-product-details', ['id' => $product->id]) }}">View
                                            Details</a>
                                        <br class="clr" />
                                    </div>
                                    <div class="span3 alignR">
                                        <form class="form-horizontal qtyFrm">
                                            <h3>
                                                @if ($discounted_price > 0)
                                                    <del>Rs.{{ $product->product_price }}</del>
                                                @else
                                                    BDT.{{ $product->product_price }}
                                                @endif
                                            </h3>
                                            @if ($discounted_price > 0)
                                                <h3>BDT.{{ $discounted_price }}</h3>
                                            @endif
                                            <label class="checkbox">
                                                <input type="checkbox"> Adds product to compair
                                            </label><br />
                                            <div class="btn-group">
                                                <a href="product_details.html" class="btn btn-large btn-primary"> Add to
                                                    <i class=" icon-shopping-cart"></i></a>
                                                <a href="{{ route('front-product-details', ['id' => $product->id]) }}"
                                                    class="btn btn-large"><i class="icon-zoom-in"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr class="soft" />
                            @endforeach
                        </div>
                        <div class="tab-pane active" id="blockView">
                            <ul class="thumbnails">
                                @foreach ($relatedProducts as $product)
                                <?php $discounted_price = Product::getProductDiscountedPrice($product->id); ?>
                                    <li class="span3">
                                        <div class="thumbnail">
                                            <a href="{{ route('front-product-details', ['id' => $product->id]) }}"><img
                                                    src="{{ asset('images/product-image/small/' . $product->main_image) }}"
                                                    alt="{{ $product->product_name }}" /></a>
                                            <div class="caption">
                                                <h5>{{ $product->product_name }}</h5>
                                                <p>
                                                    Brand({{ $product->brand->brand_name }})
                                                    @if ($discounted_price > 0)
                                                        <span style="color:red;">SALE BDT.{{ $product->product_price }}</span>
                                                    @endif
                                                </p>
                                                <h4 style="text-align:center"><a class="btn"
                                                        href="{{ route('front-product-details', ['id' => $product->id]) }}">
                                                        <i class="icon-zoom-in"></i></a> <a class="btn"
                                                        href="#">Add
                                                        to <i class="icon-shopping-cart"></i></a>
                                                    <a class="btn btn-primary"href="#">
                                                        @if ($discounted_price > 0)
                                                            <del>Rs.{{ $product->product_price }}</del>
                                                            @else
                                                            Rs.{{ $product->product_price }}
                                                        @endif
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <hr class="soft" />
                        </div>
                    </div>
                    <br class="clr">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('front-js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("change", "#size", function() {
                var size = $(this).val();
                var product_id = $(this).attr("product_id");
                $.ajax({
                    type: "post",
                    url: "{{ route('front-get-product-attribute-by-size') }}",
                    data: {
                        size: size,
                        product_id: product_id
                    },
                    success: function(data) {
                        if (data) {
                            $("#stock").html(data.stock + " Available Stock");
                            $("#price").html('BDT. ' + data.price);
                            if(data.discounted_price > 0){
                                $("#discounted_price").html('BDT. ' + data.discounted_price);
                            }
                        }
                    }
                })
            })
        })
    </script>
@endsection
