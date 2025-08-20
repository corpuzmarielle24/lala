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
        /* Modern responsive design */
        @media (max-width: 768px) {
            .grid-two {
                grid-template-columns: 1fr !important;
            }
            .grid-three {
                grid-template-columns: 1fr !important;
            }
        }
        
        /* Smooth animations */
        * {
            transition: all 0.2s ease !important;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 4px;
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
        <div class="slider-area slider-bg" style="min-height: 100vh; padding: 100px 0 40px 0;">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider">
                    <div class="container" style="max-width: 900px;">
                        <div class="container">
                            @if(auth()->check())
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

                                <!-- Subscription Status Card -->
                                <div style="background: rgba(255,255,255,0.95); border-radius: 16px; padding: 24px; margin-bottom: 24px; 
                                           backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.2);">
                                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                                        <div>
                                            <h1 style="color: #1a1a1a; font-size: 1.8rem; font-weight: 700; margin: 0; letter-spacing: -0.02em;">
                                                {{ $subscription_type }}
                                            </h1>
                                            <p style="color: #666; font-size: 0.9rem; margin: 4px 0 0 0;">Current subscription plan</p>
                                        </div>
                                        <div style="width: 50px; height: 50px; background: #667eea; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    
                                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 16px;">
                                        <div style="background: #f8fafc; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0;">
                                            <div style="color: #64748b; font-size: 0.75rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">
                                                Amount Paid
                                            </div>
                                            <div style="color: #0f172a; font-size: 1.25rem; font-weight: 700; line-height: 1;">
                                                ₱{{ $amount }}
                                            </div>
                                        </div>
                                        <div style="background: #f0fdf4; border-radius: 12px; padding: 16px; border: 1px solid #bbf7d0;">
                                            <div style="color: #166534; font-size: 0.75rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">
                                                Started
                                            </div>
                                            <div style="color: #0f172a; font-size: 1.25rem; font-weight: 700; line-height: 1;">
                                                {{ $date }}
                                            </div>
                                        </div>
                                        <div style="background: #fef2f2; border-radius: 12px; padding: 16px; border: 1px solid #fecaca;">
                                            <div style="color: #991b1b; font-size: 0.75rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">
                                                Expires
                                            </div>
                                            <div style="color: #0f172a; font-size: 1.25rem; font-weight: 700; line-height: 1;">
                                                {{ $expiration }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Profile Update Form -->
                            <div style="background: rgba(255,255,255,0.95); border-radius: 16px; padding: 24px; 
                                       backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.2);">
                                <div style="text-align: center; margin-bottom: 24px;">
                                    <h2 style="color: #1a1a1a; font-size: 1.5rem; font-weight: 700; margin: 0; letter-spacing: -0.02em;">
                                        Update Profile
                                    </h2>
                                    <p style="color: #666; font-size: 0.9rem; margin: 6px 0 0 0;">Keep your information up to date</p>
                                </div>

                                @if(session('success'))
                                    <div style="background: #10b981; color: white; border-radius: 12px; padding: 16px 20px; margin-bottom: 32px; 
                                               display: flex; align-items: center; gap: 12px;">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M9 12l2 2 4-4"/>
                                            <circle cx="12" cy="12" r="10"/>
                                        </svg>
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="/user/profile-update" method="POST">
                                    @csrf
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                                        <div>
                                            <label for="name" style="color: #374151; font-weight: 600; margin-bottom: 6px; display: block; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                                Full Name
                                            </label>
                                            <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" required
                                                   style="width: 100%; border: 2px solid #e5e7eb; border-radius: 8px; padding: 12px 16px; font-size: 14px; 
                                                         background: #f9fafb; transition: all 0.2s; outline: none;"
                                                   onfocus="this.style.borderColor='#667eea'; this.style.background='#ffffff';"
                                                   onblur="this.style.borderColor='#e5e7eb'; this.style.background='#f9fafb';">
                                        </div>
                                        <div>
                                            <label for="email" style="color: #374151; font-weight: 600; margin-bottom: 6px; display: block; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                                Email Address
                                            </label>
                                            <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" required
                                                   style="width: 100%; border: 2px solid #e5e7eb; border-radius: 8px; padding: 12px 16px; font-size: 14px; 
                                                         background: #f9fafb; transition: all 0.2s; outline: none;"
                                                   onfocus="this.style.borderColor='#667eea'; this.style.background='#ffffff';"
                                                   onblur="this.style.borderColor='#e5e7eb'; this.style.background='#f9fafb';">
                                        </div>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label for="address" style="color: #374151; font-weight: 600; margin-bottom: 6px; display: block; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                            Address
                                        </label>
                                        <input type="text" name="address" id="address" value="{{ Auth::user()->address }}" required
                                               style="width: 100%; border: 2px solid #e5e7eb; border-radius: 8px; padding: 12px 16px; font-size: 14px; 
                                                     background: #f9fafb; transition: all 0.2s; outline: none;"
                                               onfocus="this.style.borderColor='#667eea'; this.style.background='#ffffff';"
                                               onblur="this.style.borderColor='#e5e7eb'; this.style.background='#f9fafb';">
                                    </div>

                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                                        <div>
                                            <label for="mobile" style="color: #374151; font-weight: 600; margin-bottom: 6px; display: block; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                                Mobile Number
                                            </label>
                                            <input type="text" name="mobile" id="mobile" value="{{ Auth::user()->mobile }}" required
                                                   style="width: 100%; border: 2px solid #e5e7eb; border-radius: 8px; padding: 12px 16px; font-size: 14px; 
                                                         background: #f9fafb; transition: all 0.2s; outline: none;"
                                                   onfocus="this.style.borderColor='#667eea'; this.style.background='#ffffff';"
                                                   onblur="this.style.borderColor='#e5e7eb'; this.style.background='#f9fafb';">
                                        </div>
                                        <div>
                                            <label for="password" style="color: #374151; font-weight: 600; margin-bottom: 6px; display: block; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                                New Password
                                            </label>
                                            <input type="password" name="password" id="password" placeholder="Leave blank to keep current"
                                                   style="width: 100%; border: 2px solid #e5e7eb; border-radius: 8px; padding: 12px 16px; font-size: 14px; 
                                                         background: #f9fafb; transition: all 0.2s; outline: none;"
                                                   onfocus="this.style.borderColor='#667eea'; this.style.background='#ffffff';"
                                                   onblur="this.style.borderColor='#e5e7eb'; this.style.background='#f9fafb';">
                                        </div>
                                    </div>

                                    <button type="submit" 
                                            style="width: 100%; background: #667eea; color: white; border: none; border-radius: 8px; 
                                                  padding: 14px 20px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.2s;
                                                  text-transform: uppercase; letter-spacing: 0.5px;"
                                            onmouseover="this.style.background='#5a67d8'; this.style.transform='translateY(-1px)';"
                                            onmouseout="this.style.background='#667eea'; this.style.transform='translateY(0)';">
                                        Update Profile
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Area End-->
    </main>

    <!-- Footer Start -->
    <footer style="background: rgba(0,0,0,0.2); backdrop-filter: blur(20px); border-top: 1px solid rgba(255,255,255,0.2); 
                   padding: 20px 0; margin-top: auto;">
        <div class="container">
            <div style="text-align: center;">
                <p style="color: #ffffff; font-size: 0.95rem; margin: 0; font-weight: 400;">
                    © 2024 KnowTest. All rights reserved.
                </p>
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
