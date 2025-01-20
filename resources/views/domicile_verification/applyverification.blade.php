<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Apply for Domicile Verification') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col"></div>
                    <form method="POST" enctype="multipart/form-data" action="{{ route('submitverification') }}">
                        @csrf
                        <div class="my-2">
                            <x-input-label for="cnic" :value="__('CNIC')" />
                            <x-text-input id="cnic" class="block mt-1 w-full p-2" type="text" name="cnic" :value="old('cnic')" required autofocus autocomplete="cnic" />
                            <x-input-error :messages="$errors->get('cnic')" class="mt-2" />
                        </div>
    
                        <div class="my-2">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full p-2" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="my-2">
                            <x-input-label for="fathername" :value="__('Father/Husband Name')" />
                            <x-text-input id="fathername" class="block mt-1 w-full p-2" type="text" name="fathername" :value="old('fathername')" required autofocus autocomplete="fathername" />
                            <x-input-error :messages="$errors->get('fathername')" class="mt-2" />
                        </div>

                        <div class="my-2">
                            <x-input-label for="domicile_number" :value="__('Domicile Number')" />
                            <x-text-input id="domicile_number" class="block mt-1 w-full p-2" type="text" name="domicile_number" :value="old('domicile_number')" required autofocus autocomplete="domicile_number" />
                            <x-input-error :messages="$errors->get('domicile_number')" class="mt-2" />
                        </div>

                        <div class="my-2">
                            <x-input-label for="issuance_date" :value="__('Issuance Date')" />
                            <x-text-input id="issuance_date" class="block mt-1 w-full p-2" type="date" name="issuance_date" :value="old('issuance_date')" required autofocus autocomplete="issuance_date" />
                            <x-input-error :messages="$errors->get('issuance_date')" class="mt-2" />
                        </div>
                        <div class="my-2">
                            <x-input-label for="scan_file" :value="__('Domicile Image')" />
                            {{-- <input type="file" id="scan_file" name="scan_file"/> --}}
                            <x-text-input id="scan_file" class="block mt-1 w-full p-2" type="file" name="scan_file" :value="old('scan_file')" required autofocus autocomplete="scan_file" />
                            <x-input-error :messages="$errors->get('scan_file')" class="mt-2" />
                        </div>
                        <div class="mt-3 flex justify-end">
                            <x-primary-button>
                                {{ __('Apply') }}
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
