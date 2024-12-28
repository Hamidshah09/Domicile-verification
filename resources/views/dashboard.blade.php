<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Applications') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
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
                            <th class="text-center">History</th>
                            @if (auth()->user()->role==2)
                                <th class="text-center">Action</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($user_apps as $app)
                          <tr>
                            <td>{{$app->id}}</td>
                            <td>{{$app->applicants->cnic}}</td>
                            <td>{{$app->applicants->name}}</td>
                            <td>{{$app->application_types->application_type}}</td>
                            <td>{{$app->application_statuses->application_status}}</td>
                            <td>{{$app->created_at}}</td>
                            <td class="text-center">
                              @foreach ($app->documents as $documents)
                                <a class="block" href="{{asset('/storage/'.$documents->document_path)}}">View Document</a>  
                              @endforeach
                            </td>
                            <td class="text-center">
                              <a href="{{route('chat', $app->id)}}" type="button" class="inline-flex items-center px-5 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Messages
                                <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                {{$app->conversations->count()}}
                                </span>
                              </a>
                              {{-- <a href="{{route('chat', $app->id)}}">Messages</a>  --}}
                            </td>
                            @if (auth()->user()->role==2)
                                <td class="icon-font text-center"><a href="#" onclick="open_modal(event)"><i id="{{$app->id}}" class="fas fa-highlighter" ></i></a></td>
                            @endif
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="marking-modal">
      <form class="marking-modal-content" action="" method="POST" id="statusForm">
        @csrf
        <div class="">
          <label for="">Select Status</label>
          <select class="block w-full rounded" name="status_id" id="status_id">
              <option value="2">Approved</option>
              <option value="3">Rejected</option>
              <option value="4">Verified</option>
              <option value="5">Need Document(s)</option>
          </select>
        </div>
        <div class="mt-2">
          <label class="" for="remarks">Remarks</label>
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
    function open_modal(event) {
      
      event.preventDefault();
      modal.style.display = "block";
      document.getElementById('statusForm').action = "http://127.0.0.1:8000/updatestatus/" + event.target.id 
    }

    modal_close_btn.onclick =  function close_modal() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>    
</x-app-layout>
