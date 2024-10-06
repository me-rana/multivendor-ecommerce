@extends('layouts.admin.e-commerce.app')
@section('title', 'Settings')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 offse">
                <h1>Setting - <small>Product Per Page</small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{routeHelper('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Product Setting</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

{{-- LOGIN / REG - OPTION --}}
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Shop (Product Per Page)</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8 offset-md-2">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Setting - Product Per Page</h3>
                        </div>
                        <form action="{{ route('admin.setting.product.update') }}" method="post">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6">
                                        <center>
                                            <h5><u>Homepage</u></h5>
                                        </center>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Desktop/PC View</label>
                                            <input
                                                type="number"
                                                name="home_lg"
                                                id=""
                                                min="1"
                                                max="4"
                                                class="form-control"
                                                placeholder="Change WithIn 1-4"
                                                aria-describedby="helpId"
                                                value="{{ $productsetup->home_lg }}"
                                            />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tablet View</label>
                                            <input
                                                type="number"
                                                name="home_md"
                                                id=""
                                                min="1"
                                                max="4"
                                                class="form-control"
                                                placeholder="Change WithIn 1-4"
                                                aria-describedby="helpId"
                                                value="{{ $productsetup->home_md }}"
                                            />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Mobile View</label>
                                            <input
                                                type="number"
                                                name="home_sm"
                                                id=""
                                                min="1"
                                                max="4"
                                                class="form-control"
                                                placeholder="Change WithIn 1-4"
                                                aria-describedby="helpId"
                                                value="{{ $productsetup->home_sm }}"
                                            />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Mini Mobile View</label>
                                            <input
                                                type="number"
                                                name="home_extra_sm"
                                                id=""
                                                min="1"
                                                max="4"
                                                class="form-control"
                                                placeholder="Change WithIn 1-4"
                                                aria-describedby="helpId"
                                                value="{{ $productsetup->home_extra_sm }}"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6">
                                        <center>
                                            <h5><u>Otherpages</u></h5>
                                        </center>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Desktop/PC View</label>
                                            <input
                                                type="number"
                                                name="others_lg"
                                                id=""
                                                min="1"
                                                max="4"
                                                class="form-control"
                                                placeholder="Change WithIn 1-4"
                                                aria-describedby="helpId"
                                                value="{{ $productsetup->others_lg }}"
                                            />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tablet View</label>
                                            <input
                                                type="number"
                                                name="others_md"
                                                id=""
                                                min="1"
                                                max="4"
                                                class="form-control"
                                                placeholder="Change WithIn 1-4"
                                                aria-describedby="helpId"
                                                value="{{ $productsetup->others_md }}"
                                            />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Mobile View</label>
                                            <input
                                                type="number"
                                                name="others_sm"
                                                id=""
                                                min="1"
                                                max="4"
                                                class="form-control"
                                                placeholder="Change WithIn 1-4"
                                                aria-describedby="helpId"
                                                value="{{ $productsetup->others_sm }}"
                                            />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Mini Mobile View</label>
                                            <input
                                                type="number"
                                                name="others_extra_sm"
                                                id=""
                                                min="1"
                                                max="4"
                                                class="form-control"
                                                placeholder="Change WithIn 1-4"
                                                aria-describedby="helpId"
                                                value="{{ $productsetup->others_extra_sm }}"
                                            />
                                        </div>
                                        
                                    </div>

                                    <button type="submit" class="btn btn-success my-3 mx-2">Update Now</button>

                                </div>
                            </div>
                            
                        </form>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection