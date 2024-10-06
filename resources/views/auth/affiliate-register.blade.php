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

    <form class="col-md-6 offset-md-3" action="{{route('registeredAffiliate')}}" method="post" enctype="multipart/form-data">
        @csrf
         <ul class="cc row">
        <li class="col-6" ><a href="{{route('affiliate.login')}}">Affiliate Login</a></li>
        <li class="col-6"   style="background:#32014e;color: white;"><a>Affiliate Register</a></li>
    </ul>
        <div class="form form2 ">
            <div class="row">
            <div class="form-group col-md-12">
                <label for="name">Name <sup style="color: red;">*</sup></label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required />
                @error('name')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="form-group col-md-6">
                <label for="username">Username (unique) <sup style="color: red;">*</sup></label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" required />
                @error('username')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div> --}}
        </div>
            <div class="row">
            <div class="form-group col-md-12">
                <label for="email">Email <sup style="color: red;">*</sup></label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required />
                @error('email')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="form-group col-md-12">
                <label for="address">Address <sup style="color: red;">*</sup></label>
                <input type="address" name="address" id="address" class="form-control @error('address') is-invalid @enderror" required />
                @error('address')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div> --}}
            <div class="form-group col-md-12">
                <label for="password">Phone <sup style="color: red;">*</sup></label>
                <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" required />
                @error('phone')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="form-group col-md-12">
                <label for="" class="form-label">I am a <sup style="color: red;">*</sup></label>
                <select
                    class="form-control"
                    name="seller_role"
                    id=""
                    required
                >
                    <option value="Seller">Seller</option>
                    <option value="Entrepreneur">Entrepreneur</option>
                    <option value="Manufacturer">Manufacturer</option>
                </select>
            </div> --}}
            

             <input type="hidden" value="12345" name="otp" id="otp" class="form-control @error('otp') is-invalid @enderror"  required />
            <!-- <div class="form-group col-md-4">-->

            <!--    <div type="submit" id="otp-send" style="margin-top: 33px" class="btn btn-primary">Send Otp</div>-->
            <!--</div>-->
            <!--<div class="form-group col-md-12">-->
            <!--    <label for="otp">Otp (Check Your Phone) <sup style="color: red;">*</sup></label>-->
            <!--    <input type="number" name="otp" id="otp" class="form-control @error('otp') is-invalid @enderror"  required />-->
            <!--    <p id="sm"></p>-->
            <!--    @error('otp')-->
            <!--        <span class="invalid-feedback" role="alert">{{ $message }}</span>-->
            <!--    @enderror-->
            <!--</div>-->
            </div>
            <div class="row">
            <div class="form-group col-md-6">
                <label for="password">Password <sup style="color: red;">*</sup></label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required />
                @error('password')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="confirm-password">Confirm Password <sup style="color: red;">*</sup></label>
                <input type="password" name="password_confirmation" id="confirm-password" class="form-control" required />
                
            </div>
            {{-- <div class="form-group col-md-6">
                <label for="confirm-password">National ID Card(Front and Back)<sup style="color: red;">*</sup></label>
                <input type="file" name="nid" id="" class="form-control" required />
            </div>

            <div class="form-group col-md-6">
                <label for="confirm-password">Business ID Card (Govt. Issued)<sup style="color: red;">*</sup></label>
                <input type="file" name="trade" id="" class="form-control" required />
            </div> --}}

            {{-- <div class="form-group col-md-6">
                <label for="name">Business Number <sup style="color: red;">*</sup></label>
                <input type="text" name="business_no" id="" class="form-control @error('business_no') is-invalid @enderror" required />
                @error('business_no')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div> --}}

            {{-- <div class="form-group col-md-6">
                <label for="name">Business Card Expiry Date <sup style="color: red;">*</sup></label>
                <input type="date" name="expiry_date" id="" class="form-control @error('expiry_date') is-invalid @enderror" required />
                @error('expiry_date')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div> --}}

            </div>
            <input  class="form-control" type="submit" value="Submit">
        </div>
        
    </form>
    <br>
    <span style="display: block;text-align: center;">Already have an Account? <a href="{{route('affiliate.login')}}">Login (Affiliate)</a></span>
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