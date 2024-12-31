<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Domicile Verification') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('submitorgverification') }}" class="">
                        @csrf
                        <div class="mr-3 w-full my-2">
                            <x-input-label for="cnic" :value="__('CNIC')" />
                            <x-text-input id="cnic" class="block mt-1 w-full" type="text" name="cnic" :value="old('cnic')" min='13' max='13' required autofocus autocomplete="cnic" />
                            <x-input-error :messages="$errors->get('cnic')" class="mt-2" />
                        </div>
                
                        <!-- Name -->
                        <div class="mr-3 w-full my-2">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                
                        <!-- Father Name -->
                        <div class="mr-3 w-full my-2">
                            <x-input-label for="fathername" :value="__('FatherName')" />
                            <x-text-input id="fathername" class="block mt-1 w-full" type="text" name="fathername" :value="old('fathername')" required autofocus autocomplete="fathername" />
                            <x-input-error :messages="$errors->get('fathername')" class="mt-2" />
                        </div>
                        <div class="mr-2 w-full my-2">
                            <label for="">Select Domicile Image</label>
                            <input type="file" id="scan_file" name="scan_file" class="block mt-1 py-1 w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"/>
                        </div>
                        <div class="flex flex-row justify-end mt-3">
                            <x-primary-button>
                                {{ __('Apply for Verification') }}
                            </x-primary-button>
                        </div>
                        
                        
                        
                    </form>
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
            </div>
        </div>
    </div>
</x-app-layout>
