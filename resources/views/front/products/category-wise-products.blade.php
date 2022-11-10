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
                <li><a
                        href="{{ url('/' . $category->parentCategory->url) }}">{{ $category->parentCategory->category_name }}</a>
                    <span class="divider">/</span></li>
                <li class="active">{{ $category->category_name }}</li>
            @endif
        </ul>
        <h3> {{ $category->category_name }} <small class="pull-right">{{ $productsCount }} products are available </small>
        </h3>
        <hr class="soft" />
        <p>
            {{ $category->description }}
        </p>
        <hr class="soft" />
        @if ($productsCount != 0)
            <form class="form-horizontal span6" id="sortForm">
                <div class="control-group">
                    <label class="control-label alignL">Sort By </label>
                    <input type="hidden" id="url" value="{{ $category->url }}">
                    <select name="sort" id="sort" category_url="{{ $category->url }}">
                        <option value="">Select</option>
                        <option value="latest_products">Latest Products</option>
                        <option value="product_name_a_z">Product Name A - Z</option>
                        <option value="product_name_z_a">Product Name Z - A</option>
                        <option value="price_lowest_first">Price Lowest first</option>
                        <option value="price_highest_first">Price Highest first</option>
                    </select>
                </div>
            </form>
        @else
            <h2 style="text-align: center;"> Sorry,,Product Not Availabe In This Category</h2>
        @endif
        {{-- <div id="myTab" class="pull-right">
        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
    </div> --}}
        <br class="clr" />
        {{-- @if ($productsCount != 0) <!-- ata amar kora proudct jodi 0 thke tahole faka thkbe kisui dekabe na karon opore sorry txt deya ase pduct na thkle tai cmpare er need nai --> --}}
            <div class="tab-content products_filter">
                <!-- Products incluse here -->
                @include('front.products.ajax-category-products-filter')
            </div>
            <a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
        {{-- @endif --}}
        <div class="pagination">
           @if (!empty($data))
                {{ $categoryProducts->appends(['data' => $data])->links() }}
           @else
                {{ $categoryProducts->links() }}
           @endif
        </div>
        <br class="clr" />
    </div>
@endsection
@section('front-js')
    <script>
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $(document).ready(function() {
            //     $(document).on("change",".sortP",function(){
            //         var = value= $(this).val();
            //         alert(value);
            //     }); //ata form diye page reload hoye sort hobe

            //ajx method
            $(document).on("change", "#sort", function() {
                var sort = $(this).val();
                var fabric = get_filter('fabric');
                var pattern = get_filter('pattern');
                var sleeve = get_filter('sleeve');
                var fit = get_filter('fit');
                var occasion = get_filter('occasion');
                var url = $("#url").val();
                $.ajax({
                    url: url,
                    method: "post",
                    data: {
                        fabric: fabric,
                        pattern: pattern,
                        sleeve: sleeve,
                        fit: fit,
                        occasion: occasion,
                        sort: sort,
                        url: url
                    },
                    success: function(data) {
                        $(".products_filter").html(data);
                    }
                });
            });

            $(".fabric").on('click', function() {
                var fabric = get_filter('fabric');
                var pattern = get_filter('pattern');
                var sleeve = get_filter('sleeve');
                var fit = get_filter('fit');
                var occasion = get_filter('occasion');
                var sort = $("#sort option:selected").val();
                var url = $("#url").val();
                $.ajax({
                    url: url,
                    method: "post",
                    data: {
                        fabric: fabric,
                        pattern: pattern,
                        sleeve: sleeve,
                        fit: fit,
                        occasion: occasion,
                        sort: sort,
                        url: url
                    },
                    success: function(data) {
                        $(".products_filter").html(data);
                    },

                })
            })
            $(".pattern").on('click', function() {
                var fabric = get_filter('fabric');
                var pattern = get_filter('pattern');
                var sleeve = get_filter('sleeve');
                var fit = get_filter('fit');
                var occasion = get_filter('occasion');
                var sort = $("#sort option:selected").val();
                var url = $("#url").val();
                $.ajax({
                    url: url,
                    method: "post",
                    data: {
                        fabric: fabric,
                        pattern: pattern,
                        sleeve: sleeve,
                        fit: fit,
                        occasion: occasion,
                        sort: sort,
                        url: url
                    },
                    success: function(data) {
                        $(".products_filter").html(data);
                    },

                })
            })
            $(".sleeve").on('click', function() {
                var fabric = get_filter('fabric');
                var pattern = get_filter('pattern');
                var sleeve = get_filter('sleeve');
                var fit = get_filter('fit');
                var occasion = get_filter('occasion');
                var sort = $("#sort option:selected").val();
                var url = $("#url").val();
                $.ajax({
                    url: url,
                    method: "post",
                    data: {
                        fabric: fabric,
                        pattern: pattern,
                        sleeve: sleeve,
                        fit: fit,
                        occasion: occasion,
                        sort: sort,
                        url: url
                    },
                    success: function(data) {
                        $(".products_filter").html(data);
                    },

                })
            })
            $(".fit").on('click', function() {
                var fabric = get_filter('fabric');
                var pattern = get_filter('pattern');
                var sleeve = get_filter('sleeve');
                var fit = get_filter('fit');
                var occasion = get_filter('occasion');
                var sort = $("#sort option:selected").val();
                var url = $("#url").val();
                $.ajax({
                    url: url,
                    method: "post",
                    data: {
                        fabric: fabric,
                        pattern: pattern,
                        sleeve: sleeve,
                        fit: fit,
                        occasion: occasion,
                        sort: sort,
                        url: url
                    },
                    success: function(data) {
                        $(".products_filter").html(data);
                    },

                })
            })
            $(".occasion").on('click', function() {
                var fabric = get_filter('fabric');
                var pattern = get_filter('pattern');
                var sleeve = get_filter('sleeve');
                var fit = get_filter('fit');
                var occasion = get_filter('occasion');
                var sort = $("#sort option:selected").val();
                var url = $("#url").val();
                $.ajax({
                    url: url,
                    method: "post",
                    data: {
                        fabric: fabric,
                        pattern: pattern,
                        sleeve: sleeve,
                        fit: fit,
                        occasion: occasion,
                        sort: sort,
                        url: url
                    },
                    success: function(data) {
                        $(".products_filter").html(data);
                    },

                })
            })

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;
            }
        });
    </script>
@endsection

