<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Display the message if the user is an admin -->
                @if(auth()->user() && auth()->user()->RoleID == 1) <!-- Assuming RoleID 1 is for Admin -->
                    <div class="text-center text-xl font-semibold text-green-500">
                        Hello, you've logged in as the admin.
                        <livewire:path.to.ManageEmployees />

                    </div>
                @endif

                <!-- Include the Welcome component -->
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>

