@extends('layouts.user')

@section('nav')

{{-- @if ($errors->any())

@endif --}}
<nav class="main-header  navbar-expand navbar-white navbar-light " style="padding: 5px !important;z-index: 1">
  <!-- Left navbar links -->
     <div class="row mx-0">
          <div class="col-sm-1">
            <a class="nav-link " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: gray"></i></a>
          </div>

          <div class="col-sm-5">
            <h4 style="font-weight: bold" class="mt-1">Settings</h4>
          </div>

          <div class="col-sm-3">
            <div class="input-group input-group-sm" >



            </div>
          </div>

            {{-- modal --}}
        </div>
     </div>




    <!-- <li class="nav-item d-none d-sm-inline-block">
      <a href="../../index3.html" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li> -->


  <!-- Right navbar links -->

</nav>
@endsection

@section('content')
<style>
 
.text {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 1; /* number of lines to show */
   -webkit-box-orient: vertical;
}

.container {
  display: flex;
      border-radius: 5px;
    
      padding-left: 80px;
      padding-right: 80px;
      width: 70%; /* Set the desired width */
      margin: auto; /* Center the container */
    }

    .form-column {
      flex: 1;
    }

    .image-column {
      flex: 1;
    }

    .img2 {
      width: 100%;
      height: 100%;
      object-fit: cover; /* Maintain aspect ratio and cover the container */
    }

    input[type=text], select {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type=submit] {
      width: 100%;
      background-color: #04AA6D;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type=submit]:hover {
      background-color: #45a049;
    }
  </style>
<div class="container-fluid">
  @if (session('success'))
      <div class="alert alert-success">
        {{session('success')}}
      </div>
  @endif

        </div>
</div>
{{--  --}}
<br>
<div class="container" style="display: flex;">
  <div class="form-column" style="border: 1px solid #ccc; padding: 15px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
    <form action="/user/settings/{{auth()->user()->id}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      @foreach($users as $user)

      <label for="first_name">First Name</label>
      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{$user->first_name}}" readonly>

      <label for="last_name">Last Name</label>
      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{$user->last_name}}" readonly>


        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{$user->username}}" required>
    
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      @endforeach
      <br>
      
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
  </div>

</div>



</body>
</html>





  </body>
  </html>


  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKOU_JfykYBj4kDS8ryXPSd0kxsygDcGU&libraries=places"></script>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



<script>
   $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>


<script>
  $(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.editbtn', function () {
      var user_id = $(this).data('id');
      $('#editModal').modal('show');


         let updateroutes = "/admin/announcement/"+user_id;
          $("#updateroute").attr("action", updateroutes);


      $.get('/admin/announcement/'+user_id+'/edit', function (data) {
        console.log(data.name);
           $('#title2').val(data.title);
           $('#description2').val(data.description);
           $('#status2').val(data.status);
       });

    });
  });


</script>
{{--  --}}
@endsection

