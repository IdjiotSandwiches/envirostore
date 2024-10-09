@extends('layout.main-layout')
@section('title', 'Welcome')

@section('content')
    <div class="flex flex-col gap-10 py-4">
        @include('component.carousel', with([
            'imgPaths' => [
                'img/0.png',
                'img/1.png',
                'img/2.png',
                'img/3.png',
            ]
        ]))

        <div class="flex flex-col min-h-screen items-center gap-10">
            <h2 class="text-4xl font-secondary">Category</h2>

            <div class="inline-flex items-center justify-around bg-gradient-to-l from-white via-white to-gray-50 rounded-lg w-full max-w-screen-lg h-52 overflow-auto">
                <div class="grid gap-4 font-secondary w-1/2 px-6">
                    <h3 class="text-2xl md:text-4xl">Check out Sustainable Zero Waste Product</h3>
                    <p class="underline">Zero Waste Product</p>
                </div>
                <img src="{{ asset('img/image.png') }}" class="h-full object-cover lg:object-contain">
            </div>
        </div>
    </div>
@endsection
