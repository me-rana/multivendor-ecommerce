@extends('layouts.admin.e-commerce.app')

@section('title')
    @isset($affiliate)
        Edit affiliate 
    @else 
        Add affiliate
    @endisset
@endsection

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
                <h1>
                    @isset($affiliate)
                        Edit affiliate 
                    @else 
                        Add affiliate
                    @endisset
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{routeHelper('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">
                        @isset($affiliate)
                            Edit affiliate 
                        @else 
                            Add affiliate
                        @endisset
                    </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    @if($errors->any())
        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
    @endif
    <div class="card">
        <div class="card-header">
            
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="card-title">
                        @isset($affiliate)
                            Edit affiliate
                        @else 
                            Add New affiliate
                        @endisset
                    </h3>
                </div>
                <div class="col-sm-6 text-right">
                    @isset($affiliate)
                    <a href="{{routeHelper('affiliate/'. $affiliate->id)}}" class="btn btn-info">
                        <i class="fas fa-eye"></i>
                        Show
                    </a>
                    @endisset
                    <a href="{{routeHelper('affiliate')}}" class="btn btn-danger">
                        <i class="fas fa-long-arrow-alt-left"></i>
                        Back to List
                    </a>
                </div>
            </div>
        </div>
        <form action="{{ isset($affiliate) ? routeHelper('affiliate/'. $affiliate->id) : routeHelper('affiliate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @isset($affiliate)
                @method('PUT')
            @endisset
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" placeholder="Write name" class="form-control @error('name') is-invalid @enderror" value="{{ $affiliate->name ?? old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="example@gmail.com" class="form-control @error('email') is-invalid @enderror" value="{{ $affiliate->email ?? old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone" placeholder="write phone number" class="form-control @error('phone') is-invalid @enderror" value="{{ $affiliate->phone ?? old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group col-md-6">
                        <label for="bank_account">Bank Account:</label>
                        <input type="text" name="bank_account" id="bank_account" placeholder="write bank account" class="form-control @error('bank_account') is-invalid @enderror" value="{{ $affiliate->affiliateAccount->bank_account ?? old('bank_account') }}" required>
                        @error('bank_account')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="bank_name">Bank Name:</label>
                        <input type="text" name="bank_name" id="bank_name" placeholder="write bank name" class="form-control @error('bank_name') is-invalid @enderror" value="{{ $affiliate->affiliateAccount->bank_name ?? old('bank_name') }}" required>
                        @error('bank_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="holder_name">Holder Name:</label>
                        <input type="text" name="holder_name" id="holder_name" placeholder="write holder name" class="form-control @error('holder_name') is-invalid @enderror" value="{{ $affiliate->affiliateAccount->holder_name ?? old('holder_name') }}" required>
                        @error('holder_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="branch_name">Branch Name:</label>
                        <input type="text" name="branch_name" id="branch_name" placeholder="write bank branch name" class="form-control @error('branch_name') is-invalid @enderror" value="{{ $affiliate->affiliateAccount->branch_name ?? old('branch_name') }}" required>
                        @error('branch_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="routing">Routing:</label>
                        <input type="text" name="routing" id="routing" placeholder="write routing" class="form-control @error('routing') is-invalid @enderror" value="{{ $affiliate->affiliateAccount->routing ?? old('routing') }}" required>
                        @error('routing')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="commission">Commission(Optional):</label>
                        <input type="number" name="commision" id="commision" placeholder="write commission" class="form-control @error('commision') is-invalid @enderror" value="{{ $affiliate->affiliateAccount->commision ?? old('commision') }}" >
                        @error('commission')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group col-md-6">
                        <label for="commission">Paypal:</label>
                        <input type="text" name="paypal" id="paypal" placeholder="Paypal" class="form-control @error('paypal') is-invalid @enderror" value="{{ $affiliate->affiliateAccount->paypal_account ?? old('paypal') }}" >
                        @error('paypal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group col-md-12">
                        <label for="avatar">Profile Image</label>
                        <input type="file" name="avatar" id="avatar"class="form-control dropify @error('avatar') is-invalid @enderror" @isset($affiliate) data-default-file="{{'/uploads/member/'.$affiliate->avatar ?? ''}}" @endif>
                        @error('avatar')
                            <div class="invalid-feedback text-danger d-block">{{ $message }}</div>
                        @enderror
                </div>

        
 

                    @isset($affiliate)
                    
                    @else
                    <div class="form-group col-md-6">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="********" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password-confirm">Confirm Password:</label>
                        <input type="password" name="password_confirmation" id="password-confirm" placeholder="********" class="form-control" required>
                        
                    </div>
                    @endisset


                </div>
                
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <button class="mt-1 btn btn-primary">
                        @isset($affiliate)
                            <i class="fas fa-arrow-circle-up"></i>
                            Update
                        @else
                            <i class="fas fa-plus-circle"></i>
                            Submit
                        @endisset
                    </button>
                </div>
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
        $(function () {
            $('#avatar').dropify();
        });
    </script>
@endpush