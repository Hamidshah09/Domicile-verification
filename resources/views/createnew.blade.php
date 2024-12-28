<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Apply for New Domicile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="" class="flex flex-row flex-w">
                        <div class="form-control">
                            <x-input-label for="cnic" :value="__('CNIC')" />
                            <x-text-input id="cnic" class="block mt-1 w-full p-2" type="text" name="cnic" :value="old('cnic')" required autofocus autocomplete="cnic" />
                            <x-input-error :messages="$errors->get('cnic')" class="mt-2" />
                        </div>
    
                        <div class="form-control">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full p-2" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="form-control">
                            <x-input-label for="fathername" :value="__('Father Name')" />
                            <x-text-input id="fathername" class="block mt-1 w-full p-2" type="text" name="fathername" :value="old('fathername')" required autofocus autocomplete="fathername" />
                            <x-input-error :messages="$errors->get('fathername')" class="mt-2" />
                        </div>


                        <div class="form-control">
                            <x-input-label for="dob" :value="__('Date of Birth')" />
                            <x-text-input id="dob" class="block mt-1 w-full p-2" type="date" name="dob" :value="old('dob')" required autofocus autocomplete="dob" />
                            <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                        </div>

                        <div class="form-control">
                            <x-input-label for="gender" :value="__('Gender')" />
                            <select name="gender_id" id="gender_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('gender_id')" required autofocus autocomplete="gender">
                                    <option value="">Select Gender</option>
                                    <option value="1">Male </option>
                                    <option value="2">Female</option>
                                    <option value="3">Transgender</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>

                        <div class="form-control">
                            <x-input-label for="placeofbirth" :value="__('Place of Birth')" />
                            <x-text-input id="placeofbirth" class="block mt-1 w-full p-2" type="date" name="placeofbirth" :value="old('placeofbirth')" required autofocus autocomplete="placeofbirth" />
                            <x-input-error :messages="$errors->get('placeofbirth')" class="mt-2" />
                        </div>

                        <div class="form-control">
                            <x-input-label for="marital_status" :value="__('Marital Status')" />
                            <select name="marital_status_id" id="marital_status_id" class="block mt-1 w-full rounded" :value="old('marital_status_id')" required autofocus autocomplete="marital_status">
                                
                                <option value="">Select Marital Status</option>
                                <option value="1">Single</option>
                                <option value="2">Married</option>
                                <option value="3">Divorced</option>
                                <option value="4">Widowed</option>
                                <option value="5">Widower</option>
                                                
                            </select>
                            <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
