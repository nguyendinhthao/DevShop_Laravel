@extends('frontend.layouts.main')
@section('home')
<div class="hero-section hero-background">
    <h1 class="page-title">Tìm kiếm : {{ $keyword }}</h1>
</div>

<!--Navigation section-->
<div class="container">
    <nav class="biolife-nav">
        <ul>

           <li class="nav-item"><span class="current-page"> <h2>Có {{ $totalResult }} sản phẩm với từ khóa: {{ $keyword }}</h2></span></li>
        </ul>
    </nav>
</div>

<div class="page-contain category-page no-sidebar">
    <div class="container">
        <div class="row">

            <!-- Main content -->
            <div id="main-content" class="main-content col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="block-item recently-products-cat md-margin-bottom-39">


                <div class="product-category grid-style">

                    <div id="top-functions-area" class="top-functions-area" >
                        <div class="flt-item to-left group-on-mobile">
                            <span class="flt-title">Refine</span>
                            <a href="#" class="icon-for-mobile">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                            <div class="wrap-selectors">
                                <form action="#" name="frm-refine" method="get">
                                    <span class="title-for-mobile">Refine Products By</span>
                                    <div data-title="Price:" class="selector-item">
                                        <select name="price" class="selector">
                                            <option value="all">Price</option>
                                            <option value="class-1st">Less than 5$</option>
                                            <option value="class-2nd">$5-10$</option>
                                            <option value="class-3rd">$10-20$</option>
                                            <option value="class-4th">$20-45$</option>
                                            <option value="class-5th">$45-100$</option>
                                            <option value="class-6th">$100-150$</option>
                                            <option value="class-7th">More than 150$</option>
                                        </select>
                                    </div>
                                    <div data-title="Brand:" class="selector-item">
                                        <select name="brad" class="selector">
                                            <option value="all">Top brands</option>
                                            <option value="br2">Brand first</option>
                                            <option value="br3">Brand second</option>
                                            <option value="br4">Brand third</option>
                                            <option value="br5">Brand fourth</option>
                                            <option value="br6">Brand fiveth</option>
                                        </select>
                                    </div>
                                    <div data-title="Avalability:" class="selector-item">
                                        <select name="ability" class="selector">
                                            <option value="all">Availability</option>
                                            <option value="vl2">Availability 1</option>
                                            <option value="vl3">Availability 2</option>
                                            <option value="vl4">Availability 3</option>
                                            <option value="vl5">Availability 4</option>
                                            <option value="vl6">Availability 5</option>
                                        </select>
                                    </div>
                                    <p class="btn-for-mobile"><button type="submit" class="btn-submit">Go</button></p>
                                </form>
                            </div>
                        </div>
                        <div class="flt-item to-right">
                            <span class="flt-title">Sort</span>
                            <div class="wrap-selectors">
                                <div class="selector-item orderby-selector">
                                    <select name="orderby" class="orderby" aria-label="Shop order">
                                        <option value=" " selected="selected">Default sorting</option>
                                        <option value="popularity">popularity</option>
                                        <option value="rating">average rating</option>
                                        <option value="date">newness</option>
                                        <option value="price">price: low to high</option>
                                        <option value="price-desc">price: high to low</option>
                                    </select>
                                </div>
                                <div class="selector-item viewmode-selector">
                                    <a href="category-grid-left-sidebar.html" class="viewmode grid-mode active"><i class="biolife-icon icon-grid"></i></a>
                                    <a href="category-list-left-sidebar.html" class="viewmode detail-mode"><i class="biolife-icon icon-list"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <ul class="products-list">

                            @foreach($products as $item)
                            <li class="product-item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                <div class="contain-product layout-default">
                                    <div class="product-thumb">
                                        <a href="{{route('detail-Sanpham',['slug'=>$item->slug])}}" class="link-to-product">

                                            @if ( file_exists($item->image))
                                            <img src="{{asset($item->image)}}" alt="dd"width="270" height="270" class="product-thumnail">
                                            @else
                                            <img src="  {{ asset('upload/404.jpg' )}}" width="270" height="270" class="product-thumnail">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="info">

                                        <h4 class="product-title"><a href="#" class="pr-name">{{ $item->name }}</a></h4>
                                        <div class="price">
                                            <ins><span class="price-amount"><span class="currencySymbol"></span>{{ number_format($item->sale, 0) }} đ</span></ins>
                                            <del><span class="price-amount"><span class="currencySymbol"></span>{{ number_format($item->price, 0) }}</span></del>

                                        </div>

                                        <div class="slide-down-box">

                                            <div class="buttons">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
       {!! $products->appends(['kwd' => $keyword])->links('vendor.pagination.custom') !!}

                    {{--  <div class="biolife-panigations-block">
                        <ul class="panigation-contain">

                            <li><span class="current-page">1</span></li>
                            <li><a href="#" class="link-page">2</a></li>
                            <li><a href="#" class="link-page">3</a></li>
                            <li><span class="sep">....</span></li>
                            <li><a href="#" class="link-page">20</a></li>
                            <li><a href="#" class="link-page next"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>  --}}

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
