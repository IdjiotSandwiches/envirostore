<div class="w-full flex flex-col items-center">
    <svg class="w-36 h-36 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
        fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
    </svg>
    <h4 class="font-semibold text-2xl">{{ __('page.cart.empty') }}</h4>
    <a href="{{ route('home') }}"
        class="mt-4 text-white bg-button disabled:cursor-not-allowed disabled:bg-button/70 hover:bg-button/80 focus:ring-4 focus:outline-none focus:ring-button/15 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-button dark:hover:bg-button/80 dark:focus:ring-button/15">
        {{ __('page.cart.button') }}
    </a>
</div>