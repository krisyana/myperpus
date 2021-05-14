<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($user) ? 'Edit User' : 'Create User' }}
            <div class="float-right">
                <x-button>Back to Index</x-button>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST"
                        action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
                        id="user-form">
                        @csrf

                        @if (isset($rent))
                            @method('PUT')
                        @endif

                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                value="{{ isset($user) ? $user->name : '' }}" required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                value="{{ isset($user) ? $user->email : '' }}" required autofocus />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-label for="password" :value="__('Password')" />

                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                value="{{ isset($user) ? $user->password : '' }}" autofocus />
                        </div>

                        <!-- Kelas -->
                        <div>
                            <x-label for="kelas" :value="__('Kelas')" />

                            <x-input id="kelas" class="block mt-1 w-full" type="text" name="kelas"
                                value="{{ isset($user) ? $user->kelas : '' }}" required autofocus />
                        </div>

                        <!-- Jurusan -->
                        <div>
                            <x-label for="jurusan" :value="__('Jurusan')" />

                            <x-input id="jurusan" class="block mt-1 w-full" type="text" name="jurusan"
                                value="{{ isset($user) ? $user->jurusan : '' }}" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ isset($user) ? 'Update' : 'Create' }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {!! JsValidator::formRequest('App\Http\Requests\StoreUserRequest', '#user-form') !!}

</x-app-layout>
