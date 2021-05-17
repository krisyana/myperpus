<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($book) ? 'Edit Book' : 'Create Book' }}
            <div class="float-right">
                <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.index')">
                    <x-button>Back to Index</x-button>
                </x-nav-link>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST"
                        action="{{ isset($book) ? route('books.update', $book->id) : route('books.store') }}"
                        id="book-form" enctype="multipart/form-data">
                        @csrf
                        @if (isset($book))
                            @method('PUT')
                        @endif

                        <!-- Title -->
                        <div>
                            <x-label for="title" :value="__('Title')" />

                            <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                value="{{ isset($book) ? $book->title : '' }}" required autofocus />
                        </div>

                        <!-- Author -->
                        <div class="mt-4">
                            <x-label for="author" :value="__('Author')" />

                            <x-input id="author" class="block mt-1 w-full" type="text" name="author"
                                value="{{ isset($book) ? $book->author : '' }}" required />
                        </div>

                        <!-- Publisher -->
                        <div class="mt-4">
                            <x-label for="publisher" :value="__('Publisher')" />

                            <x-input id="publisher" class="block mt-1 w-full" type="text" name="publisher" required
                                value="{{ isset($book) ? $book->publisher : '' }}" autocomplete="new-publisher" />
                        </div>

                        <!-- Category -->
                        <div class="mt-4">
                            <x-label for="categories[]" :value="__('Category')" />


                            <select class="categories-multiple w-full mt-1" name="categories[]" multiple="multiple">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (isset($book))  @if ($book->hasCategory($category->id))
                                        selected @endif
                                @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Featured -->
                        <div class="mt-4">
                            <x-label for="featured" :value="__('Featured')" />
                            <x-input id="featured" class="block mt-1" type="number" name="featured"
                                value="{{ isset($book) ? $book->featured : '' }}" required />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <label for="description"
                                class="'block font-medium text-sm text-gray-700'">Description</label>
                            <textarea
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                                id="description" name="description" rows="4"
                                value="{{ isset($book) ? $book->description : '' }}" required></textarea>
                        </div>

                        <!-- Sum -->
                        <div class="mt-4">
                            <x-label for="sum" :value="__('Jumlah')" />
                            <x-input id="sum" class="block mt-1 w-50%" type="number" name="sum"
                                value="{{ isset($book) ? $book->sum : '' }}" required />
                        </div>

                      <!-- Image -->
                        <div>
                            <x-label for="image" :value="__('IMage Url')" />

                            <x-input id="image" class="block mt-1 w-full" type="text" name="image"
                                value="{{ isset($book) ? $book->image : '' }}" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ isset($book) ? 'Update' : 'Create' }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.categories-multiple').select2({
                    placeholder: "Select Category",
                    allowClear: true
                });
            });

        </script>

    @endsection
    {!! JsValidator::formRequest('App\Http\Requests\StoreBookRequest', '#book-form') !!}

</x-app-layout>
