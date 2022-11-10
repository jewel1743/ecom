<?php use App\Product; ?>
<?php

    if (!empty($data)) {
        echo '<pre>'; print_r($data); die;
    }

    ?>
<div class="tab-pane  active" id="blockView">
    <ul class="thumbnails">
        @foreach ($categoryProducts as $product)
            <li class="span3">
                <div class="thumbnail">
                    <a href="{{ route('front-product-details',['id' => $product->id]) }}"><img src="{{asset('images/product-image/small/'.$product->main_image) }}" alt="{{ $product->product_name }}" width="160"/></a>
                    <div class="caption">
                        <h5>{{ $product->product_name }}</h5>
                        <p>
                            Brand({{ $product->brand->brand_name }})
                        </p>
                        <h4 style="text-align:center">
                            <?php $discounted_price = Product::getProductDiscountedPrice($product->id); ?>
                            <a class="btn" href="{{ route('front-product-details',['id' => $product->id]) }}">Add to <i class="icon-shopping-cart"></i></a>
                            <a  href="{{ route('front-product-details',['id' => $product->id]) }}" style="font-size: 12px;">
                                @if ($discounted_price > 0)
                                    <del> TK.{{ $product->product_price }}</del>
                                     <span style="color: red;">TK.{{ $product->product_price }}</span>
                                @else
                                    BDT.{{ $product->product_price }}
                                @endif
                            </a>
                        </h4>

                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <hr class="soft"/>
</div>
