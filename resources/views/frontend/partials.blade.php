@extends('layouts.frontend.app')


@section('title', 'Order Partials Payment')

@section('content')
<style>
    @media (max-width: 500px) {
        .m-hidec{display:none;}
        h2{
            font-size:20px !important;
        }
        .nl{
            margin:0px !important;
        }
        
    }
</style>
<div class="customar-dashboard">
    <div class="container">
    <div class="row">
        	<div class="customar-menu col-md-3">
               @include('layouts.frontend.partials.userside')
            </div>
            <div class="col-md-9">
                <div class="card" style="padding: 20px;margin-top: 20px;">
                    <form action="{{route('order.pay.create',$order->id)}}" method="post" id="submit" enctype="multipart/form-data">
                        @csrf
                        <div class="form form2 row">
                           	<div class="form-group col-md-4">
                                Total : {{$order->total}}
                            </div>
                            <div class="form-group col-md-4">
                                Partials : {{$sum}}
                            </div>
                            <div class="form-group col-md-4">
                                Due : {{$order->total-$sum}}
                            </div>
                            <img src="{{ asset('/icon/paypal.webp') }}" style="height: 60px; width: 100px;" />
                            
                            <button style="background: #667eea;padding: 10px;border-radius: 10px;" type="submit" class="mt-1 btn btn-primary btn-block">Pay With Paypal</button>
                        </div>
                        
                    </form>
                </div>
                 <div class="col-md-12" style="margin-top:20px">
                <table style="margin-top: 20px;background: white;" class="timetable_sub" id="example1">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Amount</th>
                            <th>Transaction ID</th>
                            <th>Payment Method</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partials as $key => $order)
                        <tr>
                       		<td>{{$key+1}}</td>
                       		<td>{{$order->amount}}</td>
                       		<td>{{$order->transaction_id}}</td>
                       		<td>
                       			@if($order->payment_method=='bk')
                       			Bkash
                       			@elseif($order->payment_method=='ng')
                       			Nagad
                       			@elseif($order->payment_method=='rk')
                       			Rocket
                       			@endif
                       		</td>
                       		<td>
                       			@if($order->status==1)
                                Aprove
                                @elseif($order->status==2)
                                Cancel
                                @else
                                Pending
                                @endif
                       		</td>
                        </tr>  
                        @endforeach
                         
                    </tbody>
                </table>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
    <script>
        $(document).on('change', '#subject', function (e) { 
        	var method = $('#subject').val();
        	var bkash = "{!! setting('bkash') !!}"
        	var nogod = "{!! setting('nagad') !!}"
        	var rocket = "{!! setting('rocket') !!}"
        	var appended = $('#appended');
        	if(method=='bk'){
        	    	$('#phone').show();
        		appended.html(bkash+' - এই নাম্বারে টাকা পাঠিয়ে নিচের ফিল্ডে  Transaction ID টি দিন');
        	}else if(method=='ng'){
        		$('#phone').show();
        		appended.html(bkash+' - এই নাম্বারে টাকা পাঠিয়ে নিচের ফিল্ডে  Transaction ID টি দিন');
        	}else if(method=='rk'){
        			$('#phone').show();
        		appended.html(bkash+' - এই নাম্বারে টাকা পাঠিয়ে নিচের ফিল্ডে  Transaction ID টি দিন');
        	}
        else if(method=='wall'){
        	$('#phone').hide();
        	}
        })
    </script>
@endpush