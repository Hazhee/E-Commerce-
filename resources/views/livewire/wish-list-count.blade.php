<div class="header-action-icon-2">
    <a wire:navigate href="{{route('wishlist')}}">
        <img class="svgInject" alt="Nest" src="{{asset('assets/imgs/theme/icons/icon-heart.svg')}}" />
        <span class="pro-count blue">{{$wishlist_count}}</span>
    </a>
    <a wire:navigate href="{{route('wishlist')}}"><span class="lable">Wishlist</span></a>
</div>