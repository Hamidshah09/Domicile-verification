<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Applications') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="styled-table">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Application Type</th>
                            <th>Application Status</th>
                            <th>Documents</th>
                            <th>Applied on</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($user_apps as $app)
                          <tr>
                            <th scope="row">{{$app->id}}</th>
                            <td>{{$app->application_types->application_type}}</td>
                            <td>{{$app->application_statuses->application_status}}</td>
                            <td><a href="{{asset('/storage/'.$app->scaned_docs)}}">View</a></td>
                            <td>{{$app->created_at}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>    
</x-app-layout>
