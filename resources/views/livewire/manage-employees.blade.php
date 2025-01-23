<div class="container mx-auto p-6 text-black">
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold">Manage Employees</h2>
        <button wire:click="resetInputs" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Add New Employee
        </button>
    </div>

    <!-- Employee Form -->
    <div class="mb-4 bg-white p-4 shadow-lg rounded">
        <form wire:submit.prevent="saveEmployee">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium">Name</label>
                    <input type="text" wire:model="name" class="border p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" wire:model="email" class="border p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="phone_number" class="block text-sm font-medium">Phone Number</label>
                    <input type="text" wire:model="phone_number" class="border p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium">Address</label>
                    <input type="text" wire:model="address" class="border p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="role_id" class="block text-sm font-medium">Role</label>
                    <select wire:model="role_id" class="border p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                @if (!$employee_id)
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium">Password</label>
                    <input type="password" wire:model="password" class="border p-2 w-full rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                @endif
            </div>

            <div class="mb-4 flex justify-between">
                <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    {{ $employee_id ? 'Update Employee' : 'Create Employee' }}
                </button>
                @if($employee_id)
                <button type="button" wire:click="resetInputs" class="px-6 py-2 text-black">
                    Clear
                </button>
                @endif
            </div>
        </form>
    </div>

    <!-- Employee List -->
    <div class="mt-6 bg-white p-4 shadow-lg rounded">
        <table class="min-w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Phone Number</th>
                    <th class="px-4 py-2 border">Address</th>
                    <th class="px-4 py-2 border">Role</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td class="px-4 py-2 border">{{ $employee->name }}</td>
                        <td class="px-4 py-2 border">{{ $employee->email }}</td>
                        <td class="px-4 py-2 border">{{ $employee->phone_number }}</td>
                        <td class="px-4 py-2 border">{{ $employee->address }}</td>
                        <td class="px-4 py-2 border">{{ $employee->role->name }}</td>
                        <td class="px-4 py-2 border flex space-x-2">
                            <button wire:click="editEmployee({{ $employee->id }})" class="text-blue-500 hover:text-blue-600">Edit</button>
                            <button wire:click="deleteEmployee({{ $employee->id }})" class="text-red-500 hover:text-red-600">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
