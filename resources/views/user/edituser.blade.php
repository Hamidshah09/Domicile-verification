<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($users as $user)
                    <form method="POST" action="{{route('users.update', $user->id)}}" >
                        @csrf
                        @method('PUT')
                            <div class="flex flex-row flex-w">
                                <div class="form-control">
                                    <x-input-label for="user_type_id" :value="__('User Type')" />
                                    <select name="user_type_id" id="user_type_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('user_type_id', $user->user_type_id)" required autofocus autocomplete="user_type_id">
                                        @foreach ($user_types as $user_type)
                                            @if ($user_type->id==$user->user_types->id)
                                                <option selected value="{{$user_type->id}}">{{$user_type->user_type}} </option>
                                            @else
                                                <option value="{{$user_type->id}}">{{$user_type->user_type}}</option>    
                                            @endif
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                </div>
                                <div class="form-control">
                                    <x-input-label for="cnic" :value="__('CNIC')" />
                                    <x-text-input id="cnic" class="block mt-1 w-full p-2" type="text" name="cnic" :value="old('cnic', $user->cnic)" required autofocus autocomplete="cnic" />
                                    <x-input-error :messages="$errors->get('cnic')" class="mt-2" />
                                </div>
            
                                <div class="form-control">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" class="block mt-1 w-full p-2" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div class="form-control">
                                    <x-input-label for="fathername" :value="__('Father Name')" />
                                    <x-text-input id="fathername" class="block mt-1 w-full p-2" type="text" name="fathername" :value="old('fathername', $user->fathername)" required autofocus autocomplete="fathername" />
                                    <x-input-error :messages="$errors->get('fathername')" class="mt-2" />
                                </div>
                                <div class="form-control">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full p-2" type="text" name="email" :value="old('email', $user->email)" required autofocus autocomplete="email" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="form-control">
                                    <x-input-label for="role" :value="__('Role')" />
                                    <select name="role" id="role" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('role')" required autofocus autocomplete="role">    
                                        @foreach ($role_types as $role_type)
                                            @if ($role_type->id==$user->role_types->id)
                                                <option selected value="{{$role_type->id}}">{{$role_type->role}} </option>
                                            @else
                                                <option value="{{$role_type->id}}">{{$role_type->role}}</option>    
                                            @endif
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                </div>
                                <div class="form-control">
                                    <x-input-label for="status_id" :value="__('Status')" />
                                    <select name="status_id" id="status_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('status_id')" required autofocus autocomplete="status_id">    
                                        @foreach ($user_statuses as $user_status)
                                            @if ($user_status->id==$user->user_statuses->id)
                                                <option selected value="{{$user_status->id}}">{{$user_status->status}} </option>
                                            @else
                                                <option value="{{$user_status->id}}">{{$user_status->status}}</option>    
                                            @endif
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('status_id')" class="mt-2" />
                                </div>
                                <div class="form-control">
                                    <x-input-label for="password" :value="__('Password')" />
                                    <x-text-input id="password" class="block mt-1 w-full p-2" type="text" name="password" :value="old('password')" autofocus autocomplete="password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="form-control">
                                    <x-input-label for="is_allowed_to_chat" :value="__('Chat')" />
                                    <select name="is_allowed_to_chat" id="is_allowed_to_chat" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('is_allowed_to_chat')" required autofocus autocomplete="is_allowed_to_chat">    
                                        @if ($user->is_allowed_to_chat==1)
                                            <option value="0">Blocked </option>
                                            <option selected value="1">Allowed </option>
                                        @else
                                            <option selected value="0">Blocked </option>
                                            <option value="1">Allowed </option>    
                                        @endif
                                    </select>
                                    <x-input-error :messages="$errors->get('is_allowed_to_chat')" class="mt-2" />
                                </div>
                            </div>
                            <div class="">
                                <x-primary-button class="ms-3 mt-2">
                                    {{ __('Update') }}
                                </x-primary-button>
                            </div>
                            <div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li style="color:red;">{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>