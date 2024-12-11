<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthComponent extends Component
{
    public $phone = '';
    public $password = '';
    public $error = '';

    protected $rules = [
        'phone' => 'required|string',
        'password' => 'required|string'
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['phone' => $this->phone, 'password' => $this->password])) {
            $user = Auth::user(); 
            
            if ($user->role === 'admin') { 
                Session::flash('success', 'Welcome, Admin!');
                return $this->redirect('/category'); 
            } else {
                Session::flash('success', 'Login successful!');
                return $this->redirect('/user'); 
            }
        } else {
            $this->error = 'Invalid phone number or password';
        }
    }

    public function render()
    {
        return view('livewire.auth-component')->layout('components.layouts.empty');
    }
}