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
            <h4 style="font-weight: bold" class="mt-1"></h4>
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

            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title flex-grow-1 font-weight-bold"></h3>
              <button type="button" class="btn btn-primary mt-1" data-toggle="modal" data-target="#addModal">
                + Add New Product
              </button>
            </div>
            
              <div class=" card-body table-responsive p-0" style="z-index: -99999">
                <table class="table table-head-fixed text-nowrap table-striped " id="myTable" >
                  <thead class="thead-light">
                    <tr>
                      <th>ID</th>
                      <th>Item Image</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Category</th>
                      <th>Price</th>
                      <th style="display: none">Category ID</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $i=0
                  @endphp
                    @foreach($items as $table)
                    <tr>
          
                      <td class="align-middle">
                        {{$table ->id}}
                      </td>
                      <td class="align-middle text-wrap">
                        <a href="{{ asset('uploads/food_image/'.$table->image.'') }}" target="_blank">
                            <img src="{{ asset('uploads/food_image/'.$table->image.'') }}" style="height: 80px; width: 120px;" class="card-img-top" alt="...">
                        </a>
                    </td>
                    
                      <td class="align-middle text-wrap" >{{$table ->i_name}}</td>
                      <td class="align-middle text-wrap" >{{$table ->description}}</td>
                      <td class="align-middle text-wrap" >{{$table ->name}}</td>
                      <td class="align-middle text-wrap" >{{$table ->price}}</td>
                      <td class="align-middle text-wrap" style="display: none" >{{$table ->c_id}}</td>
                      <td class="align-middle">
                        {{-- update modal --}}
                        <a href="/admin/bom/{{$table ->id}}">  <button  type="button"  class="btn  btn-warning" style="display:inline;"><i class="fa fa-bars"> </i> BOM</button></a>
                      
                        <button type="button" data-id="{{ $table->id }}" class="btn editbtn btn-info"> <i class="fas fa-edit"></i>Edit </button>
                        <form action="/admin/inventory/{{$table ->id }}" method="POST" enctype="multipart/form-data" style="display: inline;" >
                          @csrf
                          @method('PUT')
                          <input type="text" style="display: none;" value="1" name="is_deleted" id="is_deleted">
                          <button onclick="return confirm('Are you sure you want to delete this account?')" type="submit"  class="btn  btn-danger" style="display:inline;"><i class="fa fa-trash"> </i>Delete</button>
                      </form> 
                        <div class="modal fade" id="editmodal" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-bs-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> Update Item </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-bs-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body">
                                      <form action="/admin/inventory/{{$table ->id }}" method="POST" enctype="multipart/form-data" id="formid">
                                      @csrf
                                      @method('PUT')

                                      <div class="container">
                                        <div class="row">
                                          <div class="col-sm">
                                             <label for="">Item Image</label>
                                             <input class="form-control mb-1" type="file" name="image2" id="image2" >
                                          </div>
                                       </div>
                      
                                      <div class="row">
                                         <div class="col-sm">
                                            <label for="">Name</label>
                                            <input class="form-control mb-1" type="text" name="name2" id="name2" placeholder="Name" required>
                                         </div>
                                      </div>
                      
                                      <div class="row">
                                        <div class="col-sm">
                                           <label for="">Description</label>
                                          <textarea name="description2" id="description2" cols="30" rows="2" class="form-control mb-1"  required></textarea>
                                        </div>
                                     </div>
                      
                                     <div class="row">
                                      <div class="col-sm">
                                         <label for="">Select Category</label>
                                         <select class="form-control" aria-label="Default select example" name="category_id2" id="category_id2" required>
                                           <option class="opt1" value="" disabled selected hidden>Select Category</option>
                                           @foreach($categories as $item)
                                            <option value="{{$item->id}} "> {{$item->name}} </option>
                                           @endforeach
                                       </select>
                                      </div>
                                  </div>
                      
                                  <div class="row">
                                    <div class="col-sm">
                                       <label for="">Price</label>
                                       <input class="form-control mb-1" type="number" name="price2" id="price2" placeholder="Price" required>
                                    </div>
                                 </div>
                        
                                    </div>
                      </div>

                             <div class="modal-footer">
                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                               <button type="submit" class="btn btn-primary">Save changes</button>
                             </div>
                             </form>

                            </div>
                        </div>
                   </div>

                        {{-- update modal --}}

                    </td>
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
              <h5 class="modal-title" id="addModalTitle">Item Information</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" enctype="multipart/form-data" action="/admin/inventory">
                @csrf
                <div class="container">
                  <div class="row">
                    <div class="col-sm">
                       <label for="">Item Image</label>
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
                     <label for="">Description</label>
                    <textarea name="description" id="description" cols="30" rows="2" class="form-control mb-1"  required></textarea>
                  </div>
               </div>

               <div class="row">
                <div class="col-sm">
                   <label for="">Select Category</label>
                   <select class="form-control" aria-label="Default select example" name="category_id" id="category_id" required>
                     <option class="opt1" value="" disabled selected hidden>Select Category</option>
                     @foreach($categories as $item)
                      <option value="{{$item->id}} "> {{$item->name}} </option>
                     @endforeach
                 </select>
                </div>
            </div>

            <div class="row">
              <div class="col-sm">
                 <label for="">Price</label>
                 <input class="form-control mb-1" type="number" name="price" id="price" placeholder="Price" required>
              </div>
           </div>
  
  
              </div>


         </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add Item</button>
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

          $('#editmodal').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function () {
              return $(this).text();
          }).get();


          let updateroute = "/admin/inventory/"+data[0].toString();
          $("#formid").attr("action", updateroute);

   
          $('#name2').val(data[2]);
          $('#description2').val(data[3]);
          $('#price2').val(data[5]);

          let valcategory_type2 = parseInt(data[6]); // Convert to integer
$('#category_id2 option').each(function() {
    if (parseInt($(this).val()) === valcategory_type2) {
        $(this).prop("selected", true);
    }
});








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

