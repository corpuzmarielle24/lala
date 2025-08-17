<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>PawMonitoring</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('food/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('food/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('food/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('food/assets/img/favicons/favicon.ico') }}">
    <meta name="msapplication-TileImage" content="{{ asset('food/assets/img/favicons/mstile-150x150.png') }}">
    <link rel="icon" href="{{ asset('seal.png')}}" type="image/x-icon">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ asset('food/assets/css/theme.css') }}" rel="stylesheet" />

    <script>
      // Function to get the user's location
      function getCurrentLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition);
        } else {
          alert("Geolocation is not supported by this browser.");
        }
      }

      // Function to display the user's location with color style
      function showPosition(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        // Use OpenStreetMap Nominatim for reverse geocoding
        const nominatimApiUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`;

        fetch(nominatimApiUrl)
          .then(response => response.json())
          .then(data => {
            const address = data.display_name;
            document.getElementById("deliverToLocation").innerHTML = `Deliver to: <span style="color: #FFB30E">${address}</span>`;
          })
          .catch(error => console.error("Error fetching address:", error));
      }
    </script>

  </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand d-inline-flex" href="/"><img class="d-inline-block" src="{{ asset('seal.png') }}" style="height: 50px;" alt="logo" /><span class="text-1000 fs-3 fw-bold ms-2 text-gradient">PawMonitoring</span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 my-2 mt-lg-0" id="navbarSupportedContent">
            <div class="mx-auto pt-5 pt-lg-0 d-block d-lg-none d-xl-block">

            </div>
            <form class="d-flex mt-4 mt-lg-0 ms-lg-auto ms-xl-0">

              @if(Auth::check())
              <li class="nav-item dropdown" style="list-style: none;">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white; background-color: #FFB30E;">
                    {{ Auth::user()->username }}
                </a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="/user/orders">Cart</a>
                  <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/user/status">Orders</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout">Sign Out</a>
                </div>
            </li>

          @else
              <li class="nav-item">
                  <a href="{{ route('login') }}" class="nav-link btn btn-white" style="color: white; background-color: #FFB30E;">
                      <i class="fas fa-user me-2"></i>Login
                  </a>
              </li>
          @endif

            </form>
          </div>
        </div>
      </nav>

<section class="m-2 p-5">
  <br><br>
  @if (session('success'))
  <div class="alert alert-success">
    {{session('success')}}
  </div>
@endif



@php
$grandTotal = 0;
@endphp

  <div class=" card-body table-responsive p-0" style="z-index: -99999">
    <table class="table table-head-fixed text-nowrap table-striped " id="myTable" >
      <thead class="thead-light">
        <tr>
          <th>ID</th>
          <th>Method</th>
          <th>Item Image</th>
          <th>Reference</th>
          <th>Total Amount</th>
          <th>Address</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @php
        $i=0
      @endphp
        @foreach($orders as $user)
        <tr>

          <td class="align-middle">
          @php
            $i++
          @endphp
          {{$i}}
          </td>

          <td class="align-middle text-wrap" >{{$user ->method}}</td>
          <td class="align-middle text-wrap">
            @if($user->image)
            <a href="{{ asset('uploads/proof/'.$user->image.'') }}" target="_blank">
                <img src="{{ asset('uploads/proof/'.$user->image.'') }}" style="height: 80px; width: 120px;" class="card-img-top" alt="...">
            </a>
            @endif
        </td>

        <td class="align-middle text-wrap" >{{$user ->reference}}</td>
          <td class="align-middle text-wrap" >{{$user ->total_amount}}</td>
          <td class="align-middle text-wrap" >{{$user ->address}}</td>

          <td class="align-middle text-wrap" >{{$user ->status}}</td>


        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  <br> <br> <br> <br>
</section>
<!-- Order Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="orderModalLabel">Order Now</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <!-- Add your order form fields here -->
              <form action="/user/place-order" method="POST">
                  @csrf
                 <div class="row">
                  <div class="col-sm">
                    <label for="">Total Amount</label>
                    <input type="text" class="form-control" id="total_amount" name="total_amount" value="{{$grandTotal}}" required>
                  </div>
                 </div>

             <div class="row">
    <div class="col-sm">
        <label for="">Select Address</label>
        <select class="form-control" aria-label="Default select example" name="" id="" required>
            <option class="opt1" value="" disabled selected hidden>Select Address</option>
            <option value="Home">Home</option>
            <option value="Other">Other Address</option>
        </select>
    </div>
</div>

<div id="otherAddress" style="display: none;">
  <label for="otherAddressTextarea">Enter Other Address</label>
  <textarea class="form-control" id="address" name="address"></textarea>
</div>


<script>
  document.getElementById('address').addEventListener('change', function () {
      var selectedValue = this.value;
      if (selectedValue === 'Other') {
          document.getElementById('otherAddress').style.display = 'block';
      } else {
          document.getElementById('otherAddress').style.display = 'none';
      }
  });
</script>


<div class="row">
  <div class="col-sm">
      <label for="">Payment Method</label>
      <select class="form-control" aria-label="Default select example" name="method" id="method" required>
          <option class="opt1" value="" disabled selected hidden>Select Payment Method</option>
          <option value="Cash">Cash</option>
          <option value="Gcash">Gcash</option>
      </select>
  </div>
</div>
<br>

<div id="referenceNumber" style="display: none;">
  <center>
  <div class="row">
    <div class="col-sm">
        <img src="{{asset('qr.png')}}" alt="Gcash Image" id="gcashImage" style="display: none; height:400px; width:300px;">
    </div>
</div>
</center>
  <div class="row">
      <div class="col-sm">
          <label for="">Reference No.</label>
          <input type="text" class="form-control" id="reference" name="reference" >
      </div>
  </div>
</div>

<div id="gcashProof" style="display: none;">
  <div class="row">
      <div class="col-sm">
          <label for="">Proof of Transaction</label>
          <input type="file" class="form-control" id="image" name="image" >
      </div>
  </div>
</div>

<script>
  document.getElementById('method').addEventListener('change', function () {
      var selectedValue = this.value;
      if (selectedValue === 'Cash') {
          document.getElementById('referenceNumber').style.display = 'none';
          document.getElementById('gcashProof').style.display = 'none';
          document.getElementById('gcashImage').style.display = 'none';
      } else if (selectedValue === 'Gcash') {
          document.getElementById('referenceNumber').style.display = 'block';
          document.getElementById('gcashProof').style.display = 'block';
          document.getElementById('gcashImage').style.display = 'block';
      }
  });
</script>



<div class="modal-footer">

  <button type="sbumit" class="btn btn-primary">Place Order</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>   <!-- Add more form fields as needed -->
              </form>
          </div>

      </div>
  </div>
</div>

<script>
  $('#orderModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var total = button.data('total');
        $('#orderForm').attr('data-total', total);
    });
</script>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-0 pt-7 bg-1000">

        <div class="container">

          <hr class="text-900" />
          <div class="row">
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2 mb-3">
              <h5 class="lh-lg fw-bold text-white">COMPANY</h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">About Us</a></li>
                <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Team</a></li>
                <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">blog</a></li>
              </ul>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2 col-lg-3 mb-3">
              <h5 class="lh-lg fw-bold text-white">CONTACT</h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Help &amp; Support</a></li>
              </ul>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2 mb-3">
              <h5 class="lh-lg fw-bold text-white">LEGAL</h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Terms &amp; Conditions</a></li>
                <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Refund &amp; Cancellation</a></li>
                <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!">Privacy Policy</a></li>
              </ul>
            </div>
            <div class="col-12 col-md-8 col-lg-6 col-xxl-4">
              <h5 class="lh-lg fw-bold text-500">FOLLOW US</h5>
              <div class="text-start my-3"> <a href="#!">
                  <svg class="svg-inline--fa fa-instagram fa-w-14 fs-2 me-2" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="#BDBDBD" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
                  </svg></a><a href="#!">
                  <svg class="svg-inline--fa fa-facebook fa-w-16 fs-2 mx-2" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="#BDBDBD" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path>
                  </svg></a><a href="#!">
                  <svg class="svg-inline--fa fa-twitter fa-w-16 fs-2 mx-2" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="#BDBDBD" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
                  </svg></a></div>

            </div>
          </div>
          <hr class="border border-800" />
          <div class="row flex-center pb-3">
            <div class="col-md-6 order-0">
              <p class="text-200 text-center text-md-start">All rights Reserved &copy; PawMonitoring, 2024 </p>
            </div>
          </div>
        </div><!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('food/vendors/@popperjs/popper.min.js') }}"></script>
    <script src="{{ asset('food/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('food/vendors/is/is.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('food/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('food/assets/js/theme.js') }}"></script>
    <script src="//code.tidio.co/xgyho6i9ff4do6e0bg7v9gmmfrusealt.js" async></script>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&amp;display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>

      $(document).ready(function () {
        $('#myTable').DataTable();
      });
        </script>

  </body>

</html>
