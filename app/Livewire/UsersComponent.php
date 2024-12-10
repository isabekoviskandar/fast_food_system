<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class UsersComponent extends Component
{

    use WithFileUploads;

    public $users;
    public $userId, $name, $phone, $role, $image ,$password;
    public $isUpdateMode = false;
    public $showCreateForm = false;  

    public function mount()
    {
        $this->users = User::all();
    }

    // Function to show the create form
    public function create()
    {
        $this->resetFields();
        $this->showCreateForm = true; // Show create form
        $this->isUpdateMode = false;
    }

    // Function to store a new user
        public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'role' => 'required|string|max:50',
            'image' => 'nullable|image|max:1024',
            'password' => 'required|string|min:6',  // Password validation
        ]);

        $imagePath = $this->image ? $this->image->store('user_images', 'public') : null;

        User::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'role' => $this->role,
            'image' => $imagePath,
            'password' => bcrypt($this->password),  // Hash the password before saving
        ]);

        session()->flash('message', 'User created successfully!');
        $this->mount();
        $this->resetFields();
        $this->showCreateForm = false;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'role' => 'required|string|max:50',
            'image' => 'nullable|image|max:1024',
            'password' => 'nullable|string|min:6',  // Password validation (optional for update)
        ]);

        $user = User::findOrFail($this->userId);
        $imagePath = $this->image ? $this->image->store('user_images', 'public') : $user->image;

        // Only hash the password if it's provided
        $userData = [
            'name' => $this->name,
            'phone' => $this->phone,
            'role' => $this->role,
            'image' => $imagePath,
        ];

        if ($this->password) {
            $userData['password'] = bcrypt($this->password);  // Hash the password before saving
        }

        $user->update($userData);

        session()->flash('message', 'User updated successfully!');
        $this->mount();
        $this->resetFields();
        $this->showCreateForm = false;
    }


    // Function to delete user
    public function delete($userId)
    {
        User::findOrFail($userId)->delete();
        session()->flash('message', 'User deleted successfully!');
        $this->mount();
    }

    // Function to reset fields after create or update
    private function resetFields()
    {
        $this->userId = null;
        $this->name = '';
        $this->phone = '';
        $this->role = '';
        $this->image = null;
    }

    public function render()
    {
        return view('livewire.users-component');
    }
}
