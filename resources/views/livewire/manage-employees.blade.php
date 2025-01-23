<div class="container mx-auto p-4">
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4">
        <h2 class="text-xl font-bold">Manage Employees</h2>
        <button wire:click="resetInputs" class="px-4 py-2 bg-blue-500 text-white rounded">Add New Employee</button>
    </div>

    <!-- Employee Form -->
    <div class="mb-4">
        <form wire:submit.prevent="saveEmployee">
            <div class="mb-4">
                <label for="name" class="block">Name</label>
                <input type="text" wire:model="name" class="border p-2 w-full">
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block">Email</label>
                <input type="email" wire:model="email" class="border p-2 w-full">
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block">Phone Number</label>
                <input type="text" wire:model="phone_number" class="border p-2 w-full">
                @error('phone_number') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="address" class="block">Address</label>
                <input type="text" wire:model="address" class="border p-2 w-full">
                @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="role_id" class="block">Role</label>
                <select wire:model="role_id" class="border p-2 w-full">
                    <option value="">Select Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            @if (!$employee_id)
            <div class="mb-4">
                <label for="password" class="block">Password</label>
                <input type="password" wire:model="password" class="border p-2 w-full">
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            @endif

            <div class="mb-4">
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">
                    {{ $employee_id ? 'Update Employee' : 'Create Employee' }}
                </button>
            </div>
        </form>
    </div>

    <!-- Employee List -->
    <div>
        <table class="min-w-full border-collapse border border-gray-200">
            <thead>
                <tr>
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
                        <td class="px-4 py-2 border">
                            <button wire:click="editEmployee({{ $employee->id }})" class="text-blue-500">Edit</button>
                            |
                            <button wire:click="deleteEmployee({{ $employee->id }})" class="text-red-500">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

