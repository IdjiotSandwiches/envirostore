@extends('layout.layout')
@section('title', 'Homepage')

@section('content')
    @include('component.carousel', ['imgPaths' => $banners])
    <div class="max-w-screen-xl mx-auto">
        <div class="flex justify-center p-9 md:text-2xl sm:text-lg">
            <h1 class="text-5xl font-secondary">
                Category
            </h1>
        </div>
        <div class="flex justify-center pb-9">
            <img class="h-auto max-w-full" src="{{ asset('img/Example Banner.png') }}" alt="image description">
        </div>
        <div class="mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-3">
                @foreach ($categories as $category)
                    @include('component.category-tiles', [
                        'image' => $category->image,
                        'name' => $category->name,
                    ])
                @endforeach
            </div>
        </div>


        <div class="flex justify-center p-9">
            <h1 class="text-5xl font-secondary">
                Recommended Products
            </h1>
        </div>
        <div class="mx-auto px-4 pb-9">
            <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-3">
                @foreach ($products as $product)
                    @include('component.card', [
                        'link' => $product->link,
                        'image' => $product->img,
                        'name' => $product->name,
                        'rating' => $product->rating,
                        'price' => $product->price,
                    ])
                @endforeach
            </div>
        </div>
    </div>
@endsection
