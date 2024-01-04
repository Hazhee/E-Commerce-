
@if ($paginator->hasPages())


    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                </li>
            @else
                <li class="page-item">
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="page-link"><i class="fi-rs-arrow-small-left"></i></button>
                </li>
            @endif


            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><button wire:click='gotoPage({{$page}})' class="page-link">{{ $page }}</button></li>
                        @else
                            <li><button wire:click='gotoPage({{$page}})' class="page-link">{{ $page }}</button></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="page-link"><i class="fi-rs-arrow-small-right"></i></button>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                </li>
            @endif
        </ul>
    </nav>

    
@endif
