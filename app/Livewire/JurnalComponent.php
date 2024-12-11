<?php

namespace App\Livewire;

use App\Models\Hodim;
use App\Models\Jurnal;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class JurnalComponent extends Component
{
    use WithPagination;

    public $jurnal_id, $hodim_id, $user_id, $date, $start_time, $end_time, $jurnals;
    public $isEditing = false;
    public $isFormVisible = false;
    public $hodims = [];
    public $users = [];

    public function mount()
    {
        $this->hodims = Hodim::all();
        $this->users = User::all();
        $this->jurnals = Jurnal::all();
    }
    protected $rules = [
        'hodim_id' => 'required',
        'user_id' => 'required',
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
    ];

    public function resetFields()
    {
        $this->hodim_id = '';
        $this->user_id = '';
        $this->date = '';
        $this->start_time = '';
        $this->end_time = '';
        $this->isEditing = false;
        $this->isFormVisible = true; 
    }

    public function closeForm()
    {
        $this->resetFields();
        $this->isFormVisible = false; 
    }

    public function create()
    {
        $this->validate();
    
        $start = \Carbon\Carbon::parse(now()->format('Y-m-d') . ' ' . $this->start_time);
        $end = \Carbon\Carbon::parse(now()->format('Y-m-d') . ' ' . $this->end_time);
    
        $jurnal = Jurnal::create([
            'hodim_id' => $this->hodim_id,
            'user_id' => $this->user_id,
            'date' => now(),
            'start_time' => $start,
            'end_time' => $end,
            'time' => $end->diffInMinutes($start),
        ]);
        // dd($jurnal);
    
        $this->resetFields();
        $this->isFormVisible = false;
    }

    public function edit($id)
    {
        $jurnal = Jurnal::find($id);

        $this->jurnal_id = $jurnal->id;
        $this->hodim_id = $jurnal->hodim_id;
        $this->user_id = $jurnal->user_id;
        $this->date = $jurnal->date;
        $this->start_time = $jurnal->start_time;
        $this->end_time = $jurnal->end_time;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();
    
        $start = \Carbon\Carbon::parse(now()->format('Y-m-d') . ' ' . $this->start_time);
        $end = \Carbon\Carbon::parse(now()->format('Y-m-d') . ' ' . $this->end_time);
    
        $jurnal = Jurnal::findOrFail($this->jurnal_id);
        $jurnal->update([
            'hodim_id' => $this->hodim_id,
            'user_id' => $this->user_id,
            'date' => now(),
            'start_time' => $start,
            'end_time' => $end,
            'time' => $end->diffInMinutes($start),
        ]);
    
        $this->resetFields();
        $this->isFormVisible = false;
    }

    public function delete($id)
    {
        Jurnal::destroy($id);

        session()->flash('success', 'Jurnal deleted successfully.');
    }

    public function render()
    {
        return view('livewire.jurnal-component', [
            'jurnals' => Jurnal::with('hodim' , 'user'),
        ]);
    }
}
