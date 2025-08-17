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
    
</head>
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
    <div class="hamburger" onclick="toggleMenu()"></div>
    <ul id="navigation">
        <li><a href="#features">Features</a></li>
        <li><a href="#subs">Subscription</a></li>
        <li><a href="#contactus">Contact Us</a></li>
        <li><a href="#faq">FAQ</a></li>

        @if(Auth::check())
            <li class="button-header margin-left user-dropdown">
                <a href="#" class="user-name">{{ Auth::user()->name }}</a>
                <ul class="dropdown-content">
                    <li><a href="/user/profile">Profile</a></li>
                    <li><a href="/logout">Sign Out</a></li>
                </ul>
            </li>
            <li class="button-header margin-left upload-button">
                <a href="/upload-pdf-form" class="btn">Upload Now</a>
            </li>
        @else
            <li class="button-header">
                <a href="{{ route('login') }}" class="btn3">Sign In</a>
            </li>
            <li class="button-header margin-left">
                <a href="{{ route('register') }}" class="btn">Sign Up</a>
            </li>
        @endif
    </ul>
</nav>

<style>
    /* Dropdown styling */
    .user-dropdown {
        position: relative;
        display: inline-block;
    }

    .user-name {
        cursor: pointer;
        text-decoration: none;
        color: black;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: violet;
        min-width: 100px;
        box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content li {
        padding: 8px 16px;
    }

    .dropdown-content li a {
        color: black;
        text-decoration: none;
        display: block;
    }

    .dropdown-content li a:hover {
        background-color: #ddd;
    }

    /* Show dropdown on hover */
    .user-dropdown:hover .dropdown-content {
        display: block;
    }
    /* Dropdown styling */
.user-dropdown {
    position: relative;
    display: inline-block;
}

.user-name {
    cursor: pointer;
    text-decoration: none;
    color: black;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: violet;
    min-width: 150px; /* Adjusted width */
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    padding: 12px 16px;
    z-index: 1;
}

.user-dropdown:hover .dropdown-content {
    display: block;
}
    /* Responsive Styles */
    @media (max-width: 768px) {
        #navigation {
            display: none; /* Hide navigation by default */
            flex-direction: column; /* Stack items vertically */
            background-color: white; /* Background color for mobile */
            position: absolute;
            width: 100%;
            top: 50px; /* Adjust based on your header */
            left: 0;
            z-index: 1;
        }

        #navigation.show {
            display: flex; /* Show navigation when toggled */
        }

        .hamburger {
            display: block; /* Show hamburger on smaller screens */
        }

        /* Ensure dropdown does not overlap */
        .user-dropdown .dropdown-content {
            position: relative; /* Change from absolute to relative */
        }

        /* Adjust upload button style for mobile */
        .upload-button {
            display: block; /* Ensure upload button is block level */
            margin: 10px 0; /* Add margin for spacing */
        }
    }
</style>

<script>
    function toggleMenu() {
        const nav = document.getElementById('navigation');
        nav.classList.toggle('show');
    }
</script>


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
        <div class="slider-area slider-bg ">
      
            <div class="slider-active">
                
                <!-- Single Slider -->
                <div class="single-slider d-flex align-items-center slider-height ">
                    
                    <div class="container">
                    <div class="container mt-5">
    


                        <div class="row align-items-center justify-content-between">
                      
                            <div class="col-xl-5 col-lg-5 col-md-9 ">
                                <div class="hero__caption">
                                @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif



                                    <span data-animation="fadeInLeft" data-delay=".3s">Powerful AI Integration</span>
                                    <h1 data-animation="fadeInLeft" data-delay=".6s ">Exam and Review AI Generator</h1>
                                    <p data-animation="fadeInLeft" data-delay=".8s">Tool that uses AI to quickly create custom exam questions and review materials from any text, like PDFs or textbooks, helping educators save time and prepare better tests.
                                    backups all in one place.</p>
                                    <!-- Slider btn -->
                                    <div class="slider-btns">
                                        <!-- Hero-btn -->
                                    

                                        @if(Auth::check())
                              <a href="/upload-pdf-form" data-animation="fadeInLeft" data-delay="1s" href="" class="btn radius-btn">get started</a>
                                       @else
                                       <a href="{{ route('login') }}" data-animation="fadeInLeft" data-delay="1s" href="industries.html" class="btn radius-btn">get started</a>
                                           @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="hero__img d-none d-lg-block f-right">
                                    <img src="{{ asset('ai/assets/img/hero/hero_right.png')}}" alt="" data-animation="fadeInRight" data-delay="1s">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>       
            </div>
            <!-- Slider Shape -->
            <div class="slider-shape d-none d-lg-block">
                <img class="slider-shape1" src="a{{ asset('ai/ssets/img/hero/top-left-shape.png')}}" alt="">
            </div>
        </div>
        <!-- Slider Area End -->
        <!-- Domain-search start -->
     
    <!-- Domain-search End -->
    <!--? Team -->
    <section class="team-area section-padding40 section-bg1" id="features">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="section-tittle text-center mb-105">
                        <h2>Most amazing features</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-cat">
                        <div class="cat-icon">
                            <img src="{{ asset('ai/assets/img/icon/services1.svg')}}" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="#">AI-Powered Custom Question Generator</a></h5>
                            <p>Generate personalized exam questions based on user-defined topics and keywords with adjustable difficulty and question types.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-cat">
                        <div class="cat-icon">
                            <img src="{{ asset('ai/assets/img/icon/services2.svg')}}" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="#">Interactive Review Analytics Dashboard</a></h5>
                            <p>Visualize and analyze review data with interactive charts and filters for insights into ratings, feedback themes, and trends.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-cat">
                        <div class="cat-icon">
                            <img src="{{ asset('ai/assets/img/icon/services3.svg')}}" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="#">Real-Time Collaboration and Feedback</a></h5>
                            <p>Enable simultaneous editing, commenting, and discussion for exam creation and review analysis.</p>
                        </div>
                    </div>
                </div>
           
             
            </div>
        </div>
    </section>
    <!-- Services End -->
    <!--? Pricing Card Start -->
    <section class="pricing-card-area fix" id="subs">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8">
                <div class="section-tittle text-center mb-90">
                    <h2>Choose plan which fits for you</h2>
                    <p>KnowTest is designed to streamline the process of creating and managing exams and reviewers. Our intuitive platform empowers educators and learners alike with powerful tools for generating custom exams, providing insightful reviews, and tracking progress efficiently.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @php
                // Fetch the most recent subscription for the authenticated user
                $subscription = DB::table('subscriptions')
                    ->select('subscription_type', 'amount', 'date', 
                             DB::raw('DATE_ADD(date, INTERVAL 1 MONTH) AS expiration'))
                    ->where('user_id', auth()->id())
                    ->whereIn('subscription_type', ['Basic Plan', 'Professional Plan', 'Elite Plan'])
                    ->orderBy('id', 'desc')
                    ->first();

                // Check if there is an active subscription
                $currentDate = now();
                $isExpired = !$subscription || $currentDate->greaterThan($subscription->expiration);

                // Determine the active plan type
                $activePlan = !$isExpired ? $subscription->subscription_type : null;
            @endphp

            <!-- Basic Plan -->
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-10">
                <div class="single-card text-center mb-30 {{ $activePlan == 'Basic Plan' ? 'active-card  text-white' : '' }}">
                    <div class="card-top">
                        <img src="{{ asset('ai/assets/img/icon/price1.svg') }}" alt="">
                        <h4 id="plan1">
                            Basic Plan 
                            @if($activePlan == 'Basic Plan') 
                                <span class="badge bg-success" style="color:white">Active</span>
                            @endif
                        </h4>
                        <p>Starting at</p>
                    </div>
                    <div class="card-mid">
                        <h4>₱50 <span>/ month</span></h4>
                    </div>
                    <div class="card-bottom">
                        <ul>
                            <li>AI-Powered Custom Question Generator: Generate questions based on basic topics and keywords.</li>
                            <li>Standard Review Analytics: View basic review summaries and average ratings.</li>
                            <li>Single-User Access: Limited to one user for exam creation and review analysis.</li>
                        </ul>
                  
                            <form action="{{ route('paypal.create') }}" method="GET">
                                <input type="hidden" name="amount" value="50">
                                <input type="hidden" name="subscription_type" value="Basic Plan">
                                <button type="submit" class="borders-btn">Get Started</button>
                            </form>
              
                    </div>
                </div>
            </div>

            <!-- Professional Plan -->
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-10">
                <div class="single-card text-center mb-30 {{ $activePlan == 'Professional Plan' ? 'active-card  text-white' : '' }}">
                    <div class="card-top">
                        <img src="{{ asset('ai/assets/img/icon/price2.svg') }}" alt="">
                        <h4 id="plan2">
                            Professional Plan 
                            @if($activePlan == 'Professional Plan') 
                                <span class="badge bg-success" style="color:white">Active</span>
                            @endif
                        </h4>
                        <p>Starting at</p>
                    </div>
                    <div class="card-mid">
                        <h4>₱150 <span>/ month</span></h4>
                    </div>
                    <div class="card-bottom">
                        <ul>
                            <li>AI-Powered Custom Question Generator: Advanced question generation with adjustable difficulty and question types.</li>
                            <li>Interactive Review Analytics Dashboard: Access detailed analytics with filters and visualizations.</li>
                            <li>Real-Time Collaboration: Collaborate with up to 5 users on exam creation and review analysis.</li>
                        </ul>
             
                            <form action="{{ route('paypal.create') }}" method="GET">
                                <input type="hidden" name="amount" value="150">
                                <input type="hidden" name="subscription_type" value="Professional Plan">
                                <button type="submit" class="borders-btn">Get Started</button>
                            </form>
                 
                    </div>
                </div>
            </div>

            <!-- Elite Plan -->
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-10">
                <div class="single-card text-center mb-30 {{ $activePlan == 'Elite Plan' ? 'active-card  text-white' : '' }}">
                    <div class="card-top">
                        <img src="{{ asset('ai/assets/img/icon/price3.svg') }}" alt="">
                        <h4 id="plan3">
                            Elite Plan 
                            @if($activePlan == 'Elite Plan') 
                                <span class="badge bg-success" style="color:white">Active</span>
                            @endif
                        </h4>
                        <p>Starting at</p>
                    </div>
                    <div class="card-mid">
                        <h4>₱350 <span>/ month</span></h4>
                    </div>
                    <div class="card-bottom">
                        <ul>
                            <li>AI-Powered Custom Question Generator: Premium features with enhanced customization options.</li>
                            <li>Advanced Review Analytics: In-depth analytics with industry benchmarks and historical comparisons.</li>
                            <li>Real-Time Collaboration: Unlimited user access with advanced collaboration tools and features.</li>
                        </ul>
                  
                            <form action="{{ route('paypal.create') }}" method="GET">
                                <input type="hidden" name="amount" value="350">
                                <input type="hidden" name="subscription_type" value="Elite Plan">
                                <button type="submit" class="borders-btn">Get Started</button>
                            </form>
                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  <br><br>  <br><br>  <br><br>
    <!-- About-1 Area End -->
    <!--? About-2 Area Start -->
    <div class="about-area1 pb-bottom" id="contactus">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-7 col-lg-7 col-md-12">
                    <div class="about-caption about-caption3 mb-50">
                        <!-- Section Tittle -->
                        <div class="section-tittle section-tittle2 mb-30">
                            <h2>Dedicated support</h2>
                        </div>
                        <p class="mb-40">Our dedicated support team is here to provide you with personalized and responsive help whenever you need it. Whether you have questions about our exam and reviewer generator or need technical assistance, our experts are ready to offer tailored solutions and guidance to ensure your success. Enjoy peace of mind knowing that you have access to reliable and efficient support at every step of your journey.</p>
               
                        <a  class="btn"><i class="fas fa-phone-alt"></i>09562738336</a>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-8 col-sm-10">
                    <!-- about-img -->
                    <div class="about-img ">
                        <img src="{{ asset('ai/assets/img/gallery/about2.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About-2 Area End -->
    <!-- ask questions -->
    <section class="ask-questions section-bg1 section-padding30 fix" id="faq">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-9 col-md-10 ">
                    <!-- Section Tittle -->
                    <div class="section-tittle text-center mb-90">
                        <h2>Frequently ask questions</h2>
                        <p>KnowTest revolutionizes the way exams and reviews are created and managed. Our all-in-one platform offers a seamless experience for educators and students, providing advanced tools to streamline exam creation, generate insightful reviews, and monitor performance.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single-question d-flex mb-50">
                        <span> Q.</span>
                        <div class="pera">
                            <h2>How does the AI generator create questions from text?</h2>
                            <p>The AI generator analyzes the text using advanced natural language processing techniques to identify key concepts and generate relevant questions. It utilizes machine learning models trained on vast amounts of data to ensure high-quality question generation.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-question d-flex mb-50">
                        <span> Q.</span>
                        <div class="pera">
                            <h2>Can I customize the types of questions generated?</h2>
                            <p>Yes, the AI generator allows you to specify parameters and preferences to tailor the types of questions generated. You can choose from different question formats and difficulty levels to match your needs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-question d-flex mb-50">
                        <span> Q.</span>
                        <div class="pera">
                            <h2>How accurate are the questions generated by the AI?</h2>
                            <p>The accuracy of the questions depends on the quality of the input text and the configuration settings. The AI models are trained to produce high-quality questions, but it’s always a good practice to review and refine the generated questions to ensure they meet your specific requirements.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-question d-flex mb-50">
                        <span> Q.</span>
                        <div class="pera">
                            <h2>What should I do if I encounter issues with the AI generator?</h2>
                            <p>If you encounter any issues with the AI generator, please contact our dedicated support team. We offer personalized assistance to help resolve any problems and ensure smooth operation of the system.</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- End ask questions -->
    <!--? Testimonial Area Start -->
    {{-- <section class="testimonial-area section-bg1">    
        <div class="container" >   
            <div class="testimonial-wrapper">
                <div class="row align-items-center justify-content-center">
                    <div class=" col-lg-10 col-md-12 col-sm-11">
                        <!-- Testimonial Start -->
                        <div class="h1-testimonial-active">
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center mt-55">
                                <div class="testimonial-caption">
                                    <img src="{{ asset('ai/assets/img/icon/quotes-sign.png')}}" alt="" class="quotes-sign">
                                    <p>Brook presents your services with flexible, convenient and cdpose layouts. You can select your favorite layouts & elements for cular ts with unlimited ustomization possibilities. Pixel-perfect replica;ition of thei designers ijtls intended csents your se.</p>
                                </div>
                                <!-- founder -->
                                <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                    <div class="founder-img">
                                        <img src="{{ asset('ai/assets/img/icon/testimonial.png')}}" alt="">
                                    </div>
                                    <div class="founder-text">
                                        <span>Jacson Miller</span>
                                        <p>Designer @Colorlib</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center mt-55"">
                                <div class="testimonial-caption">
                                    <img src="assets/img/icon/quotes-sign.png" alt="" class="quotes-sign">
                                    <p>Brook presents your services with flexible, convenient and cdpose layouts. You can select your favorite layouts & elements for cular ts with unlimited ustomization possibilities. Pixel-perfect replica;ition of thei designers ijtls intended csents your se.</p>
                                </div>
                                <!-- founder -->
                                <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                    <div class="founder-img">
                                        <img src="{{ asset('ai/assets/img/icon/testimonial.png')}}" alt="">
                                    </div>
                                    <div class="founder-text">
                                        <span>Jacson Miller</span>
                                        <p>Designer @Colorlib</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial End -->
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!--? Testimonial Area End -->
</main>
<footer>
    <div class="footer-wrappr " data-background="{{ asset('ai/assets/img/gallery/footer-bg.png')}}">
        <!-- footer-bottom area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="footer-copy-right text-center">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                  Copyright By KnowTest
                                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </footer>
  <!-- Scroll Up -->
  <div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<!-- JS here -->

<script src="{{ asset('ai/assets/js/vendor/modernizr-3.5.0.min.js')}}"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="{{ asset('ai/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{ asset('ai/assets/js/popper.min.js')}}"></script>
<script src="{{ asset('ai/assets/js/bootstrap.min.js')}}"></script>
<!-- Jquery Mobile Menu -->
<script src="{{ asset('ai/assets/js/jquery.slicknav.min.js')}}"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="{{ asset('ai/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('ai/assets/js/slick.min.js')}}"></script>
<!-- One Page, Animated-HeadLin -->
<script src="{{ asset('ai/assets/js/wow.min.js')}}"></script>
<script src="{{ asset('ai/assets/js/animated.headline.js')}}"></script>
<script src="{{ asset('ai/assets/js/jquery.magnific-popup.js')}}"></script>

<!-- Date Picker -->
<script src="{{ asset('ai/assets/js/gijgo.min.js')}}"></script>

<!-- Video bg -->
<script src="{{ asset('ai/assets/js/jquery.vide.js')}}"></script>

<!-- Nice-select, sticky -->
<script src="{{ asset('ai/assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{ asset('ai/assets/js/jquery.sticky.js')}}"></script>
<!-- Progress -->
<script src="{{ asset('ai/assets/js/jquery.barfiller.js')}}"></script>

<!-- counter , waypoint,Hover Direction -->
<script src="{{ asset('ai/assets/js/jquery.counterup.min.js')}}"></script>
<script src="{{ asset('ai/assets/js/waypoints.min.js')}}"></script>
<script src="{{ asset('ai/assets/js/jquery.countdown.min.js')}}"></script>
<script src="{{ asset('ai/assets/js/hover-direction-snake.min.js')}}"></script>

<!-- contact js -->
<script src="{{ asset('ai/assets/js/contact.js')}}"></script>
<script src="{{ asset('ai/assets/js/jquery.form.js')}}"></script>
<script src="{{ asset('ai/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{ asset('ai/assets/js/mail-script.js')}}"></script>
<script src="{{ asset('ai/assets/js/jquery.ajaxchimp.min.js')}}"></script>

<!-- Jquery Plugins, main Jquery -->	
<script src="{{ asset('ai/assets/js/plugins.js')}}"></script>
<script src="{{ asset('ai/assets/js/main.js')}}"></script>

</body>
</html>