@extends('layouts.admin.e-commerce.app')

@section('title', 'Import Exporter Request List')

@push('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Import Exporter Request List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{routeHelper('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Import Exporter Request List</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="card-title">Import Exporter Requests</h3>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
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
                    <th scope="col">Action</th>
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
                        <td>
                            <a href="{{ route('admin.importExporter.ImportExportListEdit',[$user->id,$item->id]) }}"><button class="btn btn-danger">Edit</button></a>
                        </td>
                    </tr>
                @endforeach
             
            </tbody>
        </table>
        </div>
        <!-- /.card-body -->
    </div>
      <!-- /.card -->    

</section>
<!-- /.content -->

@endsection

@push('js')
    <!-- DataTables  & Plugins -->
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/plugins/jszip/jszip.min.js"></script>
    <script src="/assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function () { 
            $("#example1").DataTable();
            

        })
    </script>
@endpush