<div class="category-side col-lg-2.5">
    <div class="hero-categories">
        <ul class="big-cat">
            <li class="components-bg-wo"> 
                <i class="fas fa-bars" style="margin-right:10px;"></i>Categories
            </li>
            {{-- @php
                $t = Request::route()->getName() == 'home' ? 11 : 18;
            @endphp --}}
            @foreach (\App\Models\Category::where('status', true)->orderBy('pos', 'asc')->get() as $category)
                <li class="menu-item">
                    <a href="{{route('category.product', $category->slug)}}">
                        <img src="{{asset('uploads/category/'.$category->cover_photo)}}" alt="">{{$category->name}}
                    </a>
                    @if ($category->sub_categories->count() > 0)
                        <div class="mega-menu">
                            <a href="{{route('category.product', $category->slug)}}">
                                <h6 style="margin-top: 10px; color:black" class="d-inline-block"><b>{{$category->name}}</b></h6>
                                <span style="font-size: 12px; padding: 0px 5px; color: var(--primary_color)">Show All</span>
                            </a>
                            <div class="row">
                               
                                @foreach ($category->sub_categories as $sub_category)
                                    <div class="col-lg-3 pt-3">
                                        <a href="{{route('subCategory.product', $sub_category->slug)}}"><h3> {{ $sub_category->name }}</h3></a>
                                        <hr style="margin: 0px 0px">
                                        <ul>
                                            @foreach ($sub_category->miniCategory->where('status', true) as $miniCategory)
                                                <li style="margin-left: -20px">
                                                    <a href="{{route('miniCategory.product', $miniCategory->slug)}}">
                                                        {{$miniCategory->name}}
                                                    </a>
                                                    @if ($miniCategory->extraCategory->count() > 0)
                                                        <ul>
                                                            @foreach ($miniCategory->extraCategory as $extraCategory)
                                                                <li style="margin-left: -20px">
                                                                    <a href="{{route('extraCategory.product', $extraCategory->slug)}}">
                                                                        {{$extraCategory->name}}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
