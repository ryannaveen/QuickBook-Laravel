@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <!-- LEFT -->
        <div class="hidden sm:block">
            <p class="text-xs text-zinc-600">
                Showing
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                –
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-medium">{{ $paginator->total() }}</span>
            </p>
        </div>

        <!-- RIGHT -->
        <div class="flex gap-1 items-center">
            <!-- Previous Page Link -->
            @if ($paginator->onFirstPage())
                <span class="w-8 h-8 rounded-lg flex items-center justify-center text-zinc-700 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </span>
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="w-8 h-8 rounded-lg flex items-center justify-center text-zinc-400 hover:bg-zinc-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            @endif

            <!-- Pagination Elements -->
            @foreach ($elements as $element)
                <!-- "Three Dots" Separator -->
                @if (is_string($element))
                    <span class="w-8 h-8 rounded-lg flex items-center justify-center text-zinc-600 cursor-default">{{ $element }}</span>
                @endif

                <!-- Array Of Links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-8 h-8 rounded-lg flex items-center justify-center bg-amber-400 text-zinc-950 font-bold text-sm cursor-default" aria-current="page">{{ $page }}</span>
                        @else
                            <button wire:click="gotoPage({{ $page }})" class="w-8 h-8 rounded-lg flex items-center justify-center text-zinc-400 hover:bg-zinc-800 text-sm transition-colors" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="w-8 h-8 rounded-lg flex items-center justify-center text-zinc-400 hover:bg-zinc-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            @else
                <span class="w-8 h-8 rounded-lg flex items-center justify-center text-zinc-700 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif
        </div>
    </nav>
@endif
