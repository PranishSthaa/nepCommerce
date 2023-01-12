<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Order | AdminPanel</title>
    <base href="/public">

    <!-- plugins:css -->
    <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="admin/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="admin/assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.navbar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> All Orders </h3>
                    </div>
                    @if (session()->has('message'))
                        <div class="col-lg-4 alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Pending Order</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product Image</th>
                                                <th>Product Title</th>
                                                <th>Ordered By</th>
                                                <th>Payment Status</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pendingOrders as $index => $pendingOrder)
                                                <?php
                                                $actualPrice = $pendingOrder->cart->product->discount_price ? $pendingOrder->cart->product->price - $pendingOrder->cart->product->discount_price : $pendingOrder->cart->product->price;
                                                ?>
                                                <tr>
                                                    <td><img src="product/{{ $pendingOrder->cart->product->image }}"
                                                            alt=""
                                                            style="height: 100px; width: 100px; border-radius: 0%;">
                                                    </td>
                                                    <td>{{ $pendingOrder->cart->product->title }}</td>
                                                    <td>{{ $pendingOrder->user->name }}</td>
                                                    <td>{{ $pendingOrder->payment_status }}</td>
                                                    <td>{{ $pendingOrder->cart->quantity }}</td>
                                                    <td>{{ $actualPrice }}</td>
                                                    <td>Rs. {{ $pendingOrder->cart->quantity * $actualPrice }}</td>
                                                    <td>
                                                        <a onclick="return confirm('Delete Order?')"
                                                            href="{{ route('deleteOrder', $pendingOrder->id) }}">
                                                            <button class="btn btn-outline-danger">Delete</button>
                                                        </a>
                                                        <a href="{{ route('orderDeliver', $pendingOrder->id) }}">
                                                            <button class="btn btn-outline-success"
                                                                style="margin-left: 4px;">Deliver</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Delivered Order</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product Image</th>
                                                <th>Product Title</th>
                                                <th>Ordered By</th>
                                                <th>Payment Status</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($deliveredOrders as $index => $deliveredOrder)
                                                <?php
                                                $actualPrice = $deliveredOrder->cart->product->discount_price ? $deliveredOrder->cart->product->price - $deliveredOrder->cart->product->discount_price : $deliveredOrder->cart->product->price;
                                                ?>
                                                <tr>
                                                    <td><img src="product/{{ $deliveredOrder->cart->product->image }}"
                                                            alt=""
                                                            style="height: 100px; width: 100px; border-radius: 0%;">
                                                    </td>
                                                    <td>{{ $deliveredOrder->cart->product->title }}</td>
                                                    <td>{{ $deliveredOrder->user->name }}</td>
                                                    <td>{{ $deliveredOrder->payment_status }}</td>
                                                    <td>{{ $deliveredOrder->cart->quantity }}</td>
                                                    <td>{{ $actualPrice }}</td>
                                                    <td>Rs. {{ $deliveredOrder->cart->quantity * $actualPrice }}</td>
                                                    <td>
                                                        <a onclick="return confirm('Delete Order?')"
                                                            href="{{ route('deleteOrder', $deliveredOrder->id) }}">
                                                            <button class="btn btn-outline-danger">Delete</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="admin/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="admin/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="admin/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="admin/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="admin/assets/js/off-canvas.js"></script>
    <script src="admin/assets/js/hoverable-collapse.js"></script>
    <script src="admin/assets/js/misc.js"></script>
    <script src="admin/assets/js/settings.js"></script>
    <script src="admin/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="admin/assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
    <script>
        var alert = document.getElementsByClassName("alert")[0];
        setTimeout(function() {
            alert.style.display = "none";
        }, 3000);
    </script>
</body>

</html>
