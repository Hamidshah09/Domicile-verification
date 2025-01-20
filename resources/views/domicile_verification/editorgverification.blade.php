<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Domicile Verification Application') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($applicants as $app)
                        <form method="POST" enctype="multipart/form-data" action="{{ route('updateorgverificationapp', $app->id) }}" class="">
                            @method('PUT')
                            @csrf
                            <div class="mr-3 w-full my-2">
                                <x-input-label for="cnic" :value="__('CNIC')" />
                                <x-text-input id="cnic" class="block mt-1 w-full" type="text" name="cnic" :value="old('cnic', $app->applicants->cnic)" min='13' max='13' required autofocus autocomplete="cnic" />
                                <x-input-error :messages="$errors->get('cnic')" class="mt-2" />
                            </div>
                    
                            <!-- Name -->
                            <div class="mr-3 w-full my-2">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $app->applicants->name)" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                    
                            <!-- Father Name -->
                            <div class="mr-3 w-full my-2">
                                <x-input-label for="fathername" :value="__('FatherName')" />
                                <x-text-input id="fathername" class="block mt-1 w-full" type="text" name="fathername" :value="old('fathername', $app->applicants->fathername)" required autofocus autocomplete="fathername" />
                                <x-input-error :messages="$errors->get('fathername')" class="mt-2" />
                            </div>
                            <div class="my-2">
                                <x-input-label for="domicile_number" :value="__('Domicile Number')" />
                                <x-text-input id="domicile_number" class="block mt-1 w-full p-2" type="text" name="domicile_number" :value="old('domicile_number', $app->applicants->domicile_number)" required autofocus autocomplete="domicile_number" />
                                <x-input-error :messages="$errors->get('domicile_number')" class="mt-2" />
                            </div>

                            <div class="my-2">
                                <x-input-label for="issuance_date" :value="__('Issuance Date')" />
                                <x-text-input id="issuance_date" class="block mt-1 w-full p-2" type="date" name="issuance_date" :value="old('issuance_date', $app->applicants->issuance_date)" required autofocus autocomplete="issuance_date" />
                                <x-input-error :messages="$errors->get('issuance_date')" class="mt-2" />
                            </div>
                            <div class="mr-2 w-full my-2">
                                <label for="">Select Domicile Image</label>
                                <input type="file" id="scan_file" name="scan_file" class="block mt-1 py-1 w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"/>
                            </div>
                            <div class="flex flex-row justify-end mt-3">
                                <x-primary-button>
                                    {{ __('Update') }}
                                </x-primary-button>
                            </div>
                            
                            
                            
                        </form>
                    @endforeach
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
