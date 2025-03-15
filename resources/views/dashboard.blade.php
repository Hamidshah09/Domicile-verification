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
                      <div class="flex flex-row flex-w">
                        <x-text-input id="search" class="mt-1 w-48 p-2 mx-2" type="text" name="search" value="{{ old('search') }}" autofocus autocomplete="cnic" />
                        <select name="search_type" id="search_type" class= "w-48 mt-1 border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autofocus autocomplete="gender">
                          <option value="application_no" {{ old('search_type') == 'application_no' ? 'selected' : '' }}>Application No</option> 
                          <option value="cnic" {{ old('search_type') == 'cnic' ? 'selected' : '' }}>CNIC </option> 
                          <option value="name" {{ old('search_type') == 'name' ? 'selected' : '' }}>Name</option>
                        </select>
                        <div>
                          <label for="" class="mt-3 mx-2">From</label>
                          <x-text-input id="from" class="mt-1 p-2 w-48" type="date" name="from" value="{{ old('from') }}" autofocus autocomplete="from" />
                        </div>
                        <div>
                          <label for="" class="mt-3 mx-2">To</label>
                        <x-text-input id="to" class="mt-1 p-2 w-48" type="date" name="to" value="{{ old('to') }}" autofocus autocomplete="to" />
                        </div>
                        <select name="application_type_id" id="application_type" class= "w-48 mt-1 mx-2 border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autofocus autocomplete="gender">
                          <option value="" {{ old('application_type_id') == '' ? 'selected' : '' }}>All</option> 
                          <option value="1" {{ old('application_type_id') == '1' ? 'selected' : '' }}>New</option> 
                          <option value="2" {{ old('application_type_id') == '2' ? 'selected' : '' }}>Verification</option>
                        </select>
                        <select name="application_status_id" id="status" class="w-48 mt-1 border-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autofocus autocomplete="gender">
                          <option value="" {{ old('application_status_id') == '' ? 'selected' : '' }}>All</option> 
                          @foreach ($app_statuses as $app_status) 
                            <option value="{{ $app_status->id }}" {{ old('application_status_id') == $app_status->id ? 'selected' : '' }}>{{ $app_status->application_status }}</option> 
                          @endforeach
                        </select>
                        <x-primary-button class="mt-1 ms-3" type="submit">
                          {{ __('Search') }}
                        </x-primary-button>
                      </div>
                    </form>
                    <table class="styled-table">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>CNIC</th>
                            <th>Applicant Name</th>
                            <th>Application Type</th>
                            <th>Application Status</th>
                            <th>Applied on</th>
                            <th class="text-center">Documents</th>
                            @if (auth()->user()->role==1)
                              <th class="text-center">Certificate</th>
                            @else
                            <th class="text-center">Domicile Details</th>  
                            @endif
                            
                            <th class="text-center">History</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($user_apps as $app)
                          <tr>
                            <td>{{$app->id}}</td>
                            <td>{{$app->applicants->cnic}}</td>
                            <td>{{$app->applicants->name}}</td>
                            <td>{{$app->application_types->application_type}}</td>
                            <td id="{{$app->id}}">{{$app->application_statuses->application_status}}</td>
                            <td>{{$app->created_at}}</td>
                            <td class="text-center icon-font-1">
                              @foreach ($app->documents as $documents)
                                <a class="block" href="{{asset('/storage/'.$documents->document_path)}}"><i class="fas fa-passport"></i></a>  
                              @endforeach
                            </td>
                            @if (auth()->user()->role==1)
                              @if ($app->application_types->id==2 and $app->application_statuses->id==4)
                                <td class="text-center"><a class="block" href="{{asset('/storage/certificates/verification'.$app->id .'.pdf')}}">View Certificate</a>  </td>
                              @else
                              <td></td>    
                              @endif
                            @else
                              <td class="text-center icon-font-1"><a href="https://admin-icta.nitb.gov.pk/domicile/applications?keyword={{$app->applicants->cnic}}&from=&to=&status=" target="_blank"><i class="fas fa-file-import"></i></a></td>    
                            @endif
                            
                        
                            <td class="text-center">
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
                                  <td class="icon-font text-center w-8px">
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
    <div id="myModal" class="marking-modal justify-center items-center">
      <form class="px-4 py-4 w-30 rounded bg-white dark:bg-gray-800" action="" method="POST" id="statusForm">
        @csrf
        <div class="mt-3">
          <x-input-label for="status_id" :value="__('Select Status')" />
          <select class="block mt-1 w-full rounded bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100" name="status_id" id="status_id" :value="old('status_id')" required autofocus autocomplete="status_id">
            @foreach ($app_statuses as $app_status)
              
              @if($app_status->allowed_to!=2)
                <option value="{{$app_status->id}}">{{$app_status->application_status}}</option>
              @endif
              @if (auth()->user()->role==2 and $app_status->allowed_to==2)
                <option value="{{$app_status->id}}">{{$app_status->application_status}}</option>
              @endif
            @endforeach
          </select>
          <x-input-error :messages="$errors->get('status_id')" class="mt-2" />
        </div>
        <div class="mt-3">
          <x-input-label for="remarks" :value="__('Remarks')" />
          <x-text-input id="remarks" class="block w-full p-2 border" type="remarks" name="remarks" :value="old('remarks')" required autofocus autocomplete="remarks" />
          <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
        </div>
        <div class="modal-footer mt-3 flex flex-row justify-end">
          <button type="button" id="modal_close_btn" class="close-btn mr-2">Close</button>
          <button type="submit" id="modal_save_btn" class="save-btn mr-2">Save changes</button>
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
