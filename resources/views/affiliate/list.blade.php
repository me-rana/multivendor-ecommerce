@extends('layouts.affiliate.app')

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

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$total_affiliate}}</h3>
                    <p>Total Affiliate</p>
                </div>
                <div class="icon">
                    <i class="fas fa-procedures"></i>
                </div>
                {{-- <a href="{{routeHelper('product')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $total_amount }}</h3>
                    <p>Total Amount</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-alt"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $pending_amount }}</h3>
                    <p>Pending Amount</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-alt"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $available_amount }}</h3>
                    <p>Available Amount</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-alt"></i>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container">
    <div
        class="table-responsive"
    >
        <table
            class="table table-light"
        >
            <thead>
                <tr>
                    <th scope="col">Invoice#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($affiliate_list as $item)
                    <tr class="">
                        <td scope="row">{{ $item->invoice }}</td>
                        <td>{{ $item->first_name }}</td>
                        <td>{{ ($item->subtotal * $percentage)/100 }}</td>
                        <td>
                            @if($item->status == 3)
                                <span class="bg-success p-1 rounded" style="color: #fff!important">Approved</span>
                            @else
                                <span class="bg-warning p-1 rounded" style="color: #fff!important">Pending</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
             
            </tbody>
        </table>

            {{ $affiliate_list->links() }}

    </div>
    
</section>
<!-- /.content -->

@endsection

@push('js')
    
@endpush