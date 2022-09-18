@extends('master.front-master.master')
@section('title')
    HOME
@endsection

@section('slider')
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
			<div class="item active">
				<div class="container">
					<a href="#"><img style="width:100%" src="{{asset('/')}}front/assets/images/carousel/1.png" alt="special offers"/></a>
					<div class="carousel-caption">
						<h4>First Thumbnail label</h4>
						<p>Banner text</p>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="container">
					<a href="register.html"><img style="width:100%" src="{{asset('/')}}front/assets/images/carousel/2.png" alt=""/></a>
					<div class="carousel-caption">
						<h4>Second Thumbnail label</h4>
						<p>Banner text</p>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="container">
					<a href="register.html"><img src="{{asset('/')}}front/assets/images/carousel/3.png" alt=""/></a>
					<div class="carousel-caption">
						<h4>Third Thumbnail label</h4>
						<p>Banner text</p>
					</div>

				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div>

@endsection

@section('body')
<div class="span9">
    <div class="well well-small">
        <h4>Featured Products <small class="pull-right">{{ $featureProductCount }}+ featured products</small></h4>
        <div class="row-fluid">
            <div id="featured" class="{{ $featureProductCount > 4 ? 'carousel slide' : '' }}"> <!-- class er vitor a condition dilam karon jodi feature product 4 ta ba tar niche thke thle next r previoust arrow ta asbe na r prodcut ta  jdi 4 ta er beshi thke ta auto chole asbe next r prvious arrow ta-->
                <div class="carousel-inner">
                    <?php $item=0; ?>
                    @foreach ($featureItemChunk as $key => $featureProducts) <!-- featureItemChunk thke 4 ta kore product $featureProducts a asbe r $key 1st a 0 asbe tar por tar por joto gula 4ta kore product asbe to $key barbe mane 4ta prodct er jno 0 8 ta pduct er jnno 1 12 ta pdct er jnno 2 amn avabe -->
                    <div class="item {{ $key == 0 ? 'active' : '' }}"> <!-- akane $key == 0 condition dilalm karon 1st 4ta product active thakbe index page 1st aslei 1st er 4ta product dekhabe more details ecom series video 58-->
                        <ul class="thumbnails">
                            @foreach ($featureProducts as $featureProduct) <!-- $feature product a 4 kore product asbe aii 4 ta thke abar 1ta kore product aii product a asbe -->
                                <?php $item++; ?>
                            <li class="span3">
                                <div class="thumbnail">
                                    @if ($key <= 1 && $item <= 6) <!-- $item ata amr tecnic avabe kaj krlm karon ami 6 ta product a new tag dekhabo tai ami jodi 3 ta te dekate chai tale sudu item 3 dilei hobe -->
                                        <i class="tag"></i>
                                    @endif
                                    <a href="product_details.html"><img src="{{asset('images/product-image/small/'.$featureProduct['main_image'])}}" alt=""></a>
                                    <div class="caption">
                                        <h5>{{ $featureProduct['product_name'] }}</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.1000</span></h4>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                    {{-- <div class="item">
                        <ul class="thumbnails">
                            <li class="span3">
                                <div class="thumbnail">
                                    <i class="tag"></i>
                                    <a href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/5.jpg" alt=""></a>
                                    <div class="caption">
                                        <h5>Product name</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.1000</span></h4>
                                    </div>
                                </div>
                            </li>
                            <li class="span3">
                                <div class="thumbnail">
                                    <i class="tag"></i>
                                    <a href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/6.jpg" alt=""></a>
                                    <div class="caption">
                                        <h5>Product name</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.1000</span></h4>
                                    </div>
                                </div>
                            </li>
                            <li class="span3">
                                <div class="thumbnail">
                                    <a href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/7.jpg" alt=""></a>
                                    <div class="caption">
                                        <h5>Product name</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.1000</span></h4>
                                    </div>
                                </div>
                            </li>
                            <li class="span3">
                                <div class="thumbnail">
                                    <a href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/8.jpg" alt=""></a>
                                    <div class="caption">
                                        <h5>Product name</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.1000</span></h4>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="item">
                        <ul class="thumbnails">
                            <li class="span3">
                                <div class="thumbnail">
                                    <a href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/9.jpg" alt=""></a>
                                    <div class="caption">
                                        <h5>Product name</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.1000</span></h4>
                                    </div>
                                </div>
                            </li>
                            <li class="span3">
                                <div class="thumbnail">
                                    <a href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/10.jpg" alt=""></a>
                                    <div class="caption">
                                        <h5>Product name</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.1000</span></h4>
                                    </div>
                                </div>
                            </li>
                            <li class="span3">
                                <div class="thumbnail">
                                    <a href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/11.jpg" alt=""></a>
                                    <div class="caption">
                                        <h5>Product name</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.1000</span></h4>
                                    </div>
                                </div>
                            </li>
                            <li class="span3">
                                <div class="thumbnail">
                                    <a href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/1.jpg" alt=""></a>
                                    <div class="caption">
                                        <h5>Product name</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.1000</span></h4>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="item">
                        <ul class="thumbnails">
                            <li class="span3">
                                <div class="thumbnail">
                                    <a href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/2.jpg" alt=""></a>
                                    <div class="caption">
                                        <h5>Product name</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.1000</span></h4>
                                    </div>
                                </div>
                            </li>
                            <li class="span3">
                                <div class="thumbnail">
                                    <a href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/3.jpg" alt=""></a>
                                    <div class="caption">
                                        <h5>Product name</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.1000</span></h4>
                                    </div>
                                </div>
                            </li>
                            <li class="span3">
                                <div class="thumbnail">
                                    <a href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/4.jpg" alt=""></a>
                                    <div class="caption">
                                        <h5>Product name</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.1000</span></h4>
                                    </div>
                                </div>
                            </li>
                            <li class="span3">
                                <div class="thumbnail">
                                    <a href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/5.jpg" alt=""></a>
                                    <div class="caption">
                                        <h5>Product name</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.1000</span></h4>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                </div>
                <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#featured" data-slide="next">›</a>
            </div>
        </div>
    </div>
    <h4>Latest Products </h4>
    <ul class="thumbnails">
        @foreach ($latestProducts as $latestProduct)
            <li class="span3">
                <div class="thumbnail">
                    <a  href="product_details.html"><img src="{{asset('images/product-image/small/'.$latestProduct->main_image)}}" alt="" width="160" height="300"/></a>
                    <div class="caption">
                        <h5>{{ $latestProduct->product_name }}</h5>
                        <p>
                            Code: {{ $latestProduct->product_code }}
                        </p>
                        <p>
                            Color: {{ $latestProduct->product_color }}
                        </p>

                        <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                    </div>
                </div>
            </li>
        @endforeach
        {{-- <li class="span3">
            <div class="thumbnail">
                <a  href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/7.jpg" alt=""/></a>
                <div class="caption">
                    <h5>Product name</h5>
                    <p>
                        Lorem Ipsum is simply dummy text.
                    </p>
                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                </div>
            </div>
        </li>
        <li class="span3">
            <div class="thumbnail">
                <a  href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/8.jpg" alt=""/></a>
                <div class="caption">
                    <h5>Product name</h5>
                    <p>
                        Lorem Ipsum is simply dummy text.
                    </p>
                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                </div>
            </div>
        </li>
        <li class="span3">
            <div class="thumbnail">
                <a  href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/9.jpg" alt=""/></a>
                <div class="caption">
                    <h5>Product name</h5>
                    <p>
                        Lorem Ipsum is simply dummy text.
                    </p>
                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                </div>
            </div>
        </li>
        <li class="span3">
            <div class="thumbnail">
                <a  href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/10.jpg" alt=""/></a>
                <div class="caption">
                    <h5>Product name</h5>
                    <p>
                        Lorem Ipsum is simply dummy text.
                    </p>
                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                </div>
            </div>
        </li>
        <li class="span3">
            <div class="thumbnail">
                <a  href="product_details.html"><img src="{{asset('/')}}front/assets/images/products/11.jpg" alt=""/></a>
                <div class="caption">
                    <h5>Product name</h5>
                    <p>
                        Lorem Ipsum is simply dummy text.
                    </p>
                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                </div>
            </div>
        </li> --}}
    </ul>
</div>
@endsection
