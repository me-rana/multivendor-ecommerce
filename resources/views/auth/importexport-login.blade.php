@extends('layouts.frontend.app')

@section('title', 'Shopping Now')

@section('content')
<style>
    form .form2{
        box-shadow: 0px 0px 5px gainsboro;
padding: 20px;
border-radius: 5px;

    }
</style>
@push('css')
    <style>
        span.select2.select2-container{width: 100% !important}
        .login-box, .register-box {
            width: 450px !important;
        }
        @media (max-width: 576px) {
            .login-box, .register-box {
                margin-top: .5rem;
                width: 90% !important;
            }
        }
            ul.cc li{
            display: inline-block;
text-align: center;
background: var(--primary_color);
padding: 7px;
        }
        ul.cc li a{
            color: white;
            display: block;
        }
        ul.cc{
            padding: 0;
        }
    </style>
@endpush

    <br>

<div class="wrapper">
  <!--   <p style="text-align: center;">
        <a href="{{route('home')}}">
            <img style="width: 120px;padding: 10px 0px;" src="{{asset('uploads/setting/'.setting('auth_logo'))}}" alt="">
        </a>
    </p> -->

    <form class="col-md-6 offset-md-3" action="{{route('ImportExport.login.submit')}}" method="post" enctype="multipart/form-data">
        @csrf
         <ul class="cc row">
        <li class="col-6"  style="background:#32014e;color: white;"><a>Importer/Exporter Login</a></li>
        <li class="col-6"><a href="{{route('registerImportExport')}}">Importer/Exporter Register</a></li>
    </ul>
        <div class="form form2 ">
          
            <div class="row align-items-center justify-content-center">
   
            <div class="form-group col-md-9">
                <label for="password">Phone, Email or Username <sup style="color: red;">*</sup></label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" required />
                @error('username')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-md-9">
                <label for="password">Password <sup style="color: red;">*</sup></label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required />
                @error('password')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

         

            </div>
            <center><input  class="form-control w-75" type="submit" value="Login Now"></center>
        </div>
        
    </form>
    <br>
    <span style="display: block;text-align: center;">Are you new here? <a href="{{route('registerImportExport')}}">Register Now (Importer/Exporter)</a></span>
</div>
<input type="hidden" value="{{ csrf_token() }}" name="cr" id="cr">
@endsection

@push('js')
<script>
   $(document).on('click', '#otp-send', function() {
                
                var number = document.getElementById('phone').value;
                var cr = document.getElementById('cr').value;
                $.ajax({
                    type: 'POST',
                    url: 'register/send-otp',
                    data: {
                        'number': number,
                        '_token': cr,
                    },
                    dataType: "JSON",
                    success: function (response) {
                        $('#sm').html(response);
                   }
                });
            });

</script>

@endpush