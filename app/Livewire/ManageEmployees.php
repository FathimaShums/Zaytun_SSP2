<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployerCredentialsMail;

class ManageEmployees extends Component
{
    public $employees;
    public $name, $email, $phone_number, $address, $role_id, $password;
    public $employee_id = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone_number' => 'required|string|max:15',  // Adjust the validation for phone number
        'address' => 'required|string|max:255',  // Add address validation
        'role_id' => 'required|in:2,3', // Role 2 or 3 (employee)
        'password' => 'required|string|min:8',
    ];

    public function mount()
    {
        $this->employees = User::whereIn('RoleID', [2, 3])->get();
    }

    // Create or update employee
    public function saveEmployee()
    {
        $this->validate();

        if ($this->employee_id) {
            $employee = User::find($this->employee_id);
            $employee->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'address' => $this->address,
                'RoleID' => $this->role_id,
            ]);
        } else {
            $employee = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'address' => $this->address,
                'password' => Hash::make($this->password),
                'RoleID' => $this->role_id,
            ]);

            // Send email to new employee
            Mail::to($employee->email)->send(new EmployerCredentialsMail($employee));
        }

        $this->resetInputs();
        $this->employees = User::whereIn('RoleID', [2, 3])->get();
        session()->flash('message', $this->employee_id ? 'Employee updated successfully.' : 'Employee created successfully.');
    }

    // Reset form fields
    public function resetInputs()
    {
        $this->name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->address = '';
        $this->role_id = null;
        $this->password = '';
        $this->employee_id = null;
    }

    // Edit employee
    public function editEmployee($id)
    {
        $employee = User::find($id);
        $this->name = $employee->name;
        $this->email = $employee->email;
        $this->phone_number = $employee->phone_number;
        $this->address = $employee->address;
        $this->role_id = $employee->RoleID;
        $this->employee_id = $employee->id;
    }

    // Delete employee
    public function deleteEmployee($id)
    {
        User::find($id)->delete();
        $this->employees = User::whereIn('RoleID', [2, 3])->get();
        session()->flash('message', 'Employee deleted successfully.');
    }

    public function render()
    {
        return view('livewire.manage-employees', [
            'roles' => Role::whereIn('id', [2, 3])->get(),
        ]);
    }
}