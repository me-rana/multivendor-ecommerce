@extends('layouts.importer-exporter.app')

@section('title', 'Dashboard')

@push('css')
    <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                </ol>
            </div>
            
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $importItems_count }}</h3>
                    <p>Total Requests</p>
                </div>
                <div class="icon">
                    <i class="fas fa-procedures"></i>
                </div>
                {{-- <a href="{{routeHelper('product')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>

        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $importItems_approved_count }}</h3>
                    <p>Approved Requests</p>
                </div>
                <div class="icon">
                    <i class="fas fa-procedures"></i>
                </div>
                {{-- <a href="{{routeHelper('product')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        
       
     
    </div>
</section>
<section class="container">
   
    

    
</section>
<!-- /.content -->

@endsection

@push('js')
    
@endpush