<style>@font-face{font-family:muli;src:url('{{asset("/")}}assets/frontend/font/Muli/Muli-VariableFont_wght.ttf');}header .main-menu{z-index:999999;}@media(max-width:750px){.sear_wrapper, #search-view{width:100% !important;}}.goog-te-gadget img {display:none;}.goog-te-banner-frame {display:none;}.VIpgJd-ZVi9od-ORHb-OEVmcd {display:none !important;}</style>
@if(!Request::is('/'))
<style>.products .product .thumbnail {height: 190px !important;}#list-view .product .thumbnail img {width: 200px;}@media(max-width:767px) {#list-view .product .thumbnail img {width: inherit;}#list-view .product h4 {font-size: 17px;font-weight: 1;margin-top: 10px;}#list-view .product .details {margin-left: 15px;}#list-view .product .details .dis-label {display: none;}}</style>
@endif
<link rel="stylesheet" href="{{ asset('/assets/frontend/css/menu.css') }}">


<header class="not-home">
<div class="upper-header" style="">
        <div class="container">
            <div style="display: flex;">
                <div class="dvts" style="flex: 1;">
                    <ul>
                        <li style="color: var(--secondary_color)"><i class="fal fa-phone-alt" aria-hidden="true"></i> Have a question? Call us<a href="tel:{{setting('SITE_INFO_PHONE')}}"> {{setting('SITE_INFO_PHONE')}}</a></li>
                        {{-- <li style="margin-left: 10px;"><a href=""><i class="fal fa-envelope" aria-hidden="true"></i> {{setting('email')}}</a></li> --}}
                    </ul>
                </div>
                <div class="dvts">
                    <ul>
                        @if (auth()->check() && auth()->user()->role_id != 1)
                        <li><a href="{{route('dashboard')}}" class="{{Request::is('dashboard') ? 'active':''}}">My
                                Account</a></li>
                        @endif
                        @auth
                        @if(auth()->user()->role_id == 2)
                        <span
                            style="margin:-2px 5px;height: 15px;display: inline-block;width: 1px;background: var(--optional_color);"></span>
                        <li><a class="vendor-button" href="{{routeHelper('dashboard')}}"> Dashboard</a></li>
                        @endif
                        @endauth
                        @if(auth()->user())
                        <li>
                            <a href="{{route('logout')}}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i
                                    class="icofont icofont-logout"></i> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        
                        @else
                       
                        <li><a href="{{route('registerAffiliate')}}">Affiliate Program</a></li>
                        <span
                        style="margin:-2px 5px;height: 15px;display: inline-block;width: 1px;background: var(--secondary_color);"></span>
                        <li><a href="{{route('registerImportExport')}}">Importer/Exporter</a></li>
                        <span
                        style="margin:-2px 5px;height: 15px;display: inline-block;width: 1px;background: var(--secondary_color);"></span>
                        <li><a href="{{route('login')}}">Sign In</a></li>
                        <span
                            style="margin:-2px 5px;height: 15px;display: inline-block;width: 1px;background: var(--secondary_color);"></span>
                        <li><a href="{{route('register')}}">Sign Up</a></li>
                        
                        <li><a style="border: 1px solid var(--secondary_color);padding: 3px 10px;border-radius: 10px;"
                                href="{{route('vendorJoin')}}">Seller</a></li>
                        
                        
                        @endif
                        <!--<li>-->
                        <!--    <div id="google_translate_element" onclick="foo();"> </div>-->
                        <!--</li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .mobile-menu-openar {
            display: none;
        }
        
    
        .desktop-logo{
            display: none;
        }
        
         .mobile-logo{
            display: none;
        }

@media screen and (min-width: 769px) {
    .desktop-logo{
            display: block;
        }
       
}

/* Show on mobile screens */
@media screen and (max-width: 768px) {
    .mobile-menu-openar {
        display: block;
    }
    .mobile-logo{
        display: block !important;
    }
    
    /* Hide the top-menu on mobile */
    .top-menu {
        display: none;
    }

    /* Show mobile-specific menu if needed */
    .mobi-comp.top-menu {
        display: block;
    }
}
    </style>
    <div class="top-header header_area" style="background: var(--primary_color)">
        <div class="container containe">
             
            <div class="mobile-menu-openar">
                <div class="bars">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
             <div class="wrap mobile-logo" style="width: 30px;"></div>
            <div class="logo-area py-3 px-0 mobile-logo">
                <a href="{{route('home')}}">
                    <img src="{{asset('uploads/setting/'.setting('logo'))}}" alt="Application Logo">
                </a>
            </div>
            
            <div class="mobi-comp top-menu" style="display: none;">
                <ul>
                    <li><a href="{{route('cart')}}"><i class="fal fa-shopping-cart"></i></a></li>
                    @guest
                    <li><a href="{{route('login')}}"><i class="fas fa-user"></i> </a></li>
                    @else
                    
                    @endguest

                    ba
                </ul>
            </div>
         
           <div class="search-box" id="search-box-open" style="flex: 0.4!important">
                <form action="{{route('product.search')}}" method="GET">
                    <div class="input-group">
                        <input style="background:transparent; color: var(--secondary_color);box-shadow: rgba(98, 98, 98, 0.5) 0px 1px 0px 0px;border-radius: 0px" placeholder="Search entires store here...." class="sear" type="search"
                            name="keyword" id="searchbox">
                        <button style="background:transparent; color: var(--secondary_color)" class="input-group-addon" disabled name="go"><i
                                class="icofont icofont-search"></i></button>
                    </div>

                </form>
                <i style="display:none" class="other-search icofont icofont-search"></i>
            </div>
               <div class="wrap" style="width: 30px;"></div>
            <div class="logo-area py-3 px-0 desktop-logo">
                <a href="{{route('home')}}">
                    <img src="{{asset('uploads/setting/'.setting('logo'))}}" alt="Application Logo">
                </a>
            </div>

            <div class="wrap" style="width: 30px;"></div>
            <div class="top-menu">
                <ul>
                    @guest
                    {{-- <li><a href="{{route('login')}}">login</a></li>
                        <li><a href="{{route('register')}}">register</a></li> --}}
                    <li class="d-flex"> <a href="{{route('login')}}" class="d-inline-block"><i class="fal fa-user"></i>  Account</a></li>
                    @else
                    {{-- <li> --}}
                        {{-- <a href="{{route('logout')}}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Log Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form> --}}
                        @if (auth()->check() && auth()->user()->role_id == 1)
                            <li class="d-flex"><a href="{{route('admin.dashboard')}}"><i class="fal fa-user"></i>  Account</a></li>
                        @elseif(auth()->check() && auth()->user()->role_id == 2)
                            <li class="d-flex"><a href="{{route('vendor.dashboard')}}"><i class="fal fa-user"></i>  Account</a></li>
                        @elseif(auth()->check() && auth()->user()->role_id == 4)
                            <li class="d-flex"><a href="{{route('affiliate.dashboard')}}"><i class="fal fa-user"></i>  Account</a></li>
                        @elseif(auth()->check() && auth()->user()->role_id == 5)
                            <li class="d-flex"><a href="{{route('ImportExport.dashboard')}}"><i class="fal fa-user"></i>  Account</a></li>
                        @else
                            <li class="d-flex"><a href="{{route('dashboard')}}"><i class="fal fa-user"></i>  Account</a></li>
                        @endif
                    {{-- </li> --}}
                    @endguest

                    <li class="wishlist-container"><a href="{{route('wishlist')}}"> <i class="fal fa-heart" aria-hidden="true"></i> <sup> <span
                                    id="total-cart-{{-- amount --}}">{{App\Models\wishlist::where('user_id',auth()->id())->count()}}</span></sup></a>
                                    <div class="wishlist-content py-3">
                                        @if(auth()->user() == null)
                                           <p style="display: ruby"> You must <a style="color: var(--primary); padding: 0px; margin: 0px;" href="{{ route('login') }}">Login</a> Or <a style="color: var(--primary); padding: 0px; margin: 0px;" href="{{ route('register') }}">Register</a> to preview wishlists.</p>
                                        @else
                                            @if(App\Models\wishlist::where('user_id',auth()->id())->count() > 0)
                                                <h6 class="mb-3"><strong>My WishList ({{ App\Models\wishlist::where('user_id',auth()->id())->count() }})</strong></h6>
                                                @php
                                                    $wishlistx = App\Models\wishlist::where('user_id',auth()->id())->limit(2)->get();
                                                @endphp
                                                @foreach ($wishlistx as $ikey=>$item)
                                                @php
                                                    $product = App\Models\Product::where('id', $item->product_id)->first();
                                                @endphp
                                                <div class="row">
                                                    <div class="col-2">
                                                        <img style="border: 1px solid rgb(0,0,0,0.1)" src="{{ asset('uploads/product/'.$product->image) }}" height="50px" width="50px" />
                                                    </div>
                                                    <div class="col-8">
                                                        <p><strong>{{ $product->title }}</strong></p>
                                                    </div>
                                                    <div class="col-2">
                                                        <a style="padding: 0px 0px;" href="{{ url('wishlist/remove/'.$item->id) }}"><i style="font-size: 18px" class="fal fa-trash" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                                    <hr>
                                                @endforeach

                                                @if (App\Models\wishlist::where('user_id',auth()->id())->count() >= 2)
                                                    <p><center><a style="color: var(--optional_color); margin:0px;padding:0px;" href="{{ route('wishlist') }}">Show all</a></center></p>
                                                @endif

                                            @else
                                                You have no wishlist yet.
                                            @endif
                                        @endif
                                        
                                    </div>
                    </li>
                    <li class="cartlist-container"><a href="{{route('cart')}}"><i class="fal fa-shopping-basket"></i> <sup> <span
                                    id="total-cart-{{-- amount --}}">{{Cart::count()}}</span></sup> </a>
                                    <div class="cartlist-content py-3">
                                        @if(Cart::count() > 0)
                                                <h6 class="mb-3"><strong>My Carts ({{Cart::count()}})</strong></h6>
                                                @php
                                                   $cartlistx = Cart::content();
                                                @endphp
                                                @foreach ($cartlistx  as $ikey=>$item)
                                           
                                                <div class="row">
                                                    <div class="col-2">
                                                        <img style="border: 1px solid rgb(0,0,0,0.1)" src="{{ asset('uploads/product/'.$item->options->image) }}" height="50px" width="50px" />
                                                    </div>
                                                    <div class="col-8">
                                                        <p><strong>{{ $item->name }}</strong></p>
                                                    </div>
                                                    <div class="col-2">
                                                        <a style="padding: 0px 0px;" href="{{ url('destroy/cart/'.$item->rowId) }}"><i style="font-size: 18px" class="fal fa-trash" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                                    <hr>
                                                @endforeach

                                               
                                                    <p><center><a style="color: var(--optional_color); margin:0px;padding:0px;" href="{{ route('checkout') }}"><button class="btn btn-primary w-100">Checkout</button></a></center></p>
                                              

                                            @else
                                                You have no wishlist yet.
                                            @endif
                                    </div>            
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
    <div class="menu-overly"></div>


    {{-- Main Menu --}}
    @if (!empty(setting('MAIN_MENU_STYLE')))
    @include('layouts.frontend.partials.partial-part.header_main_menu_' . setting('MAIN_MENU_STYLE'))
    @else
    @include('layouts.frontend.partials.partial-part.header_main_menu_1')
    @endif

</header>

{{-- Header Advance Search - When Click Search icon then automatic this section in top with fixed search bar --}}
@include('layouts.frontend.partials.partial-part.header_advance_search')
<script src="{{ asset('/assets/frontend/js/menu.js') }}"></script>
@push('js')
<script>
    $(window).on('load', function () {
        $('#myModal').modal('show');

    });
    var site_url = "{{ url('/') }}";
    $.ajax({
        url: site_url + "/render/superCat",
        type: "get",
        datatype: "html",
        beforeSend: function () {
            $('.ajax-loading').show();
        },
        success: function (response) {
            var result = $.parseJSON(response);
            $('.ajax-loading').hide();
            $("#superCat").append(result);
            subCat();
        },

    })
    function subCat() {
        var site_url = "{{ url('/') }}";
        $.ajax({
            url: site_url + "/render/subCat",
            type: "get",
            datatype: "html",
            beforeSend: function () {
                $('.ajax-loading').show();
            },
            success: function (response) {
                var result = $.parseJSON(response);
                $('.ajax-loading').hide();
                $("#subCat").append(result);

            },

        })
    }
</script>
@endpush