<?php

namespace App\Livewire;

use App\Models\Jurnal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AuthComponent extends Component
{
    public $phone;
    public $password;

    protected $rules = [
        'phone' => 'required',
        'password' => 'required|min:8',
    ];
    private function getOrCreateJurnalEntry($user, $date)
    {

        return Jurnal::firstOrCreate([
            'user_id' => $user->id,
            'date' => $date
        ], [
            'hodim_id' => $user->hodim->id,
            'start_time' => now()->toTimeString(),
            'end_time' => null,
            'time' => 0,
        ]);
    }
    public function logout()
    {
        $user = Auth::user();
        $date = now()->toDateString();

        $jurnal = Jurnal::where('user_id', $user->id)
            ->where('date', $date)
            ->first();
        if ($jurnal) {
            $end_time = now();
            $start_time = $jurnal->start_time;

            $time_difference = round(Carbon::parse($end_time)->floatDiffInHours($start_time), 2);

            $jurnal->update([
                'end_time' => $end_time,
                'time' => $time_difference,
            ]);
        }

        Auth::logout();
        session()->flash('success', 'Siz tizimdan muvaffaqiyatli chiqdingiz!');
        return redirect('/');
    }
    public function render()
    {
        return view('livewire.auth-component')->layout('components.layouts.empty');
    }
    public function login()
    {
        $this->validate();
    
        if (Auth::attempt(['phone' => $this->phone, 'password' => $this->password])) {
            $user = Auth::user();
            $hodim_id = $user->hodim ? $user->hodim->id : null;
    
            if (!$hodim_id) {
                session()->flash('error', 'Hodim topilmadi!');
                return back();
            }
            
            $date = now()->toDateString();
            $jurnal = $this->getOrCreateJurnalEntry($user, $date);
    
            session()->flash('success', 'Siz tizimga muvaffaqiyatli kirdingiz! Jurnal saqlandi.');
            return redirect('/category');
        } else {
            session()->flash('error', 'Foydalanuvchi topilmadi!');
            return back();
        }
    }
}
