@extends('layouts.app')

@section('content')
<div class="container-fluid h-100">
    <div class="row no-gutters h-100">
        <!-- Left Column: Logo -->
        <div class="col-md-6 d-flex align-items-center justify-content-center" style="background-color: #ececec; height: 100vh;">
            <img src="{{ asset('ex.png') }}" alt="Logo" class="img-fluid" style="height: auto;">
        </div>

        <!-- Right Column: Form -->
        <div class="col-md-6 d-flex align-items-center justify-content-center" style="background-color: #2D0A32; height: 100vh; padding: 2rem;">
            <div class="card-body w-100" style="color: white; max-width: 500px; margin: auto;">
               
             <center>
                <img src="{{ asset('ban.png') }}" alt="Logo" class="img-fluid" style="max-height: 100px; height: auto;">
          
             </center>
             <br>
                   
                <h4 class="text-center mb-4">Create New Account</h4>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name">Enter your Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Enter your Email Address</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="address">Enter your Address</label>
                        <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="mobile">Enter your Phone Number</label>
                        <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Enter your Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-group text-center mb-0">
                        <button type="submit" class="btn" style="background-color: white; color: #2D0A32;">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
