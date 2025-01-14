@extends('layout.layout')
@section('title', 'Product Management')

@section('content')
    <section class="max-w-screen-xl px-4 py-8 md:mx-auto grid gap-4">
        <div class="flex items-center justify-between">
            <h1 class="font-bold text-3xl">{{ __('header.productManagement') }}</h1>
            <a href="{{ route('admin.addProductIndex') }}" class="px-4 py-2 bg-button text-white rounded-lg hover:bg-accent">
                Add Product
            </a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-16 py-3">
                            <span class="sr-only">Image</span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stocks
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="p-4">
                                <img src="{{ $product->img }}" class="w-16 md:w-32 max-w-full max-h-full" alt="{{ $product->name }}">
                            </td>
                            <td class="px-6 py-4 font-semibold text-font_primary">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-font_primary">
                                {{ $product->category_name }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-font_primary">
                                <div class="flex items-center">
                                {{ $product->stocks }}
                                </div>
                            </td>
                            <td class="px-6 py-4 font-semibold text-font_primary">
                                {{ $product->price }}
                            </td>
                            <td class="py-4">
                                <form action="{{ route('admin.deleteProduct', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:underline mr-4">Remove</button>
                                </form>
                                <a href="{{ route('admin.editProduct', $product->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
