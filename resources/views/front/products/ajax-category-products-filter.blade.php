
<div class="tab-pane  active" id="blockView">
    <ul class="thumbnails">
        @foreach ($categoryProducts as $product)
            <li class="span3">
                <div class="thumbnail">
                    <a href="product_details.html"><img src="{{asset('images/product-image/small/'.$product->main_image) }}" alt="{{ $product->product_name }}" width="160"/></a>
                    <div class="caption">
                        <h5>{{ $product->product_name }}</h5>
                        <p>
                            Brand({{ $product->brand->brand_name }})
                        </p>
                        <p>
                            Fabric({{ $product->fabric}})
                        </p>
                        <p>
                            Pattern({{ $product->pattern }})
                        </p>
                        <p>
                            Sleeve({{ $product->sleeve }})
                        </p>
                        <p>
                            Fit({{ $product->fit }})
                        </p>
                        <p>
                            Occasion({{ $product->occasion }})
                        </p>
                        <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">BDT.{{ $product->product_price }}</a></h4>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <hr class="soft"/>
</div>
