<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="product_summary.html"><img src="{{asset('/')}}front/assets/images/ico-cart.png" alt="cart">3 Items in your cart</a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
            @foreach ($sections as $section)
            <li class="subMenu"><a>{{ $section->name }}</a>
            <ul>
            @if (count($section->categories) >0)
                @foreach ($section->categories as $category)
                    <li><a href="{{ $category->url }}"><i class="icon-chevron-right"></i><strong>{{ $category->category_name }}</strong></a></li>
                    @foreach ($category->subCategory as $subCategory)
                        <li><a href="{{ $subCategory->url }}"><i class="icon-chevron-right"></i>{{ $subCategory->category_name }}</a></li>
                    @endforeach
                @endforeach
            @endif
            </ul>
            {{-- <ul>
                <li><a href="products.html"><i class="icon-chevron-right"></i><strong>Shirts</strong></a></li>
                <li><a href="products.html"><i class="icon-chevron-right"></i>Casual Shirts</a></li>
                <li><a href="products.html"><i class="icon-chevron-right"></i>Formal Shirts</a></li>
            </ul> --}}
            @endforeach
        </li>
        {{-- <li class="subMenu"><a> WOMEN </a>
            <ul>
                <li><a href="products.html"><i class="icon-chevron-right"></i><strong>Tops</strong></a></li>
                <li><a href="products.html"><i class="icon-chevron-right"></i>Casual Tops</a></li>
                <li><a href="products.html"><i class="icon-chevron-right"></i>Formal Tops</a></li>
            </ul>
            <ul>
                <li><a href="products.html"><i class="icon-chevron-right"></i><strong>Dresses</strong></a></li>
                <li><a href="products.html"><i class="icon-chevron-right"></i>Casual Dresses</a></li>
                <li><a href="products.html"><i class="icon-chevron-right"></i>Formal Dresses</a></li>
            </ul>
        </li>
        <li class="subMenu"><a>KIDS</a>
            <ul>
                <li><a href="products.html"><i class="icon-chevron-right"></i><strong>T-Shirts</strong></a></li>
                <li><a href="products.html"><i class="icon-chevron-right"></i>Casual T-Shirts</a></li>
                <li><a href="products.html"><i class="icon-chevron-right"></i>Formal T-Shirts</a></li>
            </ul>
            <ul>
                <li><a href="products.html"><i class="icon-chevron-right"></i><strong>Shirts</strong></a></li>
                <li><a href="products.html"><i class="icon-chevron-right"></i>Casual Shirts</a></li>
                <li><a href="products.html"><i class="icon-chevron-right"></i>Formal Shirts</a></li>
            </ul>
        </li> --}}
    </ul>
    <br/>
    <div class="thumbnail">
        <img src="{{asset('/')}}front/assets/images/payment_methods.png" title="Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>
