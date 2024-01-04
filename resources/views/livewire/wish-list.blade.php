<div>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a wire:navigate href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                 <span></span> WishLists
            </div>
        </div>
    </div>
    <div class="container mb-30 mt-50">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="mb-50">
                    <h1 class="heading-2 mb-10">Your Wishlist</h1>
                    <h6 class="text-body">There are <span class="text-brand">{{count($wishlist)}}</span> products in this list</h6>
                </div>
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th class="custome-checkbox start pl-30">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="" />
                                    <label class="form-check-label" for="exampleCheckbox11"></label>
                                </th>
                                <th scope="col" colspan="2">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock Status</th>
                                <th scope="col">Action</th>
                                <th scope="col" class="end">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlist as $item)
                                <tr class="pt-30">
                                    <td class="custome-checkbox pl-30">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                        <label class="form-check-label" for="exampleCheckbox1"></label>
                                    </td>
                                    <td class="image product-thumbnail pt-40"><img src="{{asset('storage/'.$item->product->thambnail)}}" alt="#" /></td>
                                    <td class="product-des product-name">
                                        <h6 style="font-size: 20px; font-weight: bold;"><a wire:navigate class="product-name mb-10" href="{{route('product.details',$item->product->id)}}">{{$item->product->name}}</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        @if ($item->product->discount_price == NULL)
                                            <h3 style="font-size: 20px; font-weight: bold;" class="text-brand">${{$item->product->price}}</h3>
                                        @else
                                            <h3 style="font-size: 20px; font-weight: bold;" class="text-brand">${{$item->product->discount_price}}</h3>
                                        @endif
                                        
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        @if ($item->product->qty > 0)
                                            <span class="stock-status in-stock mb-0"> In Stock </span>
                                        @else
                                            <span class="stock-status Out-stock mb-0"> Out Stock </span>
                                        @endif
                                        
                                    </td>
                                    <td class="text-right" data-title="Cart">
                                        <button wire:click='addToCart({{$item->product}})' class="btn btn-sm">Add to cart</button>
                                    </td>
                                    <td class="action text-center" data-title="Remove">
                                        <button wire:click='removeFromWishList({{$item->id}})' type="button" class="text-body"><i class="fi-rs-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
