@extends('master.front-master.master')
@section('title')
    Category | Products
@endsection

@section('body')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{ route('front-home') }}">Home</a> <span class="divider">/</span></li>
        @if ($category->parent_id == 0)
            <li class="active">{{ $category->category_name }}</li>
            @else
            <li><a href="{{ route('front-category-products', ['url' => $category->parentCategory->url]) }}">{{ $category->parentCategory->category_name }}</a> <span class="divider">/</span></li>
            <li class="active">{{ $category->category_name }}</li>
        @endif
    </ul>
    <h3> {{ $category->category_name }} <small class="pull-right">{{ $productsCount}} products are available </small></h3>
    <hr class="soft"/>
    <p>
       {{ $category->description }}
    </p>
    <hr class="soft"/>
    <form class="form-horizontal span6" id="sortForm">
        <div class="control-group">
            <label class="control-label alignL">Sort By </label>
            <input type="hidden" id="url" value="{{ $category->url }}">
            <select name="sort" id="sort">
                <option disabled selected>Select</option>
                <option value="latest_products" {{ isset($_GET['sort']) &&  $_GET['sort'] == 'latest_products' ? 'selected' : ''}}>Latest Products</option>
                <option value="product_name_a_z" {{ isset($_GET['sort']) &&  $_GET['sort'] == 'product_name_a_z' ? 'selected' : ''}}>Product Name A - Z</option>
                <option value="product_name_z_a" {{ isset($_GET['sort']) &&  $_GET['sort'] == 'product_name_z_a' ? 'selected' : ''}}>Product Name Z - A</option>
                <option value="price_lowest_first" {{ isset($_GET['sort']) &&  $_GET['sort'] == 'price_lowest_first' ? 'selected' : ''}}>Price Lowest first</option>
                <option value="price_highest_first" {{ isset($_GET['sort']) &&  $_GET['sort'] == 'price_highest_first' ? 'selected' : ''}}>Price Highest first</option>
            </select>
        </div>
    </form>

    {{-- <div id="myTab" class="pull-right">
        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
    </div> --}}
    <br class="clr"/>
    <div class="tab-content products_filter">
        {{-- <div class="tab-pane" id="listView">
            @foreach ($categoryProducts as $product)
            <div class="row">
                <div class="span2">
                    <img src="{{ asset('images/product-image/small/'.$product->main_image) }}" alt="{{ $product->product_name }}"/>
                </div>
                <div class="span4">
                    <h3>{{ $product->product_name }}</h3>
                    <hr class="soft"/>
                    <h5> Brand ({{ $product->brand->brand_name }}) </h5>
                    <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                    <br class="clr"/>
                </div>
                <div class="span3 alignR">
                    <form class="form-horizontal qtyFrm">
                        <h3> BDT.{{ $product->product_price }}</h3>
                        <label class="checkbox">
                            <input type="checkbox">  Adds product to compair
                        </label><br/>

                        <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                        <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>

                    </form>
                </div>
            </div>
            <hr class="soft"/>
            @endforeach
        </div> --}}
        @include('front.products.ajax-category-products-filter')
    </div>
    <a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
    <div class="pagination">
        {{-- @php
            if(isset($_GET['sort'])){
                $sort = $_GET['sort'];
            }else {
                $sort= '';
            }
        @endphp --}}
        @if (isset($sort) && !empty($sort))
             {{ $categoryProducts->appends(['sort' => $sort])->links() }}
        @else
             {{ $categoryProducts->links() }}
        @endif

    </div>
    <br class="clr"/>
</div>
@endsection
@section('front-js')
    <script>
        $(document).ready(function(){
            // $(document).on("change","#sort",function(){
            //     $("#sortForm").submit();
            // }); //ata form diye page reload hoye sort hobe

                //ajx method
            $(document).on("change", "#sort", function(){
                var sort = $(this).val();
                var url = $("#url").val();
                $.ajax({
                    url: url,
                    method: "post",
                    data:{sort:sort, url:url},
                    success: function(data){
                        $(".products_filter").html(data);
                    }
                });
            });
        });
    </script>
@endsection
