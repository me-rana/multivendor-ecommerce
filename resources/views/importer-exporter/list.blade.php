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
    <div class="row justify-content-end">
        <div class="col-md-2 py-2">
            <a href="{{ route('ImportExport.create') }}"><button class="btn btn-outline-dark">Add New Request</button></a>
        </div>
    </div>
    <div
        class="table-responsive"
    >
        <table
            class="table table-light"
        >
            <thead>
                <tr>
                    <th scope="col">ID#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Import/Export</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($importExportItems as $key=>$item)
                    <tr class="">
                        <td scope="row">{{ $key+1 }}</td>
                        <td><img src="{{ asset(($item->image!= null) ? 'uploads/importer-exporter/items/'.$item->image  : 'uploads/importer-exporter/items/default.png') }}" height="50px" width="50px" /></td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->quantity ?? 0}}</td>
                        <td>{{ $item->price ?? 0}}</td>
                        <td>{{ $item->import_export ?? $importer_exporter->importer_exporter}}</td>
                        <td>
                            @if($item->payment_status == 1)
                                <span class="bg-success p-1 rounded" style="color: #fff!important">Paid</span>
                            @else
                                <span class="bg-warning p-1 rounded" style="color: #fff!important">Unpaid</span>
                            @endif
                        </td>

                        <td>
                            @if($item->status == 1)
                                <span class="bg-warning p-1 rounded" style="color: #fff!important">Processing</span>
                            @elseif(($item->status == 2))
                                <span class="bg-warning p-1 rounded" style="color: #fff!important">Ready to Ship</span>
                            @elseif(($item->status == 3))
                                <span class="bg-success p-1 rounded" style="color: #fff!important">Shipped</span>
                            @elseif(($item->status == 4))
                                <span class="bg-success p-1 rounded" style="color: #fff!important">Delivered</span>
                            @elseif(($item->status == 5))
                                <span class="bg-success p-1 rounded" style="color: #fff!important">Cancelled</span>
                            @else
                            <span class="bg-danger p-1 rounded" style="color: #fff!important">Pending</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
             
            </tbody>
        </table>

            {{ $importExportItems->links() }}

    </div>
    
</section>
<!-- /.content -->

@endsection

@push('js')
    
@endpush