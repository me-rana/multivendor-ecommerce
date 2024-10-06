@extends('layouts.admin.e-commerce.app')

@section('title')
    @isset($affiliate)
        Change Password 
    @else 
        Add Affiliate
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
                        Change Password
                    @else 
                        Add Affiliate
                    @endisset
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{routeHelper('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">
                        @isset($affiliate)
                            Change Password 
                        @else 
                            Add Affiliate
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
                            Change Password
                        @else 
                            Add New Affiliate
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
        <form action="{{ route('admin.affiliate.change_pass', ['id'=>$affiliate->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @isset($affiliate)
                @method('PUT')
            @endisset
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        Name: {{ $affiliate->name ?? old('name') }}<br/>
                        Username: {{ $affiliate->username ?? old('username') }}<br/>
                        Shop Name: {{ $affiliate->shop_info->name ?? old('shop_name') }}<br/>
                        E-mail {{ $affiliate->email ?? old('email') }}<br/>
                        Phone: {{ $affiliate->phone ?? old('phone') }}<br/>
                    </div>
                    
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
                </div>
                
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <button class="mt-1 btn btn-primary">
                        <i class="fas fa-arrow-circle-up"></i>
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card -->
    
</section>
<!-- /.content -->

@endsection