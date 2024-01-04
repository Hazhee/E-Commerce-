<div class="header-action-icon-2">
    <a wire:navigate class="mini-cart-icon" href="{{route('myCart')}}">
        <img alt="Nest" src="{{asset('assets/imgs/theme/icons/icon-cart.svg')}}" />
        <span class="pro-count blue">{{$cart_count}}</span>
    </a>
    <a wire:navigate href="{{route('myCart')}}"><span class="lable">Cart</span></a>
    <div class="cart-dropdown-wrap cart-dropdown-hm2">
        <ul>
            @foreach ($cart_content as $item)
                <li>
                    <div class="shopping-cart-img">
                        <a href="shop-product-right.html"><img alt="Nest" src="{{asset('storage/'.$item->options->thambnail)}}" /></a>
                    </div>
                    <div class="shopping-cart-title">
                        <h4><a href="shop-product-right.html">{{$item->name}}</a></h4>
                        <h4><span>{{$item->qty}} × </span>${{$item->price}}</h4>
                    </div>
                    <div class="shopping-cart-delete">
                        <button wire:click="removeFromTheCart('{{$item->rowId}}')" type="button"><i class="fi-rs-cross-small"></i></button>
                    </div>
                </li>
            @endforeach
        </ul>
        @if ($cart_count != 0)
            <div class="shopping-cart-footer">
                <div class="shopping-cart-total">
                    <h4>Total <span>${{$cart_total}}</span></h4>
                </div>
                <div class="shopping-cart-button">
                    <a href="shop-cart.html" class="outline">View cart</a>
                    <a wire:navigate href="{{route('checkout')}}">Checkout</a>
                </div>
            </div>
        @else
            <div class="shopping-cart-footer">
                <h4>The cart is empty</h4>
            </div>
        @endif
        
    </div>
</div>