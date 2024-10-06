<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Invoice</title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
       
    <style>
       

        @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
*{
  margin: 0;
  box-sizing: border-box;
  -webkit-print-color-adjust: exact;
}
body{
  background: #E0E0E0;
  font-family: 'Roboto', sans-serif;
}
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.col-left {
    float: left;
}
.col-right {
    float: right;
}
h1{
  font-size: 1.5em;
  color: #444;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .75em;
  color: #666;
  line-height: 1.2em;
}
a {
    text-decoration: none;
    color: #00a63f;
}

#invoiceholder{
  width:100%;
  height: 100%;
  padding: 50px 0;
}
#invoice{
  position: relative;
  margin: 0 auto;
  width: 700px;
  background: #FFF;
}

[id*='invoice-']{ /* Targets all id with 'col-' */
/*  border-bottom: 1px solid #EEE;*/
  padding: 20px;
}

#invoice-top{border-bottom: 2px solid #7a0f96}
#invoice-mid{min-height: 110px;}
#invoice-bot{ min-height: 240px;}

.logo{
    display: inline-block;
    vertical-align: middle;
    width: 110px;
    overflow: hidden;
}
.info{
    display: inline-block;
    vertical-align: middle;
    margin-left: 20px;
}
.logo img,
.clientlogo img {
    width: 100%;
}
.clientlogo{
    display: inline-block;
    vertical-align: middle;
    width: 50px;
}
.clientinfo {
    display: inline-block;
    vertical-align: middle;
}
.title{
  float: right;
}
.title p{text-align: right;}
#message{margin-bottom: 30px; display: block;}
h2 {
    margin-bottom: 5px;
    color: #444;
}
.col-right td {
    color: #666;
    padding: 5px 8px;
    border: 0;
    font-size: 0.75em;
    border-bottom: 1px solid #eeeeee;
}
.col-right td label {
    margin-left: 5px;
    font-weight: 600;
    color: #444;
}
.cta-group a {
    display: inline-block;
    padding: 7px;
    border-radius: 4px;
    background: rgb(196, 57, 10);
    margin-right: 10px;
    min-width: 100px;
    text-align: center;
    color: #fff;
    font-size: 0.75em;
}
.cta-group .btn-primary {
    background: #00a63f;
}
.cta-group.mobile-btn-group {
    display: none;
}
table{
  width: 100%;
  border-collapse: collapse;
}
td{
    padding: 10px;
    border-bottom: 1px solid #cccaca;
    font-size: 0.70em;
    text-align: left;
}

.tabletitle th {
  border-bottom: 2px solid #ddd;
  text-align: right;
}
.tabletitle th:nth-child(2) {
    text-align: left;
}
th {
    font-size: 0.7em;
    text-align: left;
    padding: 5px 10px;
}
.item{width: 50%;}
.list-item td {
    text-align: right;
}
.list-item td:nth-child(2) {
    text-align: left;
}
.total-row th,
.total-row td {
    text-align: right;
    font-weight: 700;
    font-size: .75em;
    border: 0 none;
}
.table-main {
    
}
footer {
    border-top: 1px solid #eeeeee;;
    padding: 15px 20px;
}

@media screen and (max-width: 767px) {
    h1 {
        font-size: .9em;
    }
    #invoice {
        width: 100%;
    }
    #message {
        margin-bottom: 20px;
    }
    [id*='invoice-'] {
        padding: 20px 10px;
    }
    .logo {
        width: 140px;
    }
    .title {
        float: none;
        display: inline-block;
        vertical-align: middle;
        margin-left: 40px;
    }
    .title p {
        text-align: left;
    }
    .col-left,
    .col-right {
        width: 100%;
    }
    .table {
        margin-top: 20px;
    }
    #table {
        white-space: nowrap;
        overflow: auto;
    }
    td {
        white-space: normal;
    }
    .cta-group {
        text-align: center;
    }
    .cta-group.mobile-btn-group {
        display: block;
        margin-bottom: 20px;
    }
     /*==================== Table ====================*/
    .table-main {
        border: 0 none;
    }  
      .table-main thead {
        border: none;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
      }
      .table-main tr {
        border-bottom: 2px solid #eee;
        display: block;
        margin-bottom: 20px;
      }
      .table-main td {
        font-weight: 700;
        display: block;
        padding-left: 40%;
        max-width: none;
        position: relative;
        border: 1px solid #cccaca;
        text-align: left;
      }
      .table-main td:before {
        /*
        * aria-label has no advantage, it won't be read inside a table
        content: attr(aria-label);
        */
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: normal;
        text-transform: uppercase;
      }
    .total-row th {
        display: none;
    }
    .total-row td {
        text-align: left;
    }
    footer {text-align: center;}
}

    </style>
</head>
<body>
  <div id="invoiceholder">
  <div id="invoice" class="">
    
    <div id="invoice-top">
  <div class="logo"><img src="{{asset('uploads/setting/'.setting('logo'))}}" alt="Logo" /></div>
      <div class="titl">
            <div class="col company-details">
                       
                       <div>Shop Address: {{setting('SITE_INFO_ADDRESS')}}</div>
                        <div>{{setting('SITE_INFO_PHONE')}}</div>
                        <div> {{setting('SITE_INFO_SUPPORT_MAIL')}}</div>
                    </div>
          
        </p>
      </div><!--End Title-->
    </div><!--End InvoiceTop-->


    
    <div id="invoice-mid">   
      <div id="message">
        <h2>Hello {{$order->first_name}},</h2>
        <p>An invoice with invoice number #<span id="invoice_num">{{$order->invoice}}</span></p>
      </div>
       
        <div class="clearfix">
            <div class="col-left">
                <div class="clientinfo">
                     <div class="text-gray-light"></div>
                      
                        
                    <h2 id="supplier">INVOICE TO:.</h2>
                     <p style="line-height: 20px;font-size: 0.75em;">
                        
                       Name: <span id="address">{{$order->first_name}}</span>
                        <br>
                        Address: <span id="city">{{($order->town != null) ? $order->town.',' : ''}} {{($order->district != null) ? $order->town.',' : ''}} {{($order->thana != null) ? $order->thana.',' : ''}} {{$order->address}} </span>
                        <br>
                        Street: <span id="city">{{$order->address}}</span>
                        <br>
                        Email: <span id="country">{{$order->email}}</span><br>
                        Phone: <span id="country">{{$order->phone}}</span><br></p>
                </div>
            </div>
            <div class="col-right">
                <table class="table"> 
                    <tbody>
                     
                      @php
                            $total=0;
                            $ids=[];
                        @endphp
                        @foreach ($order->orderDetails as $key => $item)
                            @if($item->product->user_id==auth()->id())
                               @php
                                    $total+=$item->total_price;
                                @endphp
                            @endif
                           @php
                            $whole=\App\Models\Product::find($item->product_id);
                                     if (!in_array("$whole->user_id", $ids)) {
                                         $ids[]=$whole->user_id;
                                     }
                           @endphp
                        @endforeach
                         <?php
                            $seller_count= sizeof($ids);
                        ?>
                        
                         <tr>
                            <td colspan="2">Invoice  </td>
                            <td> {{$order->invoice}}</td>
                        </tr>  
                         <tr>
                            <td colspan="2">Invoice Date</td>
                            <td>{{date('d M Y', strtotime($order->created_at))}}</td>
                        </tr>
                         <tr>
                            <td colspan="2">Payment Method</td>
                            <td>{{$order->payment_method}}</td>
                        </tr>
                        
                        
                        <tr>
                            <td colspan="2">Sub Total</td>
                            <td>{{$total}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Shipping Charge</td>
                            <td>+{{$order->shipping_charge/$seller_count}}</td>
                        </tr>
                        @php
                          $part=DB::table('multi_order')->where('order_id',$order->id)->where('vendor_id',auth()->id())->sum('partial_pay');
                           $discount=DB::table('multi_order')->where('order_id',$order->id)->where('vendor_id',auth()->id())->sum('discount');
                           @endphp
                        <tr>
                            <td colspan="2">Coupon({{$order->coupon_code}}) </td>
                            <td>-{{number_format($discount, 2, '.', ',')}}</td>
                        </tr>
                         
                                <tr>
                            <td colspan="2">partial pay</td>
                            <td>{{$part}} </td>
                        </tr>
                        
                               
                        <tr>
                            <td colspan="2">Grand Total</td>
                            <td>{{($total+($order->shipping_charge/$seller_count))-$discount}} </td>
                        </tr>
                        
                        <tr>
                            
                           
                           
                        @if($order->pay_staus==null)
                           
                              <td colspan="2">Payment Status  </td>
                            <td>Unpaid</td>
                        @else
                             <td colspan="2">Payment Status  </td>
                            <td>Paid</td>
                        @endif
                        </tr>
                        <tr>
                             @if($order->pay_staus!=null)
                            
                            <td colspan="2">Payment Date  </td>
                            <td>{{$order->pay_date}}</td>
                        @endif
                        </tr>
                         <tr>
                            <td colspan="2">Due</td>
                            <td>{{($total+($order->shipping_charge/$seller_count)-$part)-$discount}} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>       
    </div><!--End Invoice Mid-->
    
    <div id="invoice-bot">
      
      <div id="table">
        <table class="table-main">
         <thead>
                        <tr>
                            <th>SL</th>
                            <th>Product</th>
                            <th>Attribute</th>
                            <th>Color</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
        
       <tbody>
                        @foreach ($order->orderDetails as $key => $item)
                        @if($item->product->user_id==auth()->id())
                        <tr>
                            <td data-label="Serial :" class="tableitem">{{$key+1}}</td>
                            <td data-label="Name :" class="tableitem">{{$item->title}}</td>
                            <td data-label="Attribute :" class="tableitem">
                            <?php  
                               $data= json_decode($item->size);
                                  if($data!=Null && $data!='""' && $data!='[]' && $data!='"\"\""'){
                                foreach($data as $key => $attr){
                                    $value=DB::table('attribute_values')->where('id',$attr)->first();
                                   echo strtoupper($key).':'.$value->name.', ';
                                }}
                            ?>
                            </td>
                            <td data-label="Color :" class="tableitem">{{$item->color}}</td>
                            <td data-label="Quantity :" class="tableitem">{{$item->qty}}</td>
                            <td data-label="Price :" class="tableitem">{{number_format($item->price, 2, '.', ',')}}</td>
                            <td data-label="Subtotal :" class="tableitem">{{number_format($item->price, 2, '.', ',')*$item->qty}}</td>
                        </tr>
                        @endif
                        @endforeach
                        
                    </tbody>
                    
        </table>
      </div><!--End Table-->
      
      
    </div><!--End InvoiceBot-->
  
  </div><!--End Invoice-->
</div><!-- End Invoice Holder-->
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        window.addEventListener("load", function() {
            Popup($('#invoice')[0].outerHTML);
            function Popup(data) 
            {
                window.print();
                return true;
            }
        });
    </script>
  

</body>
</html>