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

    <!-- slider_area_start -->
    <div class="contact_anipat anipat_bg_1">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact_text text-center">
                        <div class="section_title text-center">
                            <br><br>
                            <h3>Report Missing Pet</h3>
                            <p>If your pet is missing, we are here to help you find them. Fill out the form below to report your missing pet.</p>
                        </div>
                    </div>
                </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="container ">
                            @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

                            <div class="card">
                                <div class="card-header">
                                    <h2>Pet Information Form</h2>
                                </div>
                                <div class="card-body">
                                    <form action="/report" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <!-- Pet Information -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="pet_name">Pet Name</label>
                                                    <input type="text" class="form-control" name="pet_name" id="pet_name" placeholder="Enter pet name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="breed">Breed</label>
                                                    <input type="text" class="form-control" name="breed" id="breed" placeholder="Enter breed" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="gender">Gender</label>
                                                    <select class="form-control" name="gender" id="gender" required>
                                                        <option class="opt1" value="" disabled selected hidden>Select Gender</option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="gender">Date Type</label>
                                                    <select class="form-control" name="date_type" id="date_type" required>
                                                        <option class="opt1" value="" disabled selected hidden>Select Date Type</option>
                                                        <option>Day</option>
                                                        <option>Month</option>
                                                        <option>Year</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="age">Age</label>
                                                    <input type="number" class="form-control" name="age" id="age" placeholder="Enter age" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lastAddress">Last Address Seen</label>
                                                    <input type="text" class="form-control" name="last_address" id="last_address" placeholder="Enter last address seen" required>
                                                </div>
                                                <div class="form-group">
    <label for="image1">Upload Image 1</label>
    <input type="file" class="form-control-file" name="image1" id="image1" required accept="image/png, image/jpeg">
</div>

<div class="form-group">
    <label for="image2">Upload Image 2</label>
    <input type="file" class="form-control-file" name="image2" id="image2" accept="image/png, image/jpeg">
</div>

<div class="form-group">
    <label for="image3">Upload Image 3</label>
    <input type="file" class="form-control-file" name="image3" id="image3" accept="image/png, image/jpeg">
</div>

<div class="form-group">
    <label for="image4">Upload Image 4</label>
    <input type="file" class="form-control-file" name="image4" id="image4" accept="image/png, image/jpeg">
</div>

<div class="form-group">
    <label for="image5">Upload Image 5</label>
    <input type="file" class="form-control-file" name="image5" id="image5" accept="image/png, image/jpeg">
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const allowedTypes = ['image/jpeg', 'image/png'];

    function validateFiles(input) {
        const files = input.files;
        for (let i = 0; i < files.length; i++) {
            if (!allowedTypes.includes(files[i].type)) {
                alert('Only PNG and JPG files are allowed.');
                input.value = ''; // Clear the input
                return false;
            }
        }
        return true;
    }

    // Get all file inputs
    const fileInputs = document.querySelectorAll('input[type="file"]');

    // Attach event listeners
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            validateFiles(this);
        });
    });

    // Form submission handler
    const form = document.querySelector('form'); // Adjust the selector if your form has a specific id or class
    form.addEventListener('submit', function(event) {
        let valid = true;
        fileInputs.forEach(input => {
            if (!validateFiles(input)) {
                valid = false;
            }
        });
        if (!valid) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});
</script>



                                            </div>
                                            
                                            <!-- Owner Information -->
                                            <div class="col-md-6">
                                            <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="confidential" id="confidential">
                    <label class="form-check-label" for="confidential">Confidential Information?</label>
                </div>

                <!-- Owner Name Input -->
                <div class="form-group">
                    <label for="owner_name">Owner Name</label>
                    <input type="text" class="form-control" name="owner_name" id="owner_name" placeholder="Enter owner name" required>
                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                                                </div>
                                                <div class="form-group">
                                                <label for="phone">Phone Number:</label>
        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone number" required>
        <small id="phoneHelp" class="form-text text-muted">Phone number must start with "09" and be 11 digits long.</small>
   
                                                </div>
                                                <script>
        document.addEventListener('DOMContentLoaded', function() {
            var phoneInput = document.getElementById('phone');

            phoneInput.addEventListener('input', function() {
                // Remove non-digit characters
                var value = phoneInput.value.replace(/\D/g, '');
                
                // Ensure the value starts with '09' and has a maximum length of 11 digits
                if (value.length > 11) {
                    value = value.slice(0, 11);
                }

                if (value.startsWith('09')) {
                    phoneInput.value = value;
                } else {
                    phoneInput.value = '09' + value;
                }
            });

            // Optional: Validate on form submission
            phoneInput.form.addEventListener('submit', function(event) {
                var value = phoneInput.value.replace(/\D/g, '');
                if (value.length !== 11 || !value.startsWith('09')) {
                    event.preventDefault();  // Prevent form submission
                    alert('Phone number must start with "09" and be exactly 11 digits long.');
                }
            });
        });
    </script>
                                                <div class="form-group">
                                                    <label for="reward">Reward</label>
                                                    <input type="number" class="form-control" name="reward" id="reward" placeholder="Enter Reward">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



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
