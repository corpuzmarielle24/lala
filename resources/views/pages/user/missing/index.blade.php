<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Animal</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('loading.png')}}">>
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('pet/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pet/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pet/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('pet/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pet/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('pet/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('pet/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('pet/css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('pet/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('pet/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('pet/css/style.css') }}">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<style>

body {
    font-family: 'Roboto', sans-serif;

}
.animal-detail h1, .animal-detail h2 {
            color: white;
        }
        .animal-description p, .animal-info h4, .animal-info ul li {
            color: white;
        }
        .animal-img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .carousel-item {
            display: flex;
            justify-content: center;
        }

</style>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <header>
        <div class="header-area ">
            <div class="header-top_area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-8">
                            <div class="short_contact_list">
                                <ul>
                                    <li><a href="#">+63 957 2342 945</a></li>
                                    <li><a href="#">Romblon, Philippines</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 ">
                            <div class="social_media_links">
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-3">
                            <div class="logo">
                                <a href="#">

                                </a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a  href="/">home</a></li>
                                        <li><a href="/missing">Missing Pets</a></li>
                                        <li><a href="/report">Report Missing Pet </a></li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>



            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10">
                    <div class="section_title text-center mb-4">
                        <h3>Recent Missing Pets</h3>
                        <p style="font-size: 14px; color: #666;">If you see this pet, please report to us to help make the owner and their pet be together again!</p>
                    </div>
                </div>
            </div>


    <?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "pet";

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM reports WHERE status = 'Missing' AND is_deleted != 1 ORDER BY id"; // Example query, adjust as per your schema

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Extract data from $row
        $pet_id = $row['id'];
        $petName = $row['pet_name'];
        $breed = $row['breed'];
        $gender = $row['gender'];
        $age = $row['age'];
        $lastAddress = $row['last_address'];
        $description = $row['description'];
        $reward = $row['reward'];
        $image1 = $row['image1'];
        $date = $row['created_at'];

?>

<div class="container">
            <div class="row justify-content-center">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
       <div class="col-lg-12 col-md-6 col-sm-8" >
    <div class="card mb-4 shadow-lg">
        <div class="row" style="border-radius: 25px 0 0 25px;">
            <!-- Column 1: Image -->
            <div class="col-md-4" style="padding-bottom:20px;border-radius: 25px 0 0 25px;background: #db4226; background: -moz-linear-gradient(-45deg, #c26426, #d14127); background: -webkit-linear-gradient(-45deg, #c26426, #d14127); background: linear-gradient(135deg, #c26426, #d14127); ">

                    <div class="animal-detail text-center">
                        <h2 style="font-size: 18px; font-weight: 500; letter-spacing: 2px; text-transform: uppercase; color: white;">       <h1 class="mt-4"><span class="badge " style="background-color:#ac2c05">  Reward: ₱ <strong>{{ number_format($reward, 2) }}
                        </strong></span></h1></h2>
                        <img src="{{ asset('uploads/pet/' . $image1) }}" alt="Shiba inu" class="animal-img" style="width: 100%; height: auto; object-fit: cover;">
                    </div>

            </div>
            <!-- Column 2: Information -->
            <div class="col-md-4" style="color:white;background: #7a2b1d; background: -moz-linear-gradient(-45deg, #693e21, #702416); background: -webkit-linear-gradient(-45deg, #5e2e0e, #57160b); background: linear-gradient(135deg, #c96125, #ee8447); ">
                <div class="card-body" >

                    <div class="animal-info" >
                       <p style="color: white"> <i class="fa fa-calendar-check-o"></i> Date Posted: {{ date('F j, Y', strtotime($date)) }}
                    </p>
                        <hr>
                        <h4 class="text-center" style="color:white"><strong>Information</strong></h4>
                        <hr>
                        <div class="animal-title text-center ">
                         </div>
                        <ul class="" style="list-style: none; font-size: 16px;">
                            <li>   <h3 class="mb-0"><span class="badge " style="border-radius:10px;background-color:rgb(255, 255, 255);color:rgb(221, 70, 0)">{{ $breed }}</span></h3>
                            </li>
                            <br>
                            <li><strong class="text-uppercase">Pet Name:</strong> {{ $petName }}</li>
                            <li><strong class="text-uppercase">Gender:</strong> {{ $gender }}</li>
                            <li><strong class="text-uppercase">Age:</strong> {{ $age  }}</li>
                            <li><strong class="text-uppercase">Last Address Seen:</strong>{{ $lastAddress }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Column 3: Description -->
            <div class="col-md-4" style="background: -moz-linear-gradient(-45deg, #693e21, #702416); background: -webkit-linear-gradient(-45deg, #5e2e0e, #57160b); background: linear-gradient(135deg, #cf6016, #cf361b); ">
                <div class="card-body" style=" border-radius: 0 25px 25px 0;">
                    <div class="animal-description px-3">
                        <hr>
                        <h4 class="text-center" style="color: white"><strong>Description</strong></h4>
                        <hr>
                        <p style="font-size: 16px;color:white" >{{ $description }}</p>
                        <a href="/view/{{ $pet_id }}">
                            <button class="btn btn-info btn-block" style="color: white;background-color:rgb(248, 107, 51)">View More</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>


<?php } } ?>




    <!-- footer_start  -->
    <footer class="footer">

        <div class="copy-right_text">
            <div class="container">
                <div class="bordered_1px"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <i class="ti-heart" aria-hidden="true"></i> by PawMonitoring</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer_end  -->


    <!-- JS here -->
    <script src="{{ asset('pet/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('pet/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('pet/js/popper.min.js') }}"></script>
    <script src="{{ asset('pet/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('pet/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('pet/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('pet/js/ajax-form.js') }}"></script>
    <script src="{{ asset('pet/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('pet/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('pet/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('pet/js/scrollIt.js') }}"></script>
    <script src="{{ asset('pet/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('pet/js/wow.min.js') }}"></script>
    <script src="{{ asset('pet/js/nice-select.min.js') }}"></script>
    <script src="{{ asset('pet/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('pet/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('pet/js/plugins.js') }}"></script>
    <script src="{{ asset('pet/js/gijgo.min.js') }}"></script>

    <!--contact js-->
    <script src="{{ asset('pet/js/contact.js') }}"></script>
    <script src="{{ asset('pet/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('pet/js/jquery.form.js') }}"></script>
    <script src="{{ asset('pet/js/jquery.validate.min.js') }}"></script>
    <script src="j{{ asset('pet/s/mail-script.js') }}"></script>

    <script src="{{ asset('pet/js/main.js') }}"></script>
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            disableDaysOfWeek: [0, 0],
        //     icons: {
        //      rightIcon: '<span class="fa fa-caret-down"></span>'
        //  }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }

        });
        var timepicker = $('#timepicker').timepicker({
         format: 'HH.MM'
     });
    </script>
    
</body>

</html>
