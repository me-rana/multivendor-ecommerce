@extends('layouts.importer-exporter.app')

@section('title', 'Update Profile')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }
    </style>
@endpush

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>My Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{routeHelper('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">My Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="card-title">My Profile</h3>
                </div>
            </div>
        </div>
        <form action="{{routeHelper('profile/info')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="card-body">

                <div class="row">

                
                        
                           
                    <div class="col-md-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <h4 class="card-title">Basic Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name ?? old('name')}}" placeholder="Name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{$user->username ?? old('username')}}" placeholder="Username" readonly>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email ?? old('email')}}" placeholder="example@gmail.com">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
    
                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" maxlength="25" value="{{$user->phone ?? old('phone')}}" placeholder="Phone Number">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                
                                    <div class="form-group col-md-6">
                                        <label for="bank_account">Bank Account:</label>
                                        <input type="text" name="bank_account" id="bank_account" placeholder="write bank account" class="form-control @error('bank_account') is-invalid @enderror" value="{{ $affiliate->bank_account ?? old('bank_account') }}" required>
                                        @error('bank_account')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="bank_name">Bank Name:</label>
                                        <input type="text" name="bank_name" id="bank_name" placeholder="write bank name" class="form-control @error('bank_name') is-invalid @enderror" value="{{ $affiliate->bank_name ?? old('bank_name') }}" required>
                                        @error('bank_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="holder_name">Holder Name:</label>
                                        <input type="text" name="holder_name" id="holder_name" placeholder="write holder name" class="form-control @error('holder_name') is-invalid @enderror" value="{{ $affiliate->holder_name ?? old('holder_name') }}" required>
                                        @error('holder_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="branch_name">Branch Name:</label>
                                        <input type="text" name="branch_name" id="branch_name" placeholder="write bank branch name" class="form-control @error('branch_name') is-invalid @enderror" value="{{ $affiliate->branch_name ?? old('branch_name') }}" required>
                                        @error('branch_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="routing">Routing:</label>
                                        <input type="text" name="routing" id="routing" placeholder="write routing" class="form-control @error('routing') is-invalid @enderror" value="{{ $affiliate->routing ?? old('routing') }}" required>
                                        @error('routing')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                               
       
                         
                                 <div class="form-group col-md-6">
                                    <label for="mobile">Paypal</label>
                                    <input type="text" name="paypal_account" id="paypal" placeholder="Paypal Account" class="form-control @error('paypal') is-invalid @enderror" value="{{$affiliate->paypal_account ?? old('paypal_account')}}" >
                                    @error('paypal')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                        <label for="avatar">Profile Image</label>
                                        <input type="file" name="avatar" id="avatar"class="form-control dropify @error('avatar') is-invalid @enderror" data-default-file="{{'/uploads/member/'.$user->avatar}}">
                                        @error('avatar')
                                            <div class="invalid-feedback text-danger d-block">{{ $message }}</div>
                                        @enderror
                                </div>
                                
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="mt-1 btn btn-primary">
                        <i class="fas fa-arrow-circle-up"></i>
                        Update
                </button>
            </div>
        </form>
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->

@endsection

@push('js')
    <script src="{{ asset('/assets/plugins/dropify/dropify.min.js') }}"></script>
    <script>
        
        $(document).ready(function() {
            $('.dropify').dropify();
        });

    </script>
@endpush