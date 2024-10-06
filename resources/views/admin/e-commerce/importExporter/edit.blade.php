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
                <h1>Import Exporter Request</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{routeHelper('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Import Exporter Request</li>
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
                    <h3 class="card-title">Import Exporter Request</h3>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.importExporter.ImportExportItemUpdate') }}" method="POST" enctype="multipart/form-data">
                @csrf <!-- Laravel's CSRF token -->
                
                <input type="hidden" name="hidden_id" value="{{ $importExportItem->id }}">
                <!-- Item Name -->
                <div class="form-group">
                    <label for="item_name">Item Name:</label>
                    <input type="text" class="form-control @error('item_name') is-invalid @enderror" id="item_name" name="item_name" value="{{ $importExportItem->item_name }}" required>
                    @error('item_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
        
                <!-- Image Upload -->
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                    <img src="{{ asset(($importExportItem->image != null) ? 'uploads/importer-exporter/items/'.$importExportItem->image : 'uploads/importer-exporter/items/default.png') }}" height="50px" width="50px" />
                </div>
        
                <!-- URL -->
                <div class="form-group">
                    <label for="url">URL:</label>
                    <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ $importExportItem->url }}" required>
                    @error('url')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
        
                <!-- Price -->
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{  $importExportItem->price }}" required>
                    @error('price')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
        
                <!-- Quantity -->
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ $importExportItem->quantity }}" required>
                    @error('quantity')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
        
                <!-- Import or Export -->
                <div class="form-group">
                    <label>Import or Export:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('import_export') is-invalid @enderror" type="radio" id="import" name="import_export" value="import" {{ $importExportItem->import_export == 'import' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="import">Import</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('import_export') is-invalid @enderror" type="radio" id="export" name="import_export" value="export" {{ $importExportItem->import_export == 'export' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="export">Export</label>
                    </div>
                    @error('import_export')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Payment Status</label>
                    <select
                        class="form-control"
                        name="payment_status"
                        id=""
                    required>
                        <option value="" disabled selected>Select one</option>
                        <option value="0" {{ $importExportItem->payment_status != 1 ? 'selected' : '' }}>Unpaid</option>
                        <option value="1" {{ $importExportItem->payment_status == 1 ? 'selected' : '' }}>Paid</option>

                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Status</label>
                    <select
                        class="form-control"
                        name="status"
                        id=""
                    required>
                        <option value="" disabled selected>Select one</option>
                        <option value="0" {{ ($importExportItem->status == 0 || $importExportItem->payment_status == null) ? 'selected' : '' }}>Pending</option>
                        <option value="1" {{ $importExportItem->status == 1 ? 'selected' : '' }}>Processing</option>
                        <option value="2" {{ $importExportItem->status == 2 ? 'selected' : '' }}>Ready to Ship</option>
                        <option value="3" {{ $importExportItem->status == 3 ? 'selected' : '' }}>Shipped</option>
                        <option value="4" {{ $importExportItem->status == 4 ? 'selected' : '' }}>Delivered</option>
                        <option value="5" {{ $importExportItem->status == 5 ? 'selected' : '' }}>Cancelled</option>

                    </select>
                </div>
                
        
                <!-- Submit Button -->
                <button type="submit" class="btn btn-success btn-block">Submit</button>
            </form>
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