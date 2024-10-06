@extends('layouts.admin.e-commerce.app')

@section('title', 'Affiliate Information')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Affiliate Information</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{routeHelper('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Affiliate Product</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="card-title">
                        Affiliate Details
                    </h3>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{routeHelper('affiliate/'.$affiliate->id.'/edit')}}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>
                    <a href="{{routeHelper('affiliate')}}" class="btn btn-danger">
                        <i class="fas fa-long-arrow-alt-left"></i>
                        Back to List
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{$affiliate->name}}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{$affiliate->username}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$affiliate->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$affiliate->phone}}</td>
                    </tr>
                    
       
                    <tr>
                        <th>Bank Account</th>
                        <td>{{$affiliate->affiliateAccount->bank_account}}</td>
                    </tr>
                    <tr>
                        <th>Bank Name</th>
                        <td>{{$affiliate->affiliateAccount->bank_name}}</td>
                    </tr>
                    <tr>
                        <th>Holder Name</th>
                        <td>{{$affiliate->affiliateAccount->holder_name}}</td>
                    </tr>
                    <tr>
                        <th>Branch Name</th>
                        <td>{{$affiliate->affiliateAccount->branch_name}}</td>
                    </tr>
                    <tr>
                        <th>Routing</th>
                        <td>{{$affiliate->affiliateAccount->routing}}</td>
                    </tr>
                    <tr>
                        <th>Paypal</th>
                        <td>{{$affiliate->affiliateAccount->paypal_account}}</td>
                    </tr>

                    <tr>
                        <th>Profile</th>
                        <td>
                            <img src="/uploads/member/{{$affiliate->avatar}}" alt="Profile" width="100px">
                        </td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

</section>
<!-- /.content -->

@endsection