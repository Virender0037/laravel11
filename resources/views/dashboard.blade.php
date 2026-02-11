<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @can('create', \App\Models\Products::class)
                <div class="p-6 text-gray-900">
                    <a href="{{route('products.create')}}" >{{ __("Create Products") }}</a>
                </div>
                @endcan

                @can('viewAny', \App\Models\Products::class)
                <div class="p-6 text-gray-900">
                    <a href="{{route('products.index')}}" >{{ __(" View Products") }}</a>
                </div>
                @endcan
                
                @can('viewTrashed', \App\Models\Products::class)
                <div class="p-6 text-gray-900">
                    <a href="{{route('products.trash')}}" >{{ __("View Trashed Products") }}</a>
                </div>
                @endcan
                <div class="p-6 text-gray-900">
                    <a href="{{route('products.index')}}" >{{ __(" View Products") }}</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
