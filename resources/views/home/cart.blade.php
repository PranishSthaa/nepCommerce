<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>My Cart | Ecommerce</title>
    <base href="/public">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="home/css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="home/css/slick.css" />
    <link type="text/css" rel="stylesheet" href="home/css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="home/css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="home/css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="home/css/style.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>
    <!-- HEADER -->
    @include('home.header')
    <!-- /HEADER -->

    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">My Cart</h3>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                @if (session()->has('message'))
                    <div class="col-lg-4 alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product Image</th>
                                <th>Title</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr>
                                    <td><img src="product/{{ $cart->product->image }}" height="100" width="100">
                                    </td>
                                    <td>{{ $cart->product->title }}</td>
                                    <td>
                                        <div style="width: 100px;">
                                            <div class="qty-label">
                                                <div class="input-number">
                                                    <input type="number" name="quantity" min="1"
                                                        value="{{ $cart->quantity }}">
                                                    <span class="qty-up">+</span>
                                                    <span class="qty-down">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $cart->product->discount_price ? $cart->product->price - $cart->product->discount_price : $cart->product->price }}
                                    </td>
                                    <td><a onclick="return confirm('Delete product?')"
                                            href="{{ route('deleteProductFromCart', $cart->id) }}">
                                            <button class="btn btn-danger">Delete</button>
                                        </a>
                                        <a href="#">
                                            <button class="btn btn-primary ml-2">Edit</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Order Details -->
                <div class="col-md-4 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Your Order</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        <div class="order-products">
                            <?php $total = 0; ?>
                            @foreach ($carts as $cart)
                                <?php
                                $actualPrice = $cart->product->discount_price ? $cart->product->price - $cart->product->discount_price : $cart->product->price;
                                ?>
                                <div class="order-col">
                                    <div>{{ $cart->quantity }}x {{ $cart->product->title }}</div>
                                    <?php $productTotalPrice = $cart->quantity * $actualPrice; ?>
                                    <div>Rs. {{ $productTotalPrice }}</div>
                                </div>
                                <?php $total = $total + $productTotalPrice; ?>
                            @endforeach
                        </div>
                        <div class="order-col">
                            <div>Shiping</div>
                            <div><strong>FREE</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total">Rs. {{ $total }}</strong></div>
                        </div>
                    </div>
                    {{-- <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-1">
                            <label for="payment-1">
                                <span></span>
                                Direct Bank Transfer
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-2">
                            <label for="payment-2">
                                <span></span>
                                Cheque Payment
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-3">
                            <label for="payment-3">
                                <span></span>
                                Paypal System
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="terms">
                        <label for="terms">
                            <span></span>
                            I've read and accept the <a href="#">terms & conditions</a>
                        </label>
                    </div> --}}
                    <a href="{{ route('checkout') }}" class="primary-btn order-submit">
                        Proceed With Cash
                    </a>
                    <a href="#" class="primary-btn order-submit">Proceed With Esewa</a>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    @include('home.footer')
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="home/js/jquery.min.js"></script>
    <script src="home/js/bootstrap.min.js"></script>
    <script src="home/js/slick.min.js"></script>
    <script src="home/js/nouislider.min.js"></script>
    <script src="home/js/jquery.zoom.min.js"></script>
    <script src="home/js/main.js"></script>

    <script>
        var alert = document.getElementsByClassName("alert")[0];
        setTimeout(function() {
            alert.style.display = "none";
        }, 3000);
    </script>

</body>

</html>
