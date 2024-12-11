<?php

namespace App\Livewire;

use App\Models\Bolim;
use App\Models\Hodim;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class HodimComponent extends Component
{
    use WithPagination;

    public $user_id, $bolim_id, $oylik_type, $oylik_miqdori, $bonus, $oylik_time, $start_time, $end_time, $time;
    public $hodimId; 
    public $isEditMode = false;
    public $isCreateMode = false;

    public $bolims, $users;

    protected function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'bolim_id' => 'required|exists:bolims,id',
            'oylik_type' => 'required|string|max:255',
            'oylik_miqdori' => 'required|integer|min:0',
            'bonus' => 'required|integer|min:0',
            'oylik_time' => 'required|integer',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'time' => 'required|integer|min:0'
        ];
    }

    public function mount()
    {
        $this->bolims = Bolim::all();
        $this->users = User::all();
    }

    public function createHodim()
    {   
        $this->resetInputFields();
        $this->isCreateMode = true;
    }

    // Store new record
    public function store()
    {
        $validatedData = $this->validate();

        Hodim::create($validatedData);

        $this->reset([
            'user_id', 'bolim_id', 'oylik_type', 'oylik_miqdori', 
            'bonus', 'oylik_time', 'start_time', 'end_time', 
            'time', 'isCreateMode'
        ]);

        session()->flash('message', 'Hodim created successfully.');
    }

    public function editHodim($id)
    {
        $hodim = Hodim::findOrFail($id);

        $this->hodimId = $id;
        $this->user_id = $hodim->user_id;
        $this->bolim_id = $hodim->bolim_id;
        $this->oylik_type = $hodim->oylik_type;
        $this->oylik_miqdori = $hodim->oylik_miqdori;
        $this->bonus = $hodim->bonus;
        $this->oylik_time = $hodim->oylik_time;
        $this->start_time = $hodim->start_time;
        $this->end_time = $hodim->end_time;
        $this->time = $hodim->time;

        $this->isEditMode = true;
    }

    // Update existing record
    public function update()
    {
        $validatedData = $this->validate();

        $hodim = Hodim::findOrFail($this->hodimId);
        $hodim->update($validatedData);

        $this->reset([
            'hodimId', 'user_id', 'bolim_id', 'oylik_type', 'oylik_miqdori', 
            'bonus', 'oylik_time', 'start_time', 'end_time', 
            'time', 'isEditMode'
        ]);

        session()->flash('message', 'Hodim updated successfully.');
    }

    // Delete record
    public function deleteHodim($id)
    {
        $hodim = Hodim::findOrFail($id);
        $hodim->delete();

        session()->flash('message', 'Hodim deleted successfully.');
    }

    // Reset input fields
    public function resetInputFields()
    {
        $this->reset([
            'hodimId', 'user_id', 'bolim_id', 'oylik_type', 'oylik_miqdori', 
            'bonus', 'oylik_time', 'start_time', 'end_time', 
            'time', 'isEditMode', 'isCreateMode'
        ]);
    }

    // Render view
    public function render()
    {
        return view('livewire.hodim-component', [
            'hodims' => Hodim::all()
        ]);
    }
}