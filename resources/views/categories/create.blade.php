<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($category) ? 'Edit Category' : 'Create Category' }}
            <div class="float-right">
                <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')">
                    <x-button>Back to Index</x-button>
                </x-nav-link>
            </div>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" class="needs-validation"
                        action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
                        id="category-form">
                        @csrf
                        @if (isset($category))
                            @method('PUT')
                        @endif
                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="form-control" type="text" name="name" id="validationDefault01"
                                value="{{ isset($category) ? $category->name : '' }}" required autofocus />
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ isset($category) ? 'Update' : 'Create' }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {!! JsValidator::formRequest('App\Http\Requests\StoreCategoryRequest', '#category-form') !!}

</x-app-layout>
