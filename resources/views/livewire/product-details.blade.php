    
    <div>
        
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="shop-grid-right.html">{{$product->category->name}}</a> <span></span> {{$product->name}}
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50 mt-30">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        <figure class="border-radius-10">
                                            <img src="storage/{{$product->thambnail}}" alt="product image" />
                                        </figure>
                                        
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails">
                                        <div><img src="storage/{{$product->thambnail}}" alt="product image" /></div>
                                    </div>
                                </div>
                                <!-- End Gallery -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info pr-30 pl-30">
                                    @if ($product->qty > 0)
                                        <span class="stock-status in-stock"> In stock </span>
                                    @else
                                        <span class="stock-status out-stock"> Out stock </span>
                                    @endif
                                    <h2 style="font-size: 35px; font-weight:bold;" class="title-detail">{{$product->name}}</h2>
                                    <div class="product-detail-rating">
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
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
                                            <span class="font-small ml-5 text-muted"> ({{$ratingCount}} reviews)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        @php
                                            $amount = $product->price - $product->discount_price;
                                            $discount = ($amount / $product->price) * 100;
                                        @endphp
                                        
                                        @if ($product->discount_price)
                                            <div class="product-price primary-color float-left">
                                                <span class="current-price text-brand">${{$product->discount_price}}</span>
                                                <span>
                                                    <span class="save-price font-md color3 ml-15">{{round($discount)}}% Off</span>
                                                    <span class="old-price font-md ml-15">${{$product->price}}</span>
                                                </span>
                                            </div>
                                        @else
                                            <div class="product-price primary-color float-left">
                                                <span class="current-price text-brand">${{$product->price}}</span>
                                                
                                            </div>
                                        @endif
                                        
                                    </div>
                                    <div class="short-desc mb-30">
                                        <p class="font-lg">{{$product->short_desc}}</p>
                                    </div>

                                    @if ($product->size)
                                        <div class="attr-detail attr-size mb-30">
                                            <strong class="mr-10">Size: </strong>
                                            <select name="" class="form-control unicase-form-control" id="size">
                                                <option value="" selected disabled>--Choose Size--</option>
                                                @foreach ($product->size as $size)
                                                    <option value="{{$size}}">{{ucwords($size)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    @if ($product->color)
                                        <div class="attr-detail attr-size mb-30">
                                            <strong class="mr-10">Color: </strong>
                                            <select name="" class="form-control unicase-form-control" id="size">
                                                <option value="" selected disabled>--Choose Color--</option>
                                                @foreach ($product->color as $color)
                                                    <option value="{{$color}}">{{ucwords($color)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    
                                    <div class="detail-extralink mb-50">
                                        <div class="detail-qty border radius">
                                            {{-- <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a> --}}
                                            <input wire:model="quantity" type="number" name="quantity" class="qty-val" min="1">
                                            {{-- <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a> --}}
                                        </div>
                                        <div class="product-extra-link2">
                                            <button wire:click='addToCart({{$product}})' type="submit" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                    </div>
                                    <div class="font-xs">
                                        @if (!$product->vender_id)
                                            <p class="mb-2" style="font-size: 16px; font-weight:bold">Sold By:  <a href="#"> <span class="text-info">Owner</span> </a></p>
 
                                        @else
                                            <p class="mb-2" style="font-size: 16px; font-weight:bold">Sold By:  <a href="#"> <span class="text-info">{{$product->vendor->name}}</span> </a></p>
                                        @endif
                                        <hr>
                                        <ul class="mr-50 float-start">
                                            <li class="mb-5">Brand: <span class="text-brand"><a href="#">{{$product->brand->name}}</a></span></li>
                                            <li class="mb-5">Category:<span class="text-brand"> <a href="#">{{$product->category->name}}</a></span></li>
                                            <li>Sub Category: 
                                                
                                                {{-- @foreach ($product->subcategory as $subcategory) --}}
                                                <span class="text-brand">
                                                    <a href="#"> {{$product->subcategory->name}} </a>
                                                </span>
                                                {{-- @endforeach  --}}
                                            </li>
                                        </ul>
                                        <ul class="float-start">
                                            <li class="mb-5">Product Code:
                                                <span class="text-brand">
                                                    <a href="#"> {{$product->code}} </a>
                                                </span>
                                            </li>
                                            <li class="mb-5">Tags: 
                                                @foreach ($product->tags as $tag)
                                                <span class="text-brand">
                                                    <a href="#"> {{$tag}}</a>
                                                </span>
                                                @endforeach
                                            </li>
                                            <li>Stock:<span class="in-stock text-brand ml-5">{{$product->qty}} Items In Stock</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Vendor</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews ({{$ratingCount}})</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                            
                                            <p>{!! $product->long_desc !!}</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Additional-info">
                                        <table class="font-md">
                                            <tbody>
                                                <tr class="stand-up">
                                                    <th>Stand Up</th>
                                                    <td>
                                                        <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                                    </td>
                                                </tr>
                                                <tr class="folded-wo-wheels">
                                                    <th>Folded (w/o wheels)</th>
                                                    <td>
                                                        <p>32.5″L x 18.5″W x 16.5″H</p>
                                                    </td>
                                                </tr>
                                                <tr class="folded-w-wheels">
                                                    <th>Folded (w/ wheels)</th>
                                                    <td>
                                                        <p>32.5″L x 24″W x 18.5″H</p>
                                                    </td>
                                                </tr>
                                                <tr class="door-pass-through">
                                                    <th>Door Pass Through</th>
                                                    <td>
                                                        <p>24</p>
                                                    </td>
                                                </tr>
                                                <tr class="frame">
                                                    <th>Frame</th>
                                                    <td>
                                                        <p>Aluminum</p>
                                                    </td>
                                                </tr>
                                                <tr class="weight-wo-wheels">
                                                    <th>Weight (w/o wheels)</th>
                                                    <td>
                                                        <p>20 LBS</p>
                                                    </td>
                                                </tr>
                                                <tr class="weight-capacity">
                                                    <th>Weight Capacity</th>
                                                    <td>
                                                        <p>60 LBS</p>
                                                    </td>
                                                </tr>
                                                <tr class="width">
                                                    <th>Width</th>
                                                    <td>
                                                        <p>24″</p>
                                                    </td>
                                                </tr>
                                                <tr class="handle-height-ground-to-handle">
                                                    <th>Handle height (ground to handle)</th>
                                                    <td>
                                                        <p>37-45″</p>
                                                    </td>
                                                </tr>
                                                <tr class="wheels">
                                                    <th>Wheels</th>
                                                    <td>
                                                        <p>12″ air / wide track slick tread</p>
                                                    </td>
                                                </tr>
                                                <tr class="seat-back-height">
                                                    <th>Seat back height</th>
                                                    <td>
                                                        <p>21.5″</p>
                                                    </td>
                                                </tr>
                                                <tr class="head-room-inside-canopy">
                                                    <th>Head room (inside canopy)</th>
                                                    <td>
                                                        <p>25″</p>
                                                    </td>
                                                </tr>
                                                <tr class="pa_color">
                                                    <th>Color</th>
                                                    <td>
                                                        <p>Black, Blue, Red, White</p>
                                                    </td>
                                                </tr>
                                                <tr class="pa_size">
                                                    <th>Size</th>
                                                    <td>
                                                        <p>M, S</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="Vendor-info">
                                        <div class="vendor-logo d-flex mb-30">
                                                <img id="showImage" src="{{ (!empty($product->vendor->profile_photo_path)) ? url ('storage/'.$product->vendor->profile_photo_path) : url ('upload/user_images/no_image.jpg') }}" alt="user" class="rounded-circle p-1 bg-primary" width="110"/>
                                            <div class="vendor-name ml-15">
                                                <h6>
                                                    @if (!$product->vender_id)
                                                        <a href="vendor-details-2.html">Owner</a>
                                                    @else
                                                        <a href="vendor-details-2.html">{{$product->vendor->name}}</a>
                                                    @endif
                                                </h6>
                                                <div class="product-rate-cover text-end">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted"> ({{$ratingCount}} reviews)</span>
                                                </div>
                                            </div>
                                        </div>
                                        @if (!$product->vender_id)
                                            <ul class="contact-infor mb-50">
                                                <li><img src="assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Address: </strong> <span>Owner</span></li>
                                                <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Contact Seller:</strong><span>Owner</span></li>
                                            </ul>
                                        @else
                                            <ul class="contact-infor mb-50">
                                                <li><img src="assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Address: </strong> <span>{{$product->vendor->address}}</span></li>
                                                <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Contact Seller:</strong><span>{{$product->vendor->phone}}</span></li>
                                            </ul>
                                        @endif
                                        
                                        @if (!$product->vender_id)
                                        <p>Owner Information</p>                                        
                                        @else
                                            <p>{{$product->vendor->vendor_short_info}}</p>
                                        @endif
                                    </div>
                                    <livewire:review :product="$product" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-60">
                            <div class="col-12">
                                <h2 class="section-title style-1 mb-30">Related products</h2>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    @foreach ($products as $product)
                                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="{{route('product.details',$product->id)}}">
                                                            <img class="default-img" src="storage/{{$product->thambnail}}" alt="" />
                                                            <img class="hover-img" src="assets/imgs/shop/product-1-2.jpg" alt="" />
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
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
    
 
