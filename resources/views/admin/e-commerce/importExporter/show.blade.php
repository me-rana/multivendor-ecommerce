@extends('layouts.admin.e-commerce.app')

@section('title', 'importExporter Information')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>importExporter Information</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{routeHelper('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">importExporter Product</li>
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
                        importExporter Details
                    </h3>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{routeHelper('import-exporter/'.$importExporter->id.'/edit')}}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>
                    <a href="{{routeHelper('import-exporter')}}" class="btn btn-danger">
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
                        <td>{{$importExporter->name}}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{$importExporter->username}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$importExporter->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$importExporter->phone}}</td>
                    </tr>
         
    
                    <tr>
                        <th>Bank Account</th>
                        <td>{{$importExporter->importExportAccount->bank_account}}</td>
                    </tr>
                    <tr>
                        <th>Bank Name</th>
                        <td>{{$importExporter->importExportAccount->bank_name}}</td>
                    </tr>
                    <tr>
                        <th>Holder Name</th>
                        <td>{{$importExporter->importExportAccount->holder_name}}</td>
                    </tr>
                    <tr>
                        <th>Branch Name</th>
                        <td>{{$importExporter->importExportAccount->branch_name}}</td>
                    </tr>
                    <tr>
                        <th>Routing</th>
                        <td>{{$importExporter->importExportAccount->routing}}</td>
                    </tr>
   
                    <tr>
                        <th>Paypal</th>
                        <td>{{$importExporter->importExportAccount->paypal_account}}</td>
                    </tr>

        
                    <tr>
                        <th>Profile</th>
                        <td>
                            <img src="/uploads/member/{{$importExporter->avatar}}" alt="Profile" width="100px">
                        </td>
                    </tr>
  
                    <tr>
                        <th>Nid Photo</th>
                        <td>
                            <img src="/uploads/importer-exporter/{{$importExporter->importExportAccount->national_id}}" alt="Profile" width="100px">
                        </td>
                    </tr>
                    <tr>
                        <th>Trade Photo</th>
                        <td>
                            <img src="/uploads/importer-exporter/{{$importExporter->importExportAccount->trade_license_file}}" alt="Profile" width="100px">
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