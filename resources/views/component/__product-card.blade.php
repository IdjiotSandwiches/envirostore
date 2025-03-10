@props(['link', 'rating', 'image', 'name', 'price'])

<div class="max-w-sm bg-white rounded-lg shadow-sm">
    <a href="{{ $link }}">
        <div class="flex justify-center items-center">
            <img class="rounded-t-lg aspect-square object-contain ::OPACITY::" src="{{ $image }}" alt="{{ $name }}" />
            <p class="absolute font-semibold text-lg ::HIDDEN::">{{ __('page.cart.out_of_stock') }}</p>
        </div>
        <div class="p-5 flex flex-col gap-2">
            <div>
                <h5 class="text-xl font-bold text-font_primary">{{ $name }}</h5>
                <p class="text-base text-font_secondary">EnviroStore</p>
                <p class="flex items-center gap-2 text-base text-font_secondary">
                    <svg class="w-5 h-5 md:w-4 md:h-4 text-white stroke-accent" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                    {{ $rating }}
                </p>
            </div>
            <p class="text-xl font-bold text-font_primary">Rp {{ $price }}</p>
        </div>
    </a>
</div>
