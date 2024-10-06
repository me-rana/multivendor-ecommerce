<div class="main-menu">
    <div class="container">
        <div class="back">
            <i class="fas fa-long-arrow-alt-left"></i> back
        </div>
        <div class="collpase-menu-open" style="display: none;">
            <a id="menu" class="active" href="#">MENU</a>
            <a id="cat" href="#">CATEGORIES</a>
        </div>
        <div class="nav-bar">
            <div class="header-category-wrap">
                <div class="header-category-nav">
                    <span><i class="icofont icofont-navigation-menu"></i></span>
                    Categories
                    <span class="arrow"></span>
                    <section class="hero-area" style="display: ''">
                        <div class="container">
                            <div class="row" id="superCat">
                            </div>
                        </div>
                    </section>
                    
                </div>
                <div id="subCat"></div>
            </div>
            <div class="nav-menus">
                <ul>
                    @if (auth()->check() && auth()->user()->role_id != 1)
                    <li class="authpro" style="display:none">
                        <img src="{{asset('/')}}uploads/member/{{auth()->user()->avatar=='default.png'?'on_53876-5907.avif':auth()->user()->avatar}}"
                            style="width: 50px;height: 50px;border-radius: 50%;margin: auto;">
                        {{auth()->user()->name}}
                    </li>
                    @endif
                    {{-- <li><a href="{{route('home')}}" class="{{Request::is('/') ? 'active':''}}">Home</a></li> --}}
                    @php 
                        $campaign_lists = App\Models\Campaign::where('status',1)->limit(5)->get();
                    @endphp
                
                    @foreach ($campaign_lists as $item)
                        <li>
                            <a href="{{url('campaign/product/'.$item->slug)}}" class="{{Request::is('campaign/product/'.$item->slug) ? 'active':''}}"> {{ $item->name }}
                            </a>
                        </li>
                    @endforeach
                    @php
                        $thrift_shop = App\Models\Category::where(['name' => 'Thrift Shop','status' => 1])->first()
                    @endphp
                    @if($thrift_shop != null)
                        <li>
                            <a href="{{ url('category/'.$thrift_shop->slug) }}" class="{{Request::is('category/'.$thrift_shop->slug) ? 'active':''}}">{{ $thrift_shop->name }}</a>
                        </li>
                    @endif

                    <li><a href="{{route('product.bulkbuy')}}" class="{{Request::is('/shop/bulk-buy') ? 'active':''}}">Bulk Buys</a></li>
                    
                    
                    <!--<li><a href="{{route('product')}}" class="{{Request::is('product*') ? 'active':''}}">All-->
                    <!--        Products</a></li>-->

                    <!--<li><a href="{{route('campaing')}}" class="{{Request::is('campaing') ? 'active':''}}">All Campaigns</a>-->
                    <!--</li>-->
                    <!--<li><a href="{{route('vendors')}}" class="{{Request::is('vendors') ? 'active':''}}">All Shops</a>-->
                    <!--</li>-->

                    <!--<li class="submenu" style="position:relative !important">-->
                    <!--    <a href="{{route('blogs')}}">Blogs</a>-->
                    <!--</li>-->
                    {{-- <li><a href="{{route('track')}}" class="{{Request::is('track*') ? 'active':''}}">Order Track</a>
                    </li> --}}
                    <!-- <li><a href="{{route('category')}}" class="{{Request::is('category*') ? 'active':''}}">All Category</a></li> -->

                    <li><a href="{{route('contact')}}" class="{{Request::is('contact') ? 'active':''}}">Contact
                            </a></li>
                    <!--  <li><a href="{{route('sheba')}}" class="{{Request::is('sheba') ? 'active':''}}"><i class="icofont icofont-live-support"></i> Sheba</a></li>  -->
                    <!-- <li><a href="{{route('service')}}" class="{{Request::is('service') ? 'active':''}}"><i class="icofont icofont-live-support"></i> Sheba</a></li> -->

                    {{-- @if (auth()->check() && auth()->user()->role_id != 1)
                    <li><a href="{{route('order')}}">Orders</a></li>
                    <li><a href="{{route('wishlist')}}">Wishlist</a></li>
                    <li><a href="{{route('dashboard')}}" class="{{Request::is('dashboard') ? 'active':''}}">My
                            Account</a></li>
                    @endif --}}
{{-- 
                    @if (auth()->check() && auth()->user()->role_id == 1)
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    @else
                    
                    @endif --}}
                    <!--@foreach(App\Models\Page::where('position',0)->where('status',1)->get() as $page)-->
                    <!--<li><a href="{{route('page',['slug'=>$page->name])}}">{{$page->name}}</a></li>-->
                    <!--@endforeach-->
                    <!--@foreach(App\Models\Page::where('position',2)->where('status',1)->get() as $page)-->
                    <!--<li><a href="{{route('page',['slug'=>$page->name])}}">{{$page->name}}</a></li>-->
                    <!--@endforeach-->
                </ul>
            </div>
        </div>
    </div>
</div>