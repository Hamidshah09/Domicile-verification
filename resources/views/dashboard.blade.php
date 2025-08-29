<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Applications') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    <form action="{{route('dashboard')}}" method="GET">
                      <div class="grid grid-cols-1 md:grid-cols-7 gap-2 mb-2">
                        <div>
                          <x-input-label for="search" :value="__('Search')" />                          
                          <x-text-input id="search" class="w-full" type="text" name="search" value="{{ old('search') }}" autofocus autocomplete="cnic" />
                        </div>
                        <div>
                          <x-input-label for="search_type" :value="__('Search Type')" />                          
                          <select name="search_type" id="search_type" class= "w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autofocus autocomplete="gender">
                            <option value="application_no" {{ old('search_type') == 'application_no' ? 'selected' : '' }}>Application No</option> 
                            <option value="cnic" {{ old('search_type') == 'cnic' ? 'selected' : '' }}>CNIC </option> 
                            <option value="name" {{ old('search_type') == 'name' ? 'selected' : '' }}>Name</option>
                          </select>
                        </div>
                        <div>
                          <x-input-label for="from" :value="__('From')" />
                          <x-text-input id="from" class="w-full" type="date" name="from" value="{{ old('from') }}" autofocus autocomplete="from" />
                        </div>
                        <div>
                          <x-input-label for="to" :value="__('To')" />
                          <x-text-input id="to" class="w-full" type="date" name="to" value="{{ old('to') }}" autofocus autocomplete="to" />
                        </div>
                        <div>
                            <x-input-label for="application_type" :value="__('Application  Type')" />
                            <select name="application_type_id" id="application_type" class= "w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autofocus autocomplete="gender">
                              <option value="" {{ old('application_type_id') == '' ? 'selected' : '' }}>All</option> 
                              <option value="1" {{ old('application_type_id') == '1' ? 'selected' : '' }}>New</option> 
                              <option value="2" {{ old('application_type_id') == '2' ? 'selected' : '' }}>Verification</option>
                            </select>
                        </div>
                        <div>
                          <x-input-label for="status" :value="__('Application Status')" />
                          <select name="application_status_id" id="status" class="w-full border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autofocus autocomplete="gender">
                            <option value="" {{ old('application_status_id') == '' ? 'selected' : '' }}>All</option> 
                            @foreach ($app_statuses as $app_status) 
                              <option value="{{ $app_status->id }}" {{ old('application_status_id') == $app_status->id ? 'selected' : '' }}>{{ $app_status->application_status }}</option> 
                            @endforeach
                          </select>
                        </div>
                        <div class="flex items-end justify-center">
                            <x-primary-button class="w-full" type="submit">
                              {{ __('Search') }}
                            </x-primary-button>
                        </div>
                      </div>
                    </form>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-white">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
                          <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Id</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">CNIC</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Applicant Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Application Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Application Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Applied on</th>
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Documents</th>
                            @if (auth()->user()->role==1)
                              <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Certificate</th>
                            @else
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Domicile Details</th>  
                            @endif
                            
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">History</th>
                            <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Action</th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                          @foreach ($user_apps as $app)
                          <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$app->id}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$app->applicants->cnic}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$app->applicants->name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$app->application_types->application_type}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm" id="{{$app->id}}">{{$app->application_statuses->application_status}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$app->created_at}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                              @foreach ($app->documents as $documents)
                                <a class="block" href="{{asset('/storage/'.$documents->document_path)}}"><i class="fas fa-passport"></i></a>  
                              @endforeach
                            </td>
                            @if (auth()->user()->role==1)
                              @if ($app->application_types->id==2 and $app->application_statuses->id==4)
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><a class="block" href="{{asset('/storage/certificates/verification'.$app->id .'.pdf')}}">View Certificate</a>  </td>
                              @else
                                <td class="px-6 py-4 whitespace-nowrap text-sm"><a class="block" href="{{asset('/storage/certificates/form-p'.$app->id .'.pdf')}}">View Form P</a>  </td>    
                              @endif
                            @else
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-center icon-font-1"><a href="https://admin-icta.nitb.gov.pk/domicile/applications?keyword={{$app->applicants->cnic}}&from=&to=&status=" target="_blank"><i class="fas fa-file-import"></i></a></td>    
                            @endif
                            
                        
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                              <a href="{{route('chat', $app->id)}}" type="button" class="icon-font-1 flex flex-row">
                                <i class="far fa-comments"></i>
                                <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-100 rounded-full">
                                {{$app->conversations->count()}}
                                </span>
                              </a>
                              {{-- <a href="{{route('chat', $app->id)}}">Messages</a>  --}}
                            </td>
                            @if (auth()->user()->role==2 or auth()->user()->role==3)
                                @if (auth()->user()->role==2)
                                  @php
                                  if($app->application_type_id==1){
                                    $approve_id=2;
                                    $reject_id=3;
                                    
                                  }else{
                                    $approve_id=4;
                                    $reject_id=5;
                                  }
                                  @endphp
                                  <td class="icon-font text-center">
                                    <a href="#" onclick="updateStatus(event, {{$app->id}}, {{$approve_id}})" title="Approve">
                                      <i id="" class="fas fa-check" ></i>
                                    </a>
                                    <a href="#" onclick="updateStatus(event, {{$app->id}}, {{$reject_id}})" title="Reject">
                                      <i class="fas fa-times" ></i>
                                    </a>
                                    <a href="#" onclick="updateStatus(event, {{$app->id}},1)" title="Sent Back">
                                      <i class="fas fa-reply" ></i>
                                    </a>
                                  </td>
                                @else
                                  @php
                                    if($app->application_type_id==1){
                                      $approve_id=7;
                                      $reject_id=3;
                                      
                                    }else{
                                      $approve_id=7;
                                      $reject_id=5;
                                    }
                                  @endphp
                                  <td class="icon-font text-center w-8px">
                                    <a href="#" onclick="updateStatus(event, {{$app->id}}, {{$approve_id}})" title="Sent for Approval">
                                      <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <a href="#" onclick="updateStatus(event, {{$app->id}}, {{$reject_id}})" title="Reject">
                                      <i class="fas fa-times" ></i>
                                    </a>
                                    <a href="#" onclick="updateStatus(event, {{$app->id}},6)" title="Need Additional Docs">
                                      <i class="fas fa-file-medical"></i>
                                    </a>
                                  </td>    
                                @endif
                            @else
                              <td class="text-center">
                                @if (auth()->user()->user_type_id==1)
                                  @if($app->application_type_id==1)  
                                    <a href="{{route('editnew', $app->id)}}" class="icon-font"><i class="fas fa-edit"></i></a>
                                  @else
                                    <a href="{{route('editverification', $app->id)}}" class="icon-font"><i class="fas fa-edit"></i></a>    
                                  @endif
                                @else
                                    <a href="{{route('editorgverification', $app->id)}}" class="icon-font"><i class="fas fa-edit"></i></a>    
                                @endif
                                
                              </td>
                            @endif
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                    <div>
                      {{ $user_apps->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->role!=1)
    <div id="myModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
      <form class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 w-full max-w-md" action="" method="POST" id="statusForm">
        @csrf

        <!-- Status Selection -->
        <div class="mb-4">
          <x-input-label for="status_id" :value="__('Select Status')" class="text-gray-800 dark:text-gray-200" />
          <select class="block mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="status_id" id="status_id" :value="old('status_id')" required autofocus autocomplete="status_id">
            @foreach ($app_statuses as $app_status)
              @if($app_status->allowed_to != 2)
                <option value="{{ $app_status->id }}">{{ $app_status->application_status }}</option>
              @endif
              @if(auth()->user()->role == 2 && $app_status->allowed_to == 2)
                <option value="{{ $app_status->id }}">{{ $app_status->application_status }}</option>
              @endif
            @endforeach
          </select>
          <x-input-error :messages="$errors->get('status_id')" class="mt-2 text-red-500" />
        </div>

        <!-- Remarks Input -->
        <div class="mb-4">
          <x-input-label for="remarks" :value="__('Remarks')" class="text-gray-800 dark:text-gray-200" />
          <x-text-input id="remarks" class="block w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" type="text" name="remarks" :value="old('remarks')" required autofocus autocomplete="remarks" />
          <x-input-error :messages="$errors->get('remarks')" class="mt-2 text-red-500" />
        </div>

        <!-- Modal Footer Buttons -->
        <div class="flex justify-end space-x-3 mt-6">
          <button type="button" id="modal_close_btn" class="px-4 py-2 rounded-lg bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-600 transition">Close</button>
          <button type="submit" id="modal_save_btn" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">Save changes</button>
        </div>
      </form>
    </div>


    <script>
    var modal = document.getElementById("myModal");
    var modal_close_btn = document.getElementById("modal_close_btn");
    

    function updateStatus(event, app_id, status_id){
      var statuses = {
      1:{status:"Pending", remarks:"Your Application is sent for re-checking."},
      2:{status:"Approved", remarks:"Your Application is Approved."},
      3:{status:"Rejected", remarks:"Your Application is Rejected."},
      4:{status:"Verified", remarks:"Your Domicile is verified."},
      5:{status:"Not Verified", remarks:"Your Domicile is not verified."},
      6:{status:"Need Document(s)", remarks:"Some additional documents are required."},
      7:{status:"Sent for Approval", remarks:"Your application is sent for approval of competent authority."}
      }
      event.preventDefault();
      var xhr = new XMLHttpRequest(); 
      xhr.open('POST', "http://127.0.0.1:8000/updatestatus/" + app_id , true); 
      xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8'); 
      xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content')); 
      xhr.onreadystatechange = function() { 
        if (xhr.readyState === 4 && xhr.status === 200) { 
          var cell = document.getElementById(app_id);
          cell.innerText = statuses[status_id].status; 
          cell.style.animation = 'glow 1s ease-in-out infinite alternate';
          setTimeout(function() { 
            cell.style.animation = ''; 
          }, 3000);
        } 
      }; 
      var data = JSON.stringify({ status_id: status_id, remarks:statuses[status_id].remarks});
      xhr.send(data);
    }
    
    // function open_modal(event) {
      
    //   event.preventDefault();
    //   // modal.style.display = "flex";
    //   console.log(event.target.name);
    //   return
    //   var status_form = document.getElementById('statusForm');
    //   status_form.action = "http://127.0.0.1:8000/updatestatus/" + event.target.id 
    //   document.getElementById('status_id').value = event.target.status_id;
    //   document.getElementById('remarks').value = 'this is test remarks.';
    //   status_form.submit();
    // }

    // modal_close_btn.onclick =  function close_modal() {
    //     modal.style.display = "none";
    // }
    // window.onclick = function(event) {
    //     if (event.target == modal) {
    //         modal.style.display = "none";
    //     }
    // }
    </script>
    @endif    
</x-app-layout>
