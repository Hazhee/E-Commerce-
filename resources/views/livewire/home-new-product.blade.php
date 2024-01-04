<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> New Products </h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                </li>
                @foreach ($categories as $category)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="nav-tab-two" data-bs-toggle="tab" href="#category-{{$category->id}}" type="button" role="tab" aria-controls="tab-two" aria-selected="false">{{$category->name}}</a>
                    </li>
                @endforeach
                
                
            </ul>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($products as $product)
                        <div wire:key="{{$product->id}}" class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a wire:navigate href="{{route('product.details',$product->id)}}">
                                            <img class="default-img" src="storage/{{$product->thambnail}}" alt="" />
                                            <img class="hover-img" src="storage/{{$product->thambnail}}" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <button wire:click='addToWishList({{$product}})' aria-label="Add To Wishlist" class="action-btn"><i class="fi-rs-heart"></i></button>
                                        <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        <button wire:click='productModal({{$product}})' type="button" aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></button>
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
                                        <a wire:navigate href="{{route('category.products', $product->category->id)}}">{{$product->category->name}}</a>
                                    </div>
                                    <h2><a wire:navigate href="{{route('product.details',$product->id)}}">{{$product->name}}</a></h2>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            @php
                                                $ratingAvg = \App\Models\Review::where('product_id', $product->id)->where('status', 1)->avg('rating');
                                            @endphp

                                            @if ($ratingAvg == 0)

                                            @elseif($ratingAvg == 1 || $ratingAvg < 2 )
                                                <div class="product-rating" style="width: 20%"></div>
                                            @elseif($ratingAvg == 2 || $ratingAvg < 3)
                                                <div class="product-rating" style="width: 40%"></div>
                                            @elseif($ratingAvg == 3 || $ratingAvg < 4)
                                                <div class="product-rating" style="width: 60%"></div>
                                            @elseif($ratingAvg == 4 || $ratingAvg < 5)
                                                <div class="product-rating" style="width: 80%"></div>
                                            @elseif($ratingAvg == 5 || $ratingAvg < 5)
                                                <div class="product-rating" style="width: 100%"></div>
                                                
                                            @endif
                                            
                                            {{-- <div class="product-rating" style="width: 90%"></div> --}}
                                        </div>
                                        <span class="font-small ml-5 text-muted"> ({{count($product->reviews)}})</span>
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
                                            <button wire:click='addToCart({{$product}})' type="button" class="add"><i class="fi-rs-shopping-cart mr-5"></i>Add </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    <!--end product card-->
                    
                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab one-->
            @foreach ($categories as $category)
                <div class="tab-pane fade" id="category-{{$category->id}}" role="tabpanel" aria-labelledby="tap-two">
                    <div class="row product-grid-4">
                        {{-- @php
                            $catwiseProduct = App\Models\Product::where('category_id', $category->id)->latest()->get();
                        @endphp --}}
                        @foreach ($category->products as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a wire:navigate href="{{route('product.details',$product->id)}}">
                                                <img class="default-img" src="storage/{{$product->thambnail}}" alt="" />
                                                <img class="hover-img" src="storage/{{$product->thambnail}}" alt="" />
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
                                            <a wire:navigate href="{{route('category.products', $product->category->id)}}">{{$product->category->name}}</a>
                                        </div>
                                        <h2><a wire:navigate href="{{route('product.details',$product->id)}}">{{$product->name}}</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                @php
                                                $ratingAvg = \App\Models\Review::where('product_id', $product->id)->where('status', 1)->avg('rating');
                                                @endphp

                                                @if ($ratingAvg == 0)

                                                @elseif($ratingAvg == 1 || $ratingAvg < 2 )
                                                    <div class="product-rating" style="width: 20%"></div>
                                                @elseif($ratingAvg == 2 || $ratingAvg < 3)
                                                    <div class="product-rating" style="width: 40%"></div>
                                                @elseif($ratingAvg == 3 || $ratingAvg < 4)
                                                    <div class="product-rating" style="width: 60%"></div>
                                                @elseif($ratingAvg == 4 || $ratingAvg < 5)
                                                    <div class="product-rating" style="width: 80%"></div>
                                                @elseif($ratingAvg == 5 || $ratingAvg < 5)
                                                    <div class="product-rating" style="width: 100%"></div>
                                                    
                                                @endif
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{count($product->reviews)}})</span>
                                        </div>
                                        <div>
                                            @if ($product->vender_id)
                                                <span class="font-small text-muted">By <a wire:navigate href="{{route('vendor.details',$product->vendor->id)}}">{{$product->vendor->name}}</a></span>
                                            @else
                                                <span class="font-small text-muted">By <a wire:navigate href="#">Owner</a></span>
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
                                                <button wire:click='addToCart({{$product}})' type="button" class="add"><i class="fi-rs-shopping-cart mr-5"></i>Add </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        
                        <!--end product card-->
                    
                        <!--end product card-->
                    </div>
                    <!--End product-grid-4-->
                </div>
            @endforeach
            
            <!--En tab two-->
           
           
        </div>
        <!--End tab-content-->
    </div>
</section>