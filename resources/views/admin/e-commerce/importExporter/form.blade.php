@extends('layouts.admin.e-commerce.app')

@section('title')
    @isset($importExporter)
        Edit Import-Exporter 
    @else 
        Add Import-Exporter
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
                    @isset($importExporter)
                        Edit Import-Exporter 
                    @else 
                        Add Import-Exporter
                    @endisset
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{routeHelper('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">
                        @isset($importExporter)
                            Edit Import-Exporter 
                        @else 
                            Add Import-Exporter
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
                        @isset($importExporter)
                            Edit Import-Exporter
                        @else 
                            Add New Import-Exporter
                        @endisset
                    </h3>
                </div>
                <div class="col-sm-6 text-right">
                    @isset($importExporter)
                    <a href="{{routeHelper('import-exporter/'. $importExporter->id)}}" class="btn btn-info">
                        <i class="fas fa-eye"></i>
                        Show
                    </a>
                    @endisset
                    <a href="{{routeHelper('import-exporter')}}" class="btn btn-danger">
                        <i class="fas fa-long-arrow-alt-left"></i>
                        Back to List
                    </a>
                </div>
            </div>
        </div>
        <form action="{{ isset($importExporter) ? routeHelper('import-exporter/'. $importExporter->id) : routeHelper('import-exporter') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @isset($importExporter)
                @method('PUT')
            @endisset
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" placeholder="Write name" class="form-control @error('name') is-invalid @enderror" value="{{ $importExporter->name ?? old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="example@gmail.com" class="form-control @error('email') is-invalid @enderror" value="{{ $importExporter->email ?? old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone" placeholder="write phone number" class="form-control @error('phone') is-invalid @enderror" value="{{ $importExporter->phone ?? old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
  
  
                    <div class="form-group col-md-6">
                        <label for="bank_account">Bank Account:</label>
                        <input type="text" name="bank_account" id="bank_account" placeholder="write bank account" class="form-control @error('bank_account') is-invalid @enderror" value="{{ $importExporter->importExportAccount->bank_account ?? old('bank_account') }}" required>
                        @error('bank_account')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="bank_name">Bank Name:</label>
                        <input type="text" name="bank_name" id="bank_name" placeholder="write bank name" class="form-control @error('bank_name') is-invalid @enderror" value="{{ $importExporter->importExportAccount->bank_name ?? old('bank_name') }}" required>
                        @error('bank_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="holder_name">Holder Name:</label>
                        <input type="text" name="holder_name" id="holder_name" placeholder="write holder name" class="form-control @error('holder_name') is-invalid @enderror" value="{{ $importExporter->importExportAccount->holder_name ?? old('holder_name') }}" required>
                        @error('holder_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="branch_name">Branch Name:</label>
                        <input type="text" name="branch_name" id="branch_name" placeholder="write bank branch name" class="form-control @error('branch_name') is-invalid @enderror" value="{{ $importExporter->importExportAccount->branch_name ?? old('branch_name') }}" required>
                        @error('branch_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="routing">Routing:</label>
                        <input type="text" name="routing" id="routing" placeholder="write routing" class="form-control @error('routing') is-invalid @enderror" value="{{ $importExporter->importExportAccount->routing ?? old('routing') }}" required>
                        @error('routing')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
  
                    {{-- <div class="form-group col-md-6">
                        <label for="commission">Business No:</label>
                        <input type="text" name="business_no" id="business_no" placeholder="Business No" class="form-control @error('business_no') is-invalid @enderror" value="{{ $importExporter->importExportAccount->business_no ?? old('business_no') }}" >
                        @error('business_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="commission">Expiry Date(Business Identity)</label>
                        <input type="date" name="expiry_date" id="expiry_date" placeholder="" class="form-control @error('expiry_date') is-invalid @enderror" value="{{ $importExporter->importExportAccount->expiry_date ?? old('expiry_date') }}" >
                        @error('expiry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="form-group col-md-6">
                        <label for="commission">Paypal:</label>
                        <input type="text" name="paypal" id="paypal" placeholder="Paypal" class="form-control @error('paypal') is-invalid @enderror" value="{{ $importExporter->importExportAccount->paypal_account ?? old('paypal_account') }}" >
                        @error('paypal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                     <!-- Importer/Exporter -->
            <div class="form-group col-md-6">
                <label for="importer_exporter">Are you an importer or an exporter?</label>
                <select class="form-control" id="importer_exporter" name="importer_exporter" required>
                    <option value="importer" @if($importExporter->importExportAccount->importer_exporter == 'importer') selected @endif>Importer</option>
                    <option value="exporter" @if($importExporter->importExportAccount->importer_exporter == 'exporter') selected @endif>Exporter</option>
                </select>
            </div>
    
            <!-- Import permit question -->
            <div class="form-group col-md-3">
                <label>Do you have an Import permit?</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="permit_yes" name="import_permit" value="yes" @if($importExporter->importExportAccount->import_permit == 'yes') checked @endif>
                    <label class="form-check-label" for="permit_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="permit_no" name="import_permit" value="no" @if($importExporter->importExportAccount->import_permit == 'no') checked @endif>
                    <label class="form-check-label" for="permit_no">No</label>
                </div>
            </div>
    
            <!-- Permit type if yes -->
            <div class="form-group col-md-3" id="permit_details" style="display:none;">
                <label for="permit_type">Type of permit you have:</label>
                <input type="text" class="form-control" id="permit_type" name="permit_type" {{ $importExporter->importExportAccount->permit_type }}>
            </div>
    
    
            <!-- Trade License -->
            <div class="form-group">
                <label>Do you have a Business Licence?</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="trade_lic_yes" name="trade_license" value="yes" @if($importExporter->importExportAccount->trade_license == 'yes') checked @endif>
                    <label class="form-check-label" for="trade_lic_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="trade_lic_no" name="trade_license" value="no" @if($importExporter->importExportAccount->trade_license == 'no') checked @endif>
                    <label class="form-check-label" for="trade_lic_no">No</label>
                </div>
            </div>
    


                    @isset($importExporter)
                    
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
                    <div class="form-group col-md-6">
                        <label for="avatar">Profile:</label>
                        <input type="file" name="avatar" id="avatar" accept="image/*" class="form-control dropify @error('avatar') is-invalid @enderror" data-default-file="@isset($importExporter) /uploads/member/{{$importExporter->avatar}} @enderror">
                        @error('avatar')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
        
                     <div class="form-group col-md-6">
                        <label for="nid">Nid Card:</label>
                        <input type="file" name="nid" id="nid" accept="image/*" class="form-control dropify @error('nid') is-invalid @enderror" data-default-file="@isset($importExporter) /uploads/importer-exporter/{{$importExporter->importExportAccount->nid}}@enderror">
                        @error('nid')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>


                    
                     <div class="form-group col-md-6">
                        <label for="trade">Trade license:</label>
                        <input type="file" name="trade" id="trade" accept="image/*" class="form-control dropify @error('trade') is-invalid @enderror" data-default-file="@isset($importExporter) /uploads/importer-exporter/{{$importExporter->importExportAccount->trade}}@enderror">
                        @error('trade')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <button class="mt-1 btn btn-primary">
                        @isset($importExporter)
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
            $('.dropify').dropify();
        });
    </script>
    <script>
        // Show/hide permit type input if "yes" is selected
        document.querySelectorAll('input[name="import_permit"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('permit_details').style.display = this.value === 'yes' ? 'block' : 'none';
            });
        });
    

    </script>
@endpush