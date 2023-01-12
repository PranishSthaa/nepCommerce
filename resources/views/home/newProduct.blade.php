<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">New Products</h3>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                <!-- product -->
                                @foreach ($products as $product)
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="product/{{ $product->image }}" alt="">
                                            <div class="product-label">
                                                <span class="sale">-30%</span>
                                                <span class="new">NEW</span>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{ $product->category->category_name }}</p>
                                            <h3 class="product-name"><a
                                                    href="{{ route('productDetail', $product->id) }}">{{ $product->title }}</a>
                                            </h3>
                                            @if ($product->discount_price == null)
                                                <h4 class="product-price">
                                                    Rs. {{ $product->price }}
                                                </h4>
                                            @else
                                                <h4 class="product-price">
                                                    Rs. {{ $product->price - $product->discount_price }}
                                                    <del class="product-old-price">Rs. {{ $product->price }}</del>
                                                </h4>
                                            @endif
                                        </div>
                                        <div class="add-to-cart">
                                            <form action="{{ route('addToCart', $product->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="add-to-cart-btn">
                                                    <i class="fa fa-shopping-cart"></i> add to cart
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- /product -->
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
