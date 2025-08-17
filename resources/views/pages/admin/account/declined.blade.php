@extends('layouts.admin')

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
            <h4 style="font-weight: bold" class="mt-1">Pending Accounts</h4>
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
                      <th>ID Image</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Contact No.</th>
                      <th>Gender</th>
                      <th>Birthdate</th>
                      <th>Email</th>

                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $i=0
                  @endphp
                    @foreach($users as $user)
                    <tr>
          
                      <td class="align-middle">
                        {{$user ->id}}
                      </td>
                      <td class="align-middle text-wrap">
                        <a href="{{ asset('uploads/id_image/'.$user->id_image.'') }}" target="_blank">
                            <img src="{{ asset('uploads/id_image/'.$user->id_image.'') }}" style="height: 80px; width: 120px;" class="card-img-top" alt="...">
                        </a>
                    </td>
                    
                      <td class="align-middle text-wrap" >{{$user ->name}}</td>
                      <td class="align-middle text-wrap" >{{$user ->address}}</td>
                      <td class="align-middle text-wrap" >{{$user ->mobile}}</td>

                      <td class="align-middle text-wrap">{{$user ->gender}}</td>
                      <td class="align-middle text-wrap" >{{$user ->birthdate}}</td>
                      <td class="align-middle text-wrap" >{{$user ->email}}</td>
                
                
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

<div class="modal fade" id="approved-modal" tabindex="-1" role="dialog" aria-labelledby="approved-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="approved-modal-label">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to approved?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a id="approved-link" class="btn btn-success">Approved</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="declined-modal" tabindex="-1" role="dialog" aria-labelledby="declined-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="declined-modal-label">Confirmation</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to declined?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a id="declined-link" class="btn btn-danger">Declined</a>
      </div>
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

      $('.editbtn').on('click', function () {

          $('#editmodal').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function () {
              return $(this).text();
          }).get();

          console.log(data);

          let updateroute = "/bank/"+data[0].toString();
          $("#formid").attr("action", updateroute);

          $('#bank_name2').val(data[1]);
          $('#description2').val(data[2]);
          $('#balance2').val(data[3]);
          $('#acc_no2').val(data[4]);
          $('#contact_person2').val(data[5]);
          $('#phone2').val(data[6]);
          $('#url2').val(data[7]);





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



<script>
  $(document).ready(function () {
      $('#myTable').DataTable({
          responsive: true
      });
  });
</script>
{{--  --}}
@endsection

