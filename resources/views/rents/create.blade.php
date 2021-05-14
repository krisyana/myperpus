<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($rent) ? 'Edit Rent' : 'Create Rent' }}
            <div class="float-right">
                <x-nav-link :href="route('rents.index')" :active="request()->routeIs('rents.index')">
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
                        action="{{ isset($rent) ? route('rents.update', $rent->id) : route('rents.store') }}"
                        id="rent-form">
                        @if (isset($rent))
                            @method('PUT')
                        @endif
                        @csrf

                        <!-- Book -->
                        <div>
                            <select class="form-select" aria-label="Select Book" name="book_id">
                                @if (isset($rent))
                                    <option selected value="{{ $rent->book_id }}">{{ $rent->book->title }}</option>
                                @else
                                    <option selected value="">Select Book</option>
                                @endif

                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- User -->
                        <div class="mt-4">
                            <select class="form-select" aria-label="Select User" name="user_id">
                                @if (isset($rent))
                                    <option selected value="{{ $rent->user_id }}">{{ $rent->user->name }}</option>
                                @else
                                    <option selected value="">Select User</option>
                                @endif
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Rent Date -->
                        <div class="mt-4">
                            <x-label for="rentdate" :value="__('Rent Date')" />

                            <x-input id="rentdate" class="block mt-1 " type="date" name="rent_at" required
                                value="{{ isset($rent) ? $rent->rent_at : '' }}" autocomplete="new-rentdate" />
                        </div>

                        <!-- Return Date -->
                        <div class="mt-4">
                            <x-label for="returndate" :value="__('Return Date')" />
                            <x-input id="returndate" class="block mt-1" type="date" name="return_at"
                                value="{{ isset($rent) ? $rent->return_at : '' }}" required />
                        </div>



                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ isset($rent) ? 'Update' : 'Create' }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {!! JsValidator::formRequest('App\Http\Requests\StoreRentRequest', '#rent-form') !!}

</x-app-layout>
