<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <div class="chat-container">
                    @if ($errors->any())
                        <div class="my-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="color:rgb(235, 59, 59);">{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                      @endif
                    
                    <form class="flex flex-row justify-between w-full" action="{{route('submitchat', $conversions[0]->application_id)}}" method="POST">
                      @csrf
                      <x-text-input id="message" class="block mt-1 w-full p-2" type="text" name="message" :value="old('message')" required autofocus autocomplete="message" placeholder="Type a message..."/>
                      {{-- <input class="w-full m-2 rounded" type="text" id="chatInput" name="message" placeholder="Type a message..." /> --}}
                      <button type="submit" class="save-btn">Send</button>
                    </form>
                    <hr class="mt-3 mb-3" >
                    <div class="chat-body" id="chatBody">
                      @foreach ($conversions as $chat)
                        @if($chat->sender_id == auth()->user()->id)
                          <div class="user-chat w-full">
                            <div class="font-semibold">{{$chat->chat}} <x-badge style='blue' name='{{$chat->sender->name }}'/></div>
                            <div class="mx-2 mt-2">{{$chat->created_at}}</div>  
                          </div>
                        @else
                          <div class="">
                            <div class="font-semibold"><x-badge style='green' name='{{$chat->sender->name }}'/>{{$chat->chat }}</div>
                            <div class="mx-2 mt-2">{{$chat->created_at}}</div>
                          </div>
                        @endif                         
                      @endforeach
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
        
</x-app-layout>
