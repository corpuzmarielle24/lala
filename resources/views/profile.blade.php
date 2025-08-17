<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> KnowTest</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('loading.png')}}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('ai/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('ai/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('ai/assets/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{ asset('ai/assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('ai/assets/css/progressbar_barfiller.css')}}">
    <link rel="stylesheet" href="{{ asset('ai/assets/css/gijgo.css')}}">
    <link rel="stylesheet" href="{{ asset('ai/assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{ asset('ai/assets/css/animated-headline.css')}}">
    <link rel="stylesheet" href="{{ asset('ai/assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('ai/assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('ai/assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('ai/assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('ai/assets/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{ asset('ai/assets/css/style.css')}}">

    <style>
        /* Ensure all cards have the same height */
        .single-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        /* Ensure the card content doesn't overflow */
        .card-top, .card-mid, .card-bottom {
            margin: 0;
        }

        /* Style list items to be left-aligned with bullets */
        .card-bottom ul {
            list-style-type: disc; /* Adds bullet points */
            padding-left: 20px; /* Adjust this value as needed */
            text-align: left; /* Ensure text aligns to the left */
        }

        /* Optional: Add some spacing between list items */
        .card-bottom ul li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('loading.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="/"><img src="{{ asset('ban.png')}}" alt="" style="height: 100px;"></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                          
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <main>
        <!-- Slider Area Start-->
        <div class="slider-area slider-bg " style="padding-bottom:20px">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider d-flex  slider-height ">
                    <div class="container " style="margin-top:150px">
                        <div class="container ">
                            @if(auth()->check())
                                <h2 style="color: white;">Your Subscriptions</h2>

                                @php
                                    // Fetch the most recent subscription for the authenticated user
                                    $subscription = DB::table('subscriptions')
                                        ->select('subscription_type', 'amount', 'date', 
                                                 DB::raw('DATE_ADD(date, INTERVAL 1 MONTH) AS expiration'))
                                        ->where('user_id', auth()->id())
                                        ->orderBy('id', 'desc')
                                        ->first();

                                    // Check if the subscription exists and if it is expired
                                    $currentDate = now();
                                    $isExpired = !$subscription || $currentDate->greaterThan($subscription->expiration);

                                    // Prepare fallback values if no valid subscription or expired
                                    $subscription_type = $isExpired ? 'Limited Access' : $subscription->subscription_type;
                                    $amount = $isExpired ? 'N/A' : $subscription->amount;
                                    $date = $isExpired ? 'N/A' : $subscription->date;
                                    $expiration = $isExpired ? 'N/A' : $subscription->expiration;
                                @endphp

                                <div class="card" style="border-radius: 20px; border: none; background: linear-gradient(145deg, #2b1349, #7138a9); 
                                     box-shadow: 0 8px 15px rgba(255, 255, 255, 0.3); padding: 20px; margin-bottom: 20px;">
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <h2 style="color: white; font-weight: bold; margin-bottom: 10px; text-transform: uppercase; text-decoration: underline; text-align: center;">
                                            {{ $subscription_type }}
                                        </h2>
                                        <div style="width: 100%; text-align: center;">
                                            <p style="color: white; font-size: 1.5rem; margin: 0;">
                                                <strong>Amount: ₱</strong>{{ $amount }}
                                            </p>
                                            <p style="color: white; font-size: 1.5rem; margin: 0;">
                                                <strong>Date Availed:</strong> {{ $date }}
                                            </p>
                                            <p style="color: white; font-size: 1.5rem; margin: 0;">
                                                <strong>Expiration:</strong> {{ $expiration }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Profile Form Card Start -->
                            <div class="card" style="border-radius: 20px; border: none; background: linear-gradient(145deg, #2b1349, #7138a9); 
                                 box-shadow: 0 8px 15px rgba(255, 255, 255, 0.3); padding: 20px; margin-top: 20px;">
                                <h2 style="color: white; text-align: center; ">Profile Update</h2>
                                  @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
                                <form action="/user/profile-update" method="POST" >
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" style="color: white;">Name:</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" style="color: white;">Email:</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" required>
                                    </div>
                                       <div class="form-group">
                                        <label for="address" style="color: white;">Address:</label>
                                        <input type="text" name="address" id="address" class="form-control" value="{{ Auth::user()->address }}" required>
                                    </div>
                                       <div class="form-group">
                                        <label for="mobile" style="color: white;">Mobile:</label>
                                        <input type="text" name="mobile" id="mobile" class="form-control" value="{{ Auth::user()->mobile }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" style="color: white;">Password:</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="width: 100%; background-color: #7138a9; border: none;">Update Profile</button>
                                </form>
                            </div>
                            <!-- Profile Form Card End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Area End-->
    </main>

    <!-- Footer Start -->
    <footer>
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="footer-copy-right">
                            <p>
                                © 2024 KnowTest. All rights reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- JS here -->
    <script src="{{ asset('ai/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{ asset('ai/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{ asset('ai/assets/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{ asset('ai/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('ai/assets/js/slicknav.js')}}"></script>
    <script src="{{ asset('ai/assets/js/gijgo.min.js')}}"></script>
    <script src="{{ asset('ai/assets/js/wow.min.js')}}"></script>
    <script src="{{ asset('ai/assets/js/animated.headline.js')}}"></script>
    <script src="{{ asset('ai/assets/js/jquery.magnific-popup.js')}}"></script>
    <script src="{{ asset('ai/assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{ asset('ai/assets/js/jquery.slick.min.js')}}"></script>
    <script src="{{ asset('ai/assets/js/plugins.js')}}"></script>
    <script src="{{ asset('ai/assets/js/main.js')}}"></script>
</body>
</html>
