<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    <a href="{{route('newuser')}}" class='ms-3 inline-flex items-center px-4 py-2 bg-gray-800 mb-3 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>New User</a>
                    @if (session('status'))
                      <div class="w-full bg-green-900 text-white rounded px-2 py-2 mt-2 mx-2">
                        {{session('status')}}    
                      </div>
                    @endif  
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-white">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
                          <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Id</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">User Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">CNIC</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">User Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Created at</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($users as $user)
                          <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$user->id}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$user->user_types->user_type}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$user->cnic}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$user->name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$user->email}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$user->user_statuses->status}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$user->role_types->role}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{$user->created_at}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center"><a href="{{route('users.edit', $user->id)}}"><i class="far fa-edit"></i></a></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <div class="my-3">
                        {{ $users->links() }}
                      </div>
                </div>
            </div>
        </div>
    </div>    
</x-app-layout>
