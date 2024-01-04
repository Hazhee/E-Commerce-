<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class=""> Featured Products </h3>      
        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2">
                    <div class="banner-text">
                        <h2 class="mb-100">Bring nature into your home</h2>
                        <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                @foreach ($products as $product)
                                    <div class="product-cart-wrap">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{route('product.details',$product->id)}}">
                                                    <img class="default-img" src="storage/{{$product->thambnail}}" alt="" />
                                                    <img class="hover-img" src="storage/{{$product->thambnail}}" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
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
                                                <a href="{{route('product.details',$product->id)}}">{{$product->category->name}}</a>
                                            </div>
                                            <h2><a href="shop-product-right.html">{{$product->name}}</a></h2>
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
                                            <div class="product-price mt-10">
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
                                            </div>
                                            <div class="sold mt-15 mb-15">
                                                <div class="progress mb-5">
                                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                        </div>
                                    </div>
                                @endforeach
                                
                                <!--End product Wrap-->
                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->                   
                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>