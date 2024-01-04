<div>
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">{{$category->name }}</h1>
                        <div class="breadcrumb">
                            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span> {{$category->name}}
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{count($category->products)}}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Show:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">50</a></li>
                                    <li><a href="#">100</a></li>
                                    <li><a href="#">150</a></li>
                                    <li><a href="#">200</a></li>
                                    <li><a href="#">All</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                    <li><a href="#">Release Date</a></li>
                                    <li><a href="#">Avg. Rating</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                    @foreach ($products as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{route('product.details',$product->id)}}">
                                                <img class="default-img" src="{{asset('storage/'.$product->thambnail)}}" alt="" />
                                                <img class="hover-img" src="{{asset('storage/'.$product->thambnail)}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                            <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @php
                                                $amount = $product->price - $product->discount_price;
                                                $discount = ($amount / $product->price) * 100;
                                            @endphp

                                            @if ($product->discount_price)
                                                <span class="hot">{{round($discount)}} %</span>
                                            @else
                                                <span class="new">New</span>
                                            @endif
                                            
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{$product->category->name}}</a>
                                        </div>
                                        <h2><a href="{{route('product.details',$product->id)}}">{{$product->name}}</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            @if ($product->vender_id)
                                                <span class="font-small text-muted">By <a href="vendor-details-1.html">{{$product->vendor->name}}</a></span>
                                            @else
                                                <span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>
                                            @endif
                                        </div>
                                        <div class="product-card-bottom">
                                            @if ($product->discount_price)
                                                <div class="product-price">
                                                    <span>${{$product->discount_price}}</span>
                                                    <span class="old-price">${{$product->price}}</span>
                                                </div>
                                            @else
                                                <div class="product-price">
                                                    <span>${{$product->price}}</span>
                                                </div>
                                            @endif
                                            
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    <!--end product card-->
                </div>
                <!--product grid-->
                <div class="pagination-area mt-20 mb-20">
                    {{$products->links('vendor.livewire.custom')}}
                </div>
                
                <!--End Deals-->

                
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>
                        @foreach ($categories as $item)
                            <li>
                                <a wire:navigate href="{{route('category.products', $item->id)}}"> <img src="{{asset('storage/'.$item->image)}}" alt="" />{{$item->name}}</a><span class="count">{{count($item->products)}}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- Product sidebar Widget -->
                <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                    <h5 class="section-title style-1 mb-30">New products</h5>
                    @foreach ($recently as $item)
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{asset('storage/'.$item->thambnail)}}" alt="#" />
                            </div>
                            <div class="content pt-10">
                                <h5><a wire:navigate href="{{route('product.details',$item->id)}}">{{$item->name}}</a></h5>
                                <p class="price mb-0 mt-5">
                                    @if ($item->discount_price)
                                        ${{$item->discount_price}}
                                    @else
                                        ${{$item->price}}
                                    @endif
                                </p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none">
                    <img src="{{asset('assets/imgs/banner/banner-11.png')}}" alt="" />
                    <div class="banner-text">
                        <span>Oganic</span>
                        <h4>
                            Save 17% <br />
                            on <span class="text-brand">Oganic</span><br />
                            Juice
                        </h4>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
