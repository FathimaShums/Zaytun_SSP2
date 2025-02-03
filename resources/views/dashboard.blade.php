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
    <div class="text-center text-xl font-semibold">                
        <livewire:manage-employees />
    </div>
@elseif(auth()->user() && auth()->user()->RoleID == 2) <!-- Assuming RoleID 2 is for Employee -->
    <div>
        <h2>Employee's account</h2>
        @livewire('manage-food-items')
        <livewire:manage-categories>
            <livewire:order-management />
    </div>
@elseif(auth()->user() && auth()->user()->RoleID == 3) <!-- Assuming RoleID 3 is for Employee Delivery -->
    <div>
        <h2>Employee Delivery's account</h2>
        @livewire('assigned-orders')
    </div>
@elseif(auth()->user() && auth()->user()->RoleID == 4) <!-- Assuming RoleID 4 is for Customer -->
    <div>
        
        @livewire('food-items-by-category')
        
    </div>
    <div>
     
    </div>
@endif



                <!-- Include the Welcome component -->
     
            </div>
        </div>
    </div>
</x-app-layout>