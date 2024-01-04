<div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
    <nav>
        <ul>
            
            <li>
                <a wire:navigate class="active" href="{{url('/')}}">Home  </a>
                
            </li>
            
            @foreach ($categories as $category)
                <li>
                    <a wire:navigate href="{{route('category.products', $category->id)}}">{{$category->name}} <i class="fi-rs-angle-down"></i></a>

                    @php
                        $subCategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('name', 'asc')->get();

                    @endphp
                    <ul class="sub-menu">
                        @foreach ($subCategories as $item)
                            <li><a href="vendors-grid.html">{{$item->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        
            <li>
                <a href="page-contact.html">Contact</a>
            </li>
        </ul>
    </nav>
</div>