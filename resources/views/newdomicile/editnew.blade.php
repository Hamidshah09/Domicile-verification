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
                    <form action="{{route('updatenew', $application->id)}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div class="mx-2">
                            Note: You can only apply for your domicile and your childern domicile.
                        </div>
                        <div class="flex flex-row flex-w">
                            
                            <div class="form-control">
                                <x-input-label for="cnic" :value="__('CNIC')" />
                                <x-text-input id="cnic" class="block mt-1 w-full p-2" type="text" name="cnic" :value="old('cnic', $application->applicants->cnic)" required autofocus autocomplete="cnic" />
                                <x-input-error :messages="$errors->get('cnic')" class="mt-2" />
                            </div>
        
                            <div class="form-control">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full p-2" type="text" name="name" :value="old('name', $application->applicants->name)" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="form-control">
                                <x-input-label for="fathername" :value="__('Father/Husband Name')" />
                                <x-text-input id="fathername" class="block mt-1 w-full p-2" type="text" name="fathername" :value="old('fathername', $application->applicants->fathername)" required autofocus autocomplete="fathername" />
                                <x-input-error :messages="$errors->get('fathername')" class="mt-2" />
                            </div>


                            <div class="form-control">
                                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                                <x-text-input id="date_of_birth" class="block mt-1 w-full p-2" type="date" name="date_of_birth" :value="old('date_of_birth', $application->applicants->date_of_birth)" required autofocus autocomplete="date_of_birth" />
                                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                            </div>

                            <div class="form-control">
                                <x-input-label for="gender" :value="__('Gender')" />
                                <select name="gender_id" id="gender_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('gender_id', $application->applicants->gender_id)" required autofocus autocomplete="gender">
                                    <option value="">Select Gender</option>
                                    @foreach ($genders as $gender)
                                        @if ($application->applicants->gender_id==$gender->id)
                                            <option selected value="{{$gender->id}}">{{$gender->gender}} </option>
                                        @else
                                            <option value="{{$gender->id}}">{{$gender->gender}} </option>    
                                        @endif                                        
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>

                            <div class="form-control">
                                <x-input-label for="place_of_birth" :value="__('Place of Birth')" />
                                <x-text-input id="place_of_birth" class="block mt-1 w-full p-2" type="text" name="place_of_birth" :value="old('place_of_birth', $application->applicants->place_of_birth)" max="45" required autofocus autocomplete="place_of_birth" />
                                <x-input-error :messages="$errors->get('place_of_birth')" class="mt-2" />
                            </div>

                            <div class="form-control">
                                <x-input-label for="marital_status" :value="__('Marital Status')" />
                                <select name="marital_status_id" id="marital_status_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('marital_status_id', $application->applicants->marital_status_id)" required autofocus autocomplete="marital_status">
                                    @foreach ($marital_statuses as $marital_status)
                                        <option value="">Select Marital Status</option>
                                        @if ($application->applicants->marital_status_id==$marital_status->id)
                                            <option selected value="{{$marital_status->id}}">{{$marital_status->marital_status}}</option>     
                                        @else
                                        <option value="{{$marital_status->id}}">{{$marital_status->marital_status}}</option>     
                                        @endif
                                    @endforeach    
                                </select>
                                <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="religion" :value="__('Religion')" />
                                <x-text-input id="religion" class="block mt-1 w-full p-2" type="text" max="45" name="religion" :value="old('religion', $application->applicants->religion)" required autofocus autocomplete="religion" />
                                <x-input-error :messages="$errors->get('religion')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="qualification_id" :value="__('Qualification')" />
                                <select name="qualification_id" id="qualification_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('qualification_id', $application->applicants->qualification_id)" autofocus autocomplete="qualification_id">
                                    @foreach ($qualifications as $qualification)
                                        <option value="">Select Qualification</option>
                                        @if ($application->applicants->qualification_id==$qualification->id)
                                            <option selected value="{{$qualification->id}}">{{$qualification->qualification}}</option>    
                                        @else
                                            <option value="{{$qualification->id}}">{{$qualification->qualification}}</option>    
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('qualification_id')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="occupation_id" :value="__('Ocupation')" />
                                <select name="occupation_id" id="occupation_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('occupation_id', $application->applicants->occupation_id)" autofocus autocomplete="occupation_id">
                                    @foreach ($occupations as $occupation)
                                        <option value="">Select Occupation</option>
                                        @if ($application->applicants->occupation_id==$occupation->id)
                                            <option selected value="{{$occupation->id}}">{{$occupation->occupation}}</option>    
                                        @else
                                            <option value="{{$occupation->id}}">{{$occupation->occupation}}</option>    
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('occupation_id')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="contact" :value="__('Contact')" />
                                <x-text-input id="contact" class="block mt-1 w-full p-2" type="text" max="11" name="contact" :value="old('contact', $application->applicants->contact)" min="11" max=11 autofocus autocomplete="contact" />
                                <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="date_of_arrival" :value="__('Date of arrival')" />
                                <x-text-input id="date_of_arrival" class="block mt-1 w-full p-2" type="date" name="date_of_arrival" :value="old('date_of_arrival', $application->applicants->date_of_arrival)" autofocus autocomplete="date_of_arrival" />
                                <x-input-error :messages="$errors->get('date_of_arrival')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex flex-w">
                            <div class="form-control">
                                <x-input-label for="temp_province_id" :value="__('Present Province')" />
                                <select name="temporaryAddress_province_id" id="temp_province_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('temporaryAddress[province_id]')" required autofocus autocomplete="temp_province_id">
                                    <option value="" selected="">Select Province</option>
                                    @foreach ($provinces as $province)
                                        @if ($province->id==$application->applicants->temporaryAddress_province_id)
                                            <option selected value="{{$province->id}}"> {{$province->province}}</option>        
                                        @else
                                            <option value="{{$province->id}}"> {{$province->province}}</option>        
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('temporaryAddress_province_id')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="temp_district_id" :value="__('Present District')" />
                                <select name="temporaryAddress_district_id" id="temp_district_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('temporaryAddress_district_id')" required autofocus autocomplete="temp_district_id">
                                    <option value="">Select District</option>
                                    @foreach ($districts as $district)
                                        @if ($district->id==$application->applicants->temporaryAddress_district_id)
                                            <option selected value="{{$district->id}}">{{$district->Dis_Name}}</option>
                                        @else
                                            <option value="{{$district->id}}">{{$district->Dis_Name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('temporaryAddress_district_id')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="temp_tehsil_id" :value="__('Present Tehsil')" />
                                <select name="temporaryAddress_tehsil_id" id="temp_tehsil_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('temporaryAddress_tehsil_id')" required autofocus autocomplete="temp_tehsil_id">
                                    <option value="" >Select Tehsil</option>
                                    @foreach ($tehsils as $tehsil)
                                        @if ($tehsil->id==$application->applicants->temporaryAddress_tehsil_id)
                                            <option selected value="{{$tehsil->id}}">{{$tehsil->Teh_name}}</option>
                                        @else
                                            <option value="{{$tehsil->id}}">{{$tehsil->Teh_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('temporaryAddress_tehsil_id')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex flex-w">
                                <x-input-label for="temp_address" :value="__('Present Address')" class="mx-3"/>
                                <x-text-input id="temp_address" class="block mt-1 w-full p-2 mx-2" max="100" type="text" name="temporaryAddress" :value="old('temporaryAddress', $application->applicants->temporaryAddress)" required autofocus autocomplete="temporaryAddress" />
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
                                    <option value="" selected="">Select Province</option>
                                    @foreach ($provinces as $province)
                                        @if ($province->id==$application->applicants->permanentAddress_province_id)
                                            <option selected value="{{$province->id}}"> {{$province->province}}</option>        
                                        @else
                                            <option value="{{$province->id}}"> {{$province->province}}</option>        
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('permanentAddress_province_id')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="permanent_district_id" :value="__('Permanent District')" />
                                <select name="permanentAddress_district_id" id="permanent_district_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('permanentAddress_district_id')" required autofocus autocomplete="permanent_district_id">
                                    <option value="">Select District</option>
                                    @foreach ($districts as $district)
                                        @if ($district->id==$application->applicants->permanentAddress_district_id)
                                            <option selected value="{{$district->id}}">{{$district->Dis_Name}}</option>
                                        @else
                                            <option value="{{$district->id}}">{{$district->Dis_Name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('permanentAddress_district_id')" class="mt-2" />
                            </div>
                            <div class="form-control">
                                <x-input-label for="permanent_tehsil_id" :value="__('Permanent Tehsil')" />
                                <select name="permanentAddress_tehsil_id" id="permanent_tehsil_id" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :value="old('permanentAddress_tehsil_id')" required autofocus autocomplete="permanent_tehsil_id">
                                    <option value="" >Select Tehsil</option>
                                    @foreach ($tehsils as $tehsil)
                                        @if ($tehsil->id==$application->applicants->permanentAddress_tehsil_id)
                                            <option selected value="{{$tehsil->id}}">{{$tehsil->Teh_name}}</option>
                                        @else
                                            <option value="{{$tehsil->id}}">{{$tehsil->Teh_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('permanentAddress_tehsil_id')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex flex-w">
                                <x-input-label for="permanent_address" :value="__('Permanent Address')" class="mx-3"/>
                                <x-text-input id="permanent_address" class="block mt-1 w-full p-2 mx-2" max="100" type="text" name="permanentAddress" :value="old('permanentAddress', $application->applicants->permanentAddress)" required autofocus autocomplete="permanentAddress" />
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
                            @if ($application->applicants->childerns->count()>0)
                                <table class="styled-table" id="table-responsive">
                            @else
                                <table class="styled-table hidden" id="table-responsive">
                            @endif
                                <thead>     
                                    <th>Child Name</th>
                                    <th>Child CNIC</th>
                                    <th>Child Date of Birth</th>
                                    <th>Child Gender</th>
                                    <th>Add Child</th>   
                                </thead>
                                <tbody id="table-body">
                                    @foreach ($application->applicants->childerns as $child)
                                        <tr>
                                            
                                            <td class="hidden"><input type="hidden" name="childern[{{$child->id}}]id" value="{{$child->id}}"></td>
                                            <td><input type="text" name="childern[{{$child->id}}]name" class="border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full p-2 mx-2"></td>
                                            <td><input type="text" name="childern[{{$child->id}}]cnic" max="13" min="13" class="border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full p-2 mx-2"></td>
                                            <td><input type="text" name="childern[{{$child->id}}]cnic" max="13" min="13" class="border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full p-2 mx-2"></td>
                                        </tr>
                                    @endforeach    
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="flex flex-row justify-end">
                            <x-primary-button class="ms-3" type="submit">
                                {{ __('Update') }}
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
            document.getElementById('table-responsive').classList.toggle('hidden');
            
            if (child_input.checked){
                create_child_row();
            }else{
                delete_all_rows();
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
        // create_child_row();

        // });
        // document.getElementById('removeRowButton').addEventListener('click', function () {
        // remove_child_row();
        // });
        
        
        
        document.addEventListener('DOMContentLoaded', function() { 
            // Function to toggle the visibility of the scan document cell 
            function toggleScanDocTd(checkbox) { 
                const th = document.getElementById('scan_doc_th');
                const currentTd = checkbox.closest('td'); 
                const nextTd = currentTd.nextElementSibling; 
                if (checkbox.checked) { 
                    nextTd.classList.remove('hidden'); 
                    th.classList.remove('hidden'); 
                } else { 
                    nextTd.classList.add('hidden');
                    th.classList.add('hidden'); 
                }
            } 
            // Add event listener to the entire table body 
            const tableBody = document.getElementById('table-body'); 
            tableBody.addEventListener('change', function(event) { 
                if (event.target && event.target.id.startsWith('child_is_applicant')) { 
                    toggleScanDocTd(event.target); 
                } 
            }); 
            // Initialize the visibility for any existing checkboxes 
            const checkboxes = tableBody.querySelectorAll('input[type="checkbox"][id^="child_is_applicant"]'); 
            checkboxes.forEach(toggleScanDocTd);
        });
    </script>
</x-app-layout>
