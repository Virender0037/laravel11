<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(auth()->user()->is_admin == 1)
                <div class="p-6 text-gray-900">
                    <a href="{{route('products.create')}}" >{{ __("Create Products") }}</a>
                </div>
                <div class="p-6 text-gray-900">
                    <a href="{{route('products.index')}}" >{{ __(" View Products") }}</a>
                </div>
                <div class="p-6 text-gray-900">
                    <a href="{{route('products.trash')}}" >{{ __("View Trashed Products") }}</a>
                </div>
                @else
                <div class="p-6 text-gray-900">
                    <a href="{{route('products.index')}}" >{{ __(" View Products") }}</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
