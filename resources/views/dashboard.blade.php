<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('HomePage') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Display the message if the user is an admin -->
                @if(auth()->user() && auth()->user()->RoleID == 1) <!-- Assuming RoleID 1 is for Admin -->
                    <div class="text-center text-xl font-semibold ">                
                     <livewire:manage-employees />

                    </div>
                @endif
                @if(auth()->user() && auth()->user()->RoleID == 2) <!-- Assuming RoleID 1 is for Admin -->
                <div>
                    <h2>"employees's account</h2>
                </div>
                @if(auth()->user() && auth()->user()->RoleID == 3) <!-- Assuming RoleID 1 is for Admin -->
                <div>
                    <h2>"employee-delivery's account</h2>
                </div>
                @if(auth()->user() && auth()->user()->RoleID == 4) <!-- Assuming RoleID 1 is for Admin -->
                <div>
                    <h2>"customer's account</h2>
                </div>

            @endif

                <!-- Include the Welcome component -->
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>

