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
    <script>
        function copyValue() {
            var copyText = document.getElementById("copyInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand("copy");
            alert("Copied the value: " + copyText.value);
        }

        function copyValueX() {
            var copyText = document.getElementById("displayField");
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand("copy");
            alert("Copied the value: " + copyText.value);
        }
    </script>

<script>
    function displayInput() {
        var userInput = document.getElementById('userInput').value;
        var displayField = document.getElementById('displayField');
        displayField.value = userInput + "?invite_key={{ $affiliate->affiliate_key }}";
    }
</script>
    <div style="margin: 20px;">
        
        <form>
            <label for="copyInput">Your Affiliate Link:</label> <br>
            <input class="w-75 py-2 px-3" type="text" id="copyInput" value="http://{{request()->getHttpHost() }}/invite/{{ $affiliate->affiliate_key }}" readonly>
            <button type="button" class="copy-btn" onclick="copyValue()"><i class="fas fa-copy"></i></button>
        </form>

        <h3 class="text-center py-3">Generate Affiliate Link Via Product</h3>

        <form onsubmit="return false;">
            <label for="userInput">Enter Product Link (Details Page Ony)</label> <br>
            <input type="text" id="userInput" class="w-75 py-2 px-3" name="userInput" oninput="displayInput()">
            <br><br>
    
            <label for="displayField">Generated Product Link:</label> <br>
            <input type="text" class="w-75 py-2 px-3" id="displayField" readonly>
            <button type="button" class="copy-btn" onclick="copyValueX()"><i class="fas fa-copy"></i></button>
        </form>
    </div>
    

    
</section>
<!-- /.content -->

@endsection

@push('js')
    
@endpush