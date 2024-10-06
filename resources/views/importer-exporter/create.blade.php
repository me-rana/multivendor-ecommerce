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


<section class="container">
    <h3 class="text-center">Import/Export Request Form</h3>
    <div class="container bg-light">
        <form action="{{ route('ImportExport.store') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- Laravel's CSRF token -->
    
            <!-- Item Name -->
            <div class="form-group">
                <label for="item_name">Item Name:</label>
                <input type="text" class="form-control @error('item_name') is-invalid @enderror" id="item_name" name="item_name" value="{{ old('item_name') }}" required>
                @error('item_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
    
            <!-- Image Upload -->
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
    
            <!-- URL -->
            <div class="form-group">
                <label for="url">URL:</label>
                <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url') }}" required>
                @error('url')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
    
            <!-- Price -->
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                @error('price')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
    
            <!-- Quantity -->
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
                @error('quantity')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
    
            <!-- Import or Export -->
            <div class="form-group">
                <label>Import or Export:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input @error('import_export') is-invalid @enderror" type="radio" id="import" name="import_export" value="import" {{ old('import_export') == 'import' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="import">Import</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input @error('import_export') is-invalid @enderror" type="radio" id="export" name="import_export" value="export" {{ old('import_export') == 'export' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="export">Export</label>
                </div>
                @error('import_export')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
    
            <!-- Submit Button -->
            <button type="submit" class="btn btn-success btn-block">Submit</button>
        </form>
    </div>
    
</section>
<!-- /.content -->

@endsection

@push('js')
    
@endpush