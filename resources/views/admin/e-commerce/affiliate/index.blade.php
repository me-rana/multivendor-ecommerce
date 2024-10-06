@extends('layouts.admin.e-commerce.app')

@section('title', 'Affiliate List')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{  asset('assets/plugins/merana/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{  asset('assets/plugins/merana/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{  asset('assets/plugins/merana/buttons.bootstrap4.min.css') }} ">
@endpush


@push('js')
   <!-- DataTables  & Plugins -->
   <script src="{{  asset('assets/plugins/merana/jquery.dataTables.min.js') }}"></script>
   <script src="{{  asset('assets/plugins/merana/dataTables.bootstrap4.min.js') }}"></script>
   <script src="{{  asset('assets/plugins/merana/dataTables.responsive.min.js') }}"></script>
   <script src="{{  asset('assets/plugins/merana/responsive.bootstrap4.min.js') }}"></script>
   <script src="{{  asset('assets/plugins/merana/dataTables.buttons.min.js') }}"></script>
   <script src="{{  asset('assets/plugins/merana/buttons.bootstrap4.min.js') }}"></script>
   <script src="{{  asset('assets/plugins/merana/jszip.min.js') }}"></script>
   <script src="{{  asset('assets/plugins/merana/pdfmake.min.js') }}"></script>
   <script src="{{  asset('assets/plugins/merana/vfs_fonts.js') }}"></script>
   <script src="{{ asset('assets/plugins/merana/rana/buttons.html5.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/merana/rana/buttons.print.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/merana/rana/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush





@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Affiliate List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{routeHelper('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Affiliate List</li>
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
                    <h3 class="card-title">Affiliate List</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{routeHelper('affiliate/create')}}" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i>
                        Add Affiliate
                    </a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>pending</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($affiliates as $key => $data)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->username}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->phone}}</td>
                        
                            <td>
                                @if ($data->is_approved==1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Disable</span>
                                @endif
                            </td>
                            @php
                                $affiliatex = App\Models\AffiliateAccount::where('user_id',$data->id)->first();
                                $pending_amount = (App\Models\Order::where('affiliate_key', $affiliatex->affiliate_key)->where('status','!=',3)->sum('subtotal') * $affiliatex->commision) / 100 ?? 0;
                                $total_amount = (App\Models\Order::where('affiliate_key', $affiliatex->affiliate_key)->sum('subtotal') * $affiliatex->commision) / 100 ?? 0;
                                $available_amount = $total_amount - $pending_amount;
                            @endphp
                            <td>{{$total_amount ?? 0}}</td> 
                            <td>{{$pending_amount + $available_amount ?? 0}}</td>
                            <td style="position:relative;">
                                @if ($data->is_approved==1)
                                <a title="Disable" href="{{ routeHelper('user/status/'. $data->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-lock-open"></i>
                                </a> 
                                @else
                                <a title="Active" href="{{ routeHelper('user/status/'. $data->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-lock"></i>
                                </a> 
                                @endif
                                {{-- <a href="{{ route('admin.affiliate.product',['vid'=>$data->id]) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-store"></i>
                                </a> --}}
                                <a href="{{ routeHelper('affiliate/'. $data->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ routeHelper('affiliate/'.$data->id.'/edit') }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" data-id="{{$data->id}}" id="deleteData" class="btn btn-danger btn-sm"">
                                    <i class="nav-icon fas fa-trash-alt"></i>
                                </a>
                                <form id="delete-data-form-{{$data->id}}" action="{{ routeHelper('affiliate/'. $data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-info btn-sm mt-2" onclick="action_vn({{$data->id}})">ACTION</button>
                                <div id="action_apply_vn_{{$data->id}}" style="display:none;background:var(--primary_color);padding:7px 10px;position:absolute;bottom:-30px;right:100%;width:90%;border-radius:4px;z-index:9999;">
                                    <a style="color:var(--secondary_color);" href="{{ route('admin.affiliate.change_pass_index', ['id'=>$data->id]) }}">Change Password</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @push('js')<script>function action_vn(data_id){$(`#action_apply_vn_${data_id}`).toggle();}</script>@endpush
                </tbody>
            </table>

            {{ $affiliates->firstItem() }} - {{ $affiliates->lastItem() }} of {{ $affiliates->total() }} results
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    {{-- First Page Button --}}
                    <li class="page-item">
                        <a class="page-link" href="{{ $affiliates->url(1) }}">First</a>
                    </li>
            
                    {{-- Page Numbers --}}
                    @php
                        $totalPages = ceil($affiliates->total() / $affiliates->perPage());
                        $currentPage = $affiliates->currentPage();
                        $middlePage = floor($totalPages / 2);
                    @endphp
            
                    @if ($totalPages > 3)
                        {{-- Immediate two pages before the first page --}}
                        @for ($i = max($currentPage - 2, 2); $i < $currentPage; $i++)
                            <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $affiliates->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
            
                        {{-- Current Page --}}
                        <li class="page-item active">
                            <a class="page-link" href="#">{{ $currentPage }}</a>
                        </li>
            
                        {{-- Immediate two pages after the last page --}}
                        @for ($i = $currentPage + 1; $i <= min($currentPage + 2, $totalPages - 1); $i++)
                            <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $affiliates->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
            
                        {{-- Last Page Button --}}
                        <li class="page-item">
                            <a class="page-link" href="{{ $affiliates->url($totalPages) }}">Last</a>
                        </li>
                    @else
                        {{-- Page Numbers if total pages are less than or equal to 3 --}}
                        @for ($i = 2; $i < $totalPages; $i++)
                            <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $affiliates->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                    @endif
                    @if ($affiliates->nextPageUrl())
                            <li class="page-item">
                                <a class="page-link" href="{{ $affiliates->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">Next</span>
                                </a>
                            </li>
                        @endif
                </ul>
            </nav>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->    

</section>
<!-- /.content -->

@endsection

