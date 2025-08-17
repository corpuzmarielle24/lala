@extends('layouts.admin')

@section('nav')

{{-- @if ($errors->any())

@endif --}}
<nav class="main-header  navbar-expand navbar-white navbar-light " style="padding: 5px !important;z-index: 1">

  <div class="row mx-0">
    <div class="col-sm-1">
      <a class="nav-link " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: gray"></i></a>
    </div>

    <div class="col-sm-8">
      <h4 style="font-weight: bold" class="mt-1">Items
      </h4>
    </div>
  </div>


</nav>
@endsection

@section('content')
<style>
    .pac-container {
    background-color: #FFF;
    z-index: 99999;
    position: fixed;
    display: inline-block;
    float: left;
}
.modal{
    z-index: 99999;
}
.modal-backdrop{
    z-index: 10;
}
.text {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 1; /* number of lines to show */
   -webkit-box-orient: vertical;
}
  </style>
<div class="container-fluid">

  <br>
  @if (session('success'))
  <div class="alert alert-success">
    {{session('success')}}
  </div>
@endif
<div class="card p-3">
          <div class="col-12">

              <div class=" card-body table-responsive p-0" style="z-index: -99999">
                <table class="table table-head-fixed text-nowrap table-striped " id="myTable" >
                  <thead class="thead-light">
                    <tr>
                      <th>ID</th>
                      <th>Item Image</th>
                      <th>Item</th>
                      <th>Category</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $i=0
                  @endphp
                    @foreach($order_lists as $user)
                    <tr>
            
                      <td class="align-middle">
                        {{$user ->id}}
                      </td>
                      <td class="align-middle text-wrap">
                        <a href="{{ asset('uploads/food_image/'.$user->image.'') }}" target="_blank">
                            <img src="{{ asset('uploads/food_image/'.$user->image.'') }}" style="height: 80px; width: 120px;" class="card-img-top" alt="...">
                        </a>
                    </td>
                    
                      <td class="align-middle text-wrap" >{{$user ->i_name}}</td>
                      <td class="align-middle text-wrap" >{{$user ->c_name}}</td>
                      <td class="align-middle text-wrap" >{{$user ->quantity}}</td>
                      <td class="align-middle text-wrap" >{{$user ->price}}</td>
                      <td class="align-middle text-wrap" >{{$user ->price * $user ->quantity}}</td>
                  
                   
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
        </div>
</div>
{{--  --}}


       <!-- Modal -->
       <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addModalTitle">Kitchen Information</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" enctype="multipart/form-data" action="/admin/kitchen">
                @csrf
                <div class="container">
                  <div class="row">
                    <div class="col-sm">
                       <label for="">ID Image</label>
                       <input class="form-control mb-1" type="file" name="image" id="image" required>
                    </div>
                 </div>

                <div class="row">
                   <div class="col-sm">
                      <label for="">Name</label>
                      <input class="form-control mb-1" type="text" name="name" id="name" placeholder="Name" required>
                   </div>
                </div>

                <div class="row">
                  <div class="col-sm">
                     <label for="">Address</label>
                    <textarea name="address" id="address" cols="30" rows="2" class="form-control mb-1"  required></textarea>
                  </div>
               </div>

               <div class="row">
                <div class="col-sm">
                   <label for="">Contact No.</label>
                   <input class="form-control mb-1" type="number" name="mobile" id="mobile" placeholder="Contact No." required>
                </div>
             </div>

             <div class="row">
              <div class="col-sm">
                 <label for="">Birthdate</label>
                 <input class="form-control mb-1" type="date" name="birthdate" id="birthdate"  required>
              </div>
           </div>

           <div class="row">
            <div class="col-sm">
               <label for="">Gender</label>
               <select class="form-control" aria-label="Default select example" name="gender" id="gender" required>
                <option class="opt1" value="" disabled selected hidden>Select Gender</option>
                 <option value="Male">Male</option>
                 <option value="Female">Female</option>
            </select>
            </div>
         </div>

         <div class="row">
          <div class="col-sm">
             <label for="">Email</label>
             <input class="form-control mb-1" type="email" name="email" id="email" placeholder="Email"  required>
          </div>
       </div>

       <div class="row">
        <div class="col-sm">
           <label for="">Username</label>
           <input class="form-control mb-1" type="username" name="username" id="username" placeholder="Username"  required>
        </div>
     </div>

     <div class="row">
      <div class="col-sm">
         <label for="">Password</label>
         <input class="form-control mb-1" type="password" name="password" id="password" placeholder="Password"  required>
      </div>
   </div>   
              </div>


         </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add Kitchen</button>
                </div>
                </form>
            </div>
          </div>
    </div>

  </body>
  </html>


  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKOU_JfykYBj4kDS8ryXPSd0kxsygDcGU&libraries=places"></script>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


  
  <script>
    // function myFunction() {
    //   $('#exampleModalScrollable').modal('show');
    // }
    </script>


<script>

  
  $(document).ready(function () {
    $('#myTable').DataTable();

      $('.editbtn').on('click', function () {
console.log('asd');
          $('#editmodal').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function () {
              return $(this).text();
          }).get();

          console.log(data);

          let updateroute = "/admin/kitchen/"+data[0].toString();
          $("#formid").attr("action", updateroute);

   
          $('#name2').val(data[2]);
          $('#address2').val(data[3]);
          $('#mobile2').val(data[4]);
          $('#gender2').val(data[5]);
          $('#birthdate2').val(data[6]);
          $('#email2').val(data[7]);
          $('#username2').val(data[8]);




        //   let valcategory_type2 = data[7].toString();
        //   $('#category_type2 option[value="' + valcategory_type2 +'"]').prop("selected", true);

        //   let valStatus = data[8].toString();
        //   $('#status2 option[value="' + valStatus +'"]').prop("selected", true);

        //   let prof_img_val = "uploads/category/"+data[9].toString();
        //   $('#download_prof_image').prop("href", prof_img_val);





      });


      $(document).on('change', '#sel_type', function (e) {
            e.preventDefault();
            type = $(this).val();
            var element = document.getElementById('category_details');
            element.innerHTML = ""; //empty

            var transfer_from = document.getElementById('transfer_from');
            transfer_from.innerHTML = ""; //empty

            var transfer_to = document.getElementById('transfer_to');
            transfer_to.innerHTML = ""; //empty

            if(type== 2){
                transfer_from.innerHTML = ""; //empty
                transfer_to.innerHTML = ""; //empty
                document.getElementById("account").disabled = false;
                document.getElementById("description").disabled = false;
                element.innerHTML = '<label for="sel_category">Category</label>\
                                <select class="form-select" aria-label="Default select example" name="sel_category" id="sel_category" required>\
                                </select>';


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'get-categories',
                    type:'get',
                    dataType:'json',

                    success:function (response) {
                        console.log(response);
                        // var len = 0;
                        if (response.data != null) {
                            // len = response.data.length;
                            $("#sel_category").empty();
                            $.each(response.data, function (key, item) {
                            $('#sel_category').append('<option class="opt1" value="" disabled selected hidden>Select Category</option>\
                                                       <option value='+item.id+'>'+item.name+'</option>');

                            });

                        }


                    }
                });
            }else if(type== 3) {
                element.innerHTML = "";
                transfer_from.innerHTML = '<label for="sel_transfer_from">Transfer From</label>\
                                <select class="form-select" aria-label="Default select example" name="sel_transfer_from" id="sel_transfer_from" required>\
                                </select>';

                transfer_to.innerHTML = '<label for="sel_transfer_to">Transfer To</label>\
                <select class="form-select" aria-label="Default select example" name="sel_transfer_to" id="sel_transfer_to" required>\
                </select>';

                document.getElementById("account").disabled = true;
                document.getElementById("description").disabled = true;


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'get-bank',
                    type:'get',
                    dataType:'json',

                    success:function (response) {
                        console.log(response);
                        // var len = 0;
                        if (response.data != null) {
                            // len = response.data.length;
                            $("#sel_transfer_from").empty();
                            $("#sel_transfer_to").empty();
                            $.each(response.data, function (key, item) {
                            $('#sel_transfer_from').append('<option class="opt1" value="" disabled selected hidden>Select Transfer From</option>\
                                                       <option value='+item.id+'>'+item.bank_name+'</option>');

                            $('#sel_transfer_to').append('<option class="opt1" value="" disabled selected hidden>Select Transfer To</option>\
                            <option value='+item.id+'>'+item.bank_name+'</option>');

                            });

                        }


                    }
                });


            }else{
               element.innerHTML = "";
               transfer_from.innerHTML = ""; //empty
               transfer_to.innerHTML = ""; //empty
               document.getElementById("account").disabled = false;
                document.getElementById("description").disabled = false;
            }


      });
  });
</script>




{{--  --}}
@endsection

