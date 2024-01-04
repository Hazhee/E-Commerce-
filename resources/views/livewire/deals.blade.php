<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach ($hot_deals as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{route('product.details',$item->id)}}"><img src="storage/{{$item->thambnail}}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{route('product.details',$item->id)}}">{{$item->name}}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        @php
                                        $ratingAvg = \App\Models\Review::where('product_id', $item->id)->where('status', 1)->avg('rating');
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
                                    <span class="font-small ml-5 text-muted"> ({{count($item->reviews)}})</span>
                                </div>
                                <div class="product-price">
                                    @if ($item->discount_price)
                                        <div class="product-price">
                                            <span>${{$item->discount_price}}</span>
                                            <span class="old-price">${{$item->price}}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{$item->price}}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                    
                    
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated">  Special Offer </h4>
                <div class="product-list-small animated animated">
                    @foreach ($speacial_offers as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{route('product.details',$item->id)}}"><img src="storage/{{$item->thambnail}}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{route('product.details',$item->id)}}">{{$item->name}}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                         @php
                                        $ratingAvg = \App\Models\Review::where('product_id', $item->id)->where('status', 1)->avg('rating');
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
                                    <span class="font-small ml-5 text-muted"> ({{count($item->reviews)}})</span>
                                </div>
                                <div class="product-price">
                                    @if ($item->discount_price)
                                        <div class="product-price">
                                            <span>${{$item->discount_price}}</span>
                                            <span class="old-price">${{$item->price}}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{$item->price}}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                <div class="product-list-small animated animated">
                    @foreach ($recently as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{route('product.details',$item->id)}}"><img src="storage/{{$item->thambnail}}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{route('product.details',$item->id)}}">{{$item->name}}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                         @php
                                        $ratingAvg = \App\Models\Review::where('product_id', $item->id)->where('status', 1)->avg('rating');
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
                                    <span class="font-small ml-5 text-muted"> ({{count($item->reviews)}})</span>
                                </div>
                                <div class="product-price">
                                    @if ($item->discount_price)
                                        <div class="product-price">
                                            <span>${{$item->discount_price}}</span>
                                            <span class="old-price">${{$item->price}}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{$item->price}}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach ($special_deals as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{route('product.details',$item->id)}}"><img src="storage/{{$item->thambnail}}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{route('product.details',$item->id)}}">{{$item->name}}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                         @php
                                        $ratingAvg = \App\Models\Review::where('product_id', $item->id)->where('status', 1)->avg('rating');
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
                                    <span class="font-small ml-5 text-muted"> ({{count($item->reviews)}})</span>
                                </div>
                                <div class="product-price">
                                    @if ($item->discount_price)
                                        <div class="product-price">
                                            <span>${{$item->discount_price}}</span>
                                            <span class="old-price">${{$item->price}}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{$item->price}}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>