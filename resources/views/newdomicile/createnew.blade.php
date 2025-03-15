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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="color:red;">{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('storenew')}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div class="mx-2">
                            Note: You can only apply for your domicile and your childern domicile.
                        </div>
                        <div class="flex flex-row flex-w">
                            
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
                                <x-input-label for="fathername" :value="__('Father/Husband Name')" />
                                <x-text-input id="fathername" class="block mt-1 w-full p-2" type="text" name="fathername" :value="old('fathername', $user->fathername)" required autofocus autocomplete="fathername" />
                                <x-input-error :messages="$errors->get('fathername')" class="mt-2" />
                            </div>


                            <div class="form-control">
                                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                                <x-text-input id="date_of_birth" class="block mt-1 w-full p-2" type="date" name="date_of_birth" :value="old('date_of_birth', '1982-06-05')" required autofocus autocomplete="date_of_birth" />
                                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                            </div>

                            <div class="form-control">
                                <x-input-label for="gender" :value="__('Gender')" />
                                <select name="gender_id" id="gender_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('gender_id')" required autofocus autocomplete="gender">
                                        <option value="">Select Gender</option>
                                        <option selected value="1">Male </option>
                                        <option value="2">Female</option>
                                        <option value="3">Transgender</option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>

                            <div class="form-control">
                                <x-input-label for="place_of_birth" :value="__('Place of Birth')" />
                                <x-text-input id="place_of_birth" class="block mt-1 w-full p-2" type="text" name="place_of_birth" :value="old('place_of_birth', 'Karachi')" max="45" required autofocus autocomplete="place_of_birth" />
                                <x-input-error :messages="$errors->get('place_of_birth')" class="mt-2" />
                            </div>

                            <div class="form-control">
                                <x-input-label for="marital_status" :value="__('Marital Status')" />
                                <select name="marital_status_id" id="marital_status_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('marital_status_id')" required autofocus autocomplete="marital_status">
                                    
                                    <option value="">Select Marital Status</option>
                                    <option value="1">Single</option>
                                    <option selected value="2">Married</option>
                                    <option value="3">Divorced</option>
                                    <option value="4">Widowed</option>
                                    <option value="5">Widower</option>
                                                    
                                </select>
                                <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="religion" :value="__('Religion')" />
                                <x-text-input id="religion" class="block mt-1 w-full p-2" type="text" max="45" name="religion" :value="old('religion', 'Islam')" required autofocus autocomplete="religion" />
                                <x-input-error :messages="$errors->get('religion')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="qualification_id" :value="__('Qualification')" />
                                <select name="qualification_id" id="qualification_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('qualification_id')" autofocus autocomplete="qualification_id">
                                    <option value="">Select Qualification</option>
                                    <option value="1">Primary</option>
                                    <option value="2">Middle</option>
                                    <option selected value="3">SSC</option>
                                    <option value="4">HSSC</option>
                                    <option value="5">Bachelors</option>
                                    <option value="6">Masters</option>
                                    <option value="7">PhD</option>
                                    <option value="8">Not Available</option>
                                    <option value="9">Other</option>
                                    <option value="10">Islamic Education</option>                    
                                </select>
                                <x-input-error :messages="$errors->get('qualification_id')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="occupation_id" :value="__('Ocupation')" />
                                <select name="occupation_id" id="occupation_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('occupation_id')" autofocus autocomplete="occupation_id">
                                        <option value="">Select Occupation</option>
                                        <option selected value="1">Government Employee</option>
                                        <option value="2">Non Government Employee</option>
                                        <option value="3">Own Business</option>
                                        <option value="4">Student</option>
                                        <option value="5">Other</option>
                                        <option value="6">House wife</option>
                                        <option value="7">Private Job</option>
                                </select>
                                <x-input-error :messages="$errors->get('occupation_id')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="contact" :value="__('Contact')" />
                                <x-text-input id="contact" class="block mt-1 w-full p-2" type="text" max="11" name="contact" :value="old('contact', '03345927274')" min="11" max=11 autofocus autocomplete="contact" />
                                <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="date_of_arrival" :value="__('Date of arrival')" />
                                <x-text-input id="date_of_arrival" class="block mt-1 w-full p-2" type="date" name="date_of_arrival" :value="old('date_of_arrival', '2010-10-01')" autofocus autocomplete="date_of_arrival" />
                                <x-input-error :messages="$errors->get('date_of_arrival')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex flex-w">
                            <div class="form-control">
                                <x-input-label for="temp_province_id" :value="__('Present Province')" />
                                <select name="temporaryAddress_province_id" id="temp_province_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('temporaryAddress[province_id]')" required autofocus autocomplete="temp_province_id">
                                    <option value="" selected="" disabled="">Select Province</option>
                                    <option value="694"> Azad Jammu and Kashmir</option>
                                    <option value="491"> Balochistan</option>
                                    <option value="663"> Federal Capital</option>
                                    <option value="666"> Gilgit-Baltistan</option>
                                    <option value="1"> Khyber Pakhtunkhwa</option>
                                    <option value="167"> Punjab</option>
                                    <option value="344"> Sindh</option>
                                </select>
                                <x-input-error :messages="$errors->get('temporaryAddress_province_id')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="temp_district_id" :value="__('Present District')" />
                                <select name="temporaryAddress_district_id" id="temp_district_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('temporaryAddress_district_id')" required autofocus autocomplete="temp_district_id">
                                    <option value="" selected="" disabled="">Select District</option>
                                </select>
                                <x-input-error :messages="$errors->get('temporaryAddress_district_id')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="temp_tehsil_id" :value="__('Present Tehsil')" />
                                <select name="temporaryAddress_tehsil_id" id="temp_tehsil_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('temporaryAddress_tehsil_id')" required autofocus autocomplete="temp_tehsil_id">
                                    <option value="" selected="" disabled="">Select District</option>
                                </select>
                                <x-input-error :messages="$errors->get('temporaryAddress_tehsil_id')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex flex-w">
                                <x-input-label for="temp_address" :value="__('Present Address')" class="mx-3"/>
                                <x-text-input id="temp_address" class="block mt-1 w-full p-2 mx-2" type="text" name="temporaryAddress" :value="old('temporaryAddress')" required autofocus autocomplete="temporaryAddress" />
                                <x-input-error :messages="$errors->get('temporaryAddress')" class="mt-2" />
                        </div>
                        <div class="my-2 mx-3">
                            <label class="float-start">
                                <input type="checkbox" id="same_as_above" class="rounded">
                                <span>Same as above</span>
                            </label>
                        </div>
                        <div class="flex flex-w">
                            <div class="form-control">
                                <x-input-label for="permanent_province_id" :value="__('Permanent Province')" />
                                <select name="permanentAddress_province_id" id="permanent_province_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('permanentAddress_province_id')" required autofocus autocomplete="permanent_province_id">
                                    <option value="" selected="" disabled="">Select Province</option>
                                    <option value="694"> Azad Jammu and Kashmir</option>
                                    <option value="491"> Balochistan</option>
                                    <option value="663"> Federal Capital</option>
                                    <option value="666"> Gilgit-Baltistan</option>
                                    <option value="1"> Khyber Pakhtunkhwa</option>
                                    <option value="167"> Punjab</option>
                                    <option value="344"> Sindh</option>
                                </select>
                                <x-input-error :messages="$errors->get('permanentAddress_province_id')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="permanent_district_id" :value="__('Permanent District')" />
                                <select name="permanentAddress_district_id" id="permanent_district_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('permanentAddress_district_id')" required autofocus autocomplete="permanent_district_id">
                                    <option value="" selected="" disabled="">Select District</option>
                                </select>
                                <x-input-error :messages="$errors->get('permanentAddress_district_id')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="permanent_tehsil_id" :value="__('Permanent Tehsil')" />
                                <select name="permanentAddress_tehsil_id" id="permanent_tehsil_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('permanentAddress_tehsil_id')" required autofocus autocomplete="permanent_tehsil_id">
                                    <option value="" selected="" disabled="">Select District</option>
                                </select>
                                <x-input-error :messages="$errors->get('permanentAddress_tehsil_id')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex flex-w">
                                <x-input-label for="permanent_address" :value="__('Permanent Address')" class="mx-3"/>
                                <x-text-input id="permanent_address" class="block mt-1 w-full p-2 mx-2" type="text" name="permanentAddress" :value="old('permanentAddress')" required autofocus autocomplete="permanentAddress" />
                                <x-input-error :messages="$errors->get('permanentAddress')" class="mt-2" />
                        </div>
                        <div id="scan_documents_container">    
                            <div class="form-control">
                                <x-input-label for="scan_documents" :value="__('Upload one pdf which contains all documents')" />
                                <x-text-input id="scan_documents" class="block mt-1 w-full p-2" type="file" name="scan_documents" :value="old('scan_documents')" required autofocus autocomplete="scan_documents" />
                                <x-input-error :messages="$errors->get('scan_documents')" class="mt-2" />
                            </div>                      
                        </div>
                        <div class="my-2 mx-3 hidden" id="children_div">
                            <label class="">
                                <input name="children_checkbox" value="1" id="children_checkbox" type="checkbox" class="rounded">
                                <span class="input-span"></span>Have Children</label>
                                
                        </div>
                        
                        <div >
                            <table class="styled-table hidden" id="table-responsive">
                                <thead>     
                                    <th>Child Name</th>
                                    <th>Child CNIC</th>
                                    <th>Child Date of Birth</th>
                                    <th>Child Gender</th>
                                    <th>Add Child</th>   
                                </thead>
                                <tbody id="table-body">
                                    
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="flex flex-row justify-end">
                            <x-primary-button class="ms-3" type="submit">
                                {{ __('Apply') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var child_input = document.getElementById('children_checkbox');
        child_input.onclick = function(){
            
            
            if (child_input.checked){
                document.getElementById('table-responsive').classList.remove('hidden');
                create_child_row();
            }else{
                if (confirm("Do you want to delete all children?")) {
                    // User clicked OK
                    delete_all_rows();
                    document.getElementById('table-responsive').classList.add('hidden');   
                } else{
                    child_input.checked = true;
                }
            }
            
        }
        function create_child_row(){
            let inputContainer = document.getElementById('table-body'); 
            let newTr = document.createElement('tr');
            let newTd = document.createElement('td');
            let nameInput = document.createElement('input') 
            nameInput.className = 'border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full p-2 mx-2'; 
            nameInput.type = 'text'; 
            nameInput.name = `children[${inputContainer.children.length}][name]`; 
            nameInput.required = true; 
            nameInput.autofocus = true; 
            nameInput.autocomplete = `children[${inputContainer.children.length}][name]`; 
            newTd.appendChild(nameInput);  
            newTr.appendChild(newTd);

            let secondTd = document.createElement('td');
            let cnicInput = document.createElement('input') 
            cnicInput.className = 'border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full p-2 mx-2'; 
            cnicInput.type = 'text'; 
            cnicInput.name = `children[${inputContainer.children.length}][cnic]`; 
            cnicInput.required = true; 
            cnicInput.autofocus = true; 
            cnicInput.autocomplete = `children[${inputContainer.children.length}][cnic]`;
            cnicInput.max = "13"
            cnicInput.min = "13" 
            secondTd.appendChild(cnicInput);  
            newTr.appendChild(secondTd);

            let thirdTd = document.createElement('td');
            let dob = document.createElement('input') 
            dob.className = 'border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full p-2 mx-2'; 
            dob.type = 'date'; 
            dob.name = `children[${inputContainer.children.length}][date_of_birth]`; 
            dob.required = true; 
            dob.autofocus = true; 
            dob.autocomplete = `children[${inputContainer.children.length}][date_of_birth]`;
            thirdTd.appendChild(dob);  
            newTr.appendChild(thirdTd);

            let fourthTd = document.createElement('td');
            let gender = document.createElement('select') 
            gender.className = 'border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full p-2 mx-2'; 
            gender.name = `children[${inputContainer.children.length}][gender_id]`;  
            gender.autofocus = true; 
            gender.autocomplete = `children[${inputContainer.children.length}][gender_id]`;
            
            // Add options to the select element 
            let option1 = document.createElement('option'); 
            option1.value = ''; 
            option1.textContent = 'Select Gender'; 
            option1.disabled = true; 
            option1.selected = true; 
            gender.appendChild(option1); 
            
            let option2 = document.createElement('option'); 
            option2.value = '1'; 
            option2.textContent = 'Male'; 
            gender.appendChild(option2); 
            
            
            let option3 = document.createElement('option'); 
            option3.value = '2'; 
            option3.textContent = 'Female'; 
            gender.appendChild(option3);

            let option4 = document.createElement('option'); 
            option4.value = '3'; 
            option4.textContent = 'Transgender'; 
            gender.appendChild(option4);
            fourthTd.appendChild(gender);  
            newTr.appendChild(fourthTd);

            let seventhTd = document.createElement('td');
            let add = document.createElement('a');
            add.className = "icon-font-1 mx-2";
            add.href="javascript:void(0)";
            add.onclick = create_child_row;

            let remove = document.createElement('a');
            remove.className = "icon-font-1 mx-2";
            remove.href="javascript:void(0)"
            remove.onclick = remove_child_row;
            let icon = document.createElement('i');
            icon.className = "fas fa-plus-circle";
            add.appendChild(icon);
            let icon1 = document.createElement('i');
            icon1.className = "fas fa-minus-circle"

            remove.appendChild(icon1);

            seventhTd.appendChild(add);
            seventhTd.appendChild(remove);

            newTr.appendChild(seventhTd);

            inputContainer.appendChild(newTr);
        }
        function remove_child_row(){
            var tableBody = document.getElementById('table-body');
            if (tableBody.rows.length > 0) {
                tableBody.deleteRow(tableBody.rows.length - 1);
            }
        }
        function delete_all_rows(){
            var tableBody = document.getElementById('table-body'); 
            while (tableBody.rows.length > 0) { 
                tableBody.deleteRow(0); 
            }
        }
        document.getElementById('same_as_above').addEventListener('click', function() { 
            document.getElementById('permanent_province_id').selectedIndex = document.getElementById('temp_province_id').selectedIndex;
            document.getElementById('permanent_tehsil_id').selectedIndex = document.getElementById('temp_tehsil_id').selectedIndex;
            document.getElementById('permanent_district_id').selectedIndex = document.getElementById('temp_district_id').selectedIndex;
            document.getElementById('permanent_address').value = document.getElementById('temp_address').value;
        });
        // document.getElementById('addRowButton').addEventListener('click', function() { 
        // create_child_row();

        // });
        // document.getElementById('removeRowButton').addEventListener('click', function () {
        // remove_child_row();
        // });
        
        
        
       
        document.addEventListener('DOMContentLoaded', function() { 
            fetch('http://127.0.0.1:8000/tehsils') 
            .then(response => response.json()) 
            .then(data => { 
                var select = document.getElementById('temp_tehsil_id'); 
                data.forEach(function(tehsil) { 
                    var option = document.createElement('option'); 
                    option.value = tehsil.ID; 
                    option.textContent = tehsil.Teh_name; 
                    select.appendChild(option); 
                });
                
                var select = document.getElementById('permanent_tehsil_id'); 
                data.forEach(function(tehsil) { 
                    var option = document.createElement('option'); 
                    option.value = tehsil.ID; 
                    option.textContent = tehsil.Teh_name; 
                    select.appendChild(option); 
                });
            }) 
            .catch(error => console.error('Error fetching data:', error));
            
            fetch('http://127.0.0.1:8000/districts') 
            .then(response => response.json()) 
            .then(data => { 
                var select = document.getElementById('temp_district_id'); 
                data.forEach(function(district) { 
                    var option = document.createElement('option'); 
                    option.value = district.ID; 
                    option.textContent = district.Dis_name; 
                    select.appendChild(option); 
                }); 
                var select = document.getElementById('permanent_district_id'); 
                data.forEach(function(district) { 
                    var option = document.createElement('option'); 
                    option.value = district.ID; 
                    option.textContent = district.Dis_name; 
                    select.appendChild(option); 
                }); 
            }) 
            .catch(error => console.error('Error fetching data:', error)); 


            var maritalStatusSelect = document.getElementById('marital_status_id'); 
            var childrenDiv = document.getElementById('children_div'); 
            maritalStatusSelect.addEventListener('change', function() { 
                console.log(maritalStatusSelect.value);
                if (maritalStatusSelect.value != "1") { 
                    childrenDiv.classList.remove('hidden');
                    var child_input = document.getElementById('children_checkbox');
                    if (child_input.checkbox){
                        document.getElementById('table-responsive').classList.remove('hidden');    
                    } 
                } else { 
                    childrenDiv.classList.add('hidden');
                } 
            });
        });
            

    </script>
</x-app-layout>
