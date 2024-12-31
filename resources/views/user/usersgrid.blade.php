<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{route('newuser')}}" class='ms-3 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>New User</a>
                    @if (session('status'))
                      <div class="w-full bg-green-900 text-white rounded px-2 py-2 mt-2 mx-2">
                        {{session('status')}}    
                      </div>
                    @endif  
                    <table class="styled-table">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>User Type</th>
                            <th>CNIC</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Created at</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($users as $user)
                          <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->user_types->user_type}}</td>
                            <td>{{$user->cnic}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->user_statuses->status}}</td>
                            <td>{{$user->role_types->role}}</td>
                            <td>{{$user->created_at}}</td>
                            <td><a href="{{route('users.edit', $user->id)}}"><i class="far fa-edit"></i></a></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>    
</x-app-layout>
