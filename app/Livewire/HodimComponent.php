<?php

namespace App\Livewire;

use App\Models\Bolim;
use App\Models\Hodim;
use Livewire\Component;
use Livewire\WithPagination;

class HodimComponent extends Component
{

    public $hodims;
    public $hodimId, $bolim_id, $oylik_type, $oylik_miqdori, $bonus, $oylik_time, $start_time, $end_time, $time;
    public $isEditMode = false;
    public $isCreateMode = false;
    public $bolims;

    public function mount()
    {
        $this->bolims = Bolim::all();
        $this->hodims = Hodim::all();
    }

    public function createHodim()
    {
        $this->validate([
            'bolim_id' => 'required|integer',
            'oylik_type' => 'required|string',
            'oylik_miqdori' => 'required|numeric',
            'bonus' => 'required|numeric',
            'oylik_time' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'time' => 'required|numeric',
        ]);

        Hodim::create([
            'bolim_id' => $this->bolim_id,
            'oylik_type' => $this->oylik_type,
            'oylik_miqdori' => $this->oylik_miqdori,
            'bonus' => $this->bonus,
            'oylik_time' => $this->oylik_time,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'time' => $this->time,
        ]);

        $this->resetInputFields();
        $this->hodims = Hodim::all(); 
    }

    public function editHodim($id)
    {
        $this->isEditMode = true;
        $hodim = Hodim::find($id);
        $this->hodimId = $hodim->id;
        $this->bolim_id = $hodim->bolim_id;
        $this->oylik_type = $hodim->oylik_type;
        $this->oylik_miqdori = $hodim->oylik_miqdori;
        $this->bonus = $hodim->bonus;
        $this->oylik_time = $hodim->oylik_time;
        $this->start_time = $hodim->start_time;
        $this->end_time = $hodim->end_time;
        $this->time = $hodim->time;
    }

    public function updateHodim()
    {
        $this->validate([
            'bolim_id' => 'required|integer',
            'oylik_type' => 'required|string',
            'oylik_miqdori' => 'required|numeric',
            'bonus' => 'required|numeric',
            'oylik_time' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'time' => 'required|numeric',
        ]);

        $hodim = Hodim::find($this->hodimId);
        $hodim->update([
            'bolim_id' => $this->bolim_id,
            'oylik_type' => $this->oylik_type,
            'oylik_miqdori' => $this->oylik_miqdori,
            'bonus' => $this->bonus,
            'oylik_time' => $this->oylik_time,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'time' => $this->time,
        ]);

        $this->resetInputFields();
        $this->hodims = Hodim::all(); 
    }

    // Delete a Hodim record
    public function deleteHodim($id)
    {
        Hodim::find($id)->delete();
        $this->hodims = Hodim::all(); 
    }

    public function resetInputFields()
    {
        $this->bolim_id = '';
        $this->oylik_type = '';
        $this->oylik_miqdori = '';
        $this->bonus = '';
        $this->oylik_time = '';
        $this->start_time = '';
        $this->end_time = '';
        $this->time = '';
        $this->hodimId = null;
        $this->isEditMode = false;
    }

    public function render()
    {
        return view('livewire.hodim-component', [
            'hodims' => $this->hodims
        ]);
    }
}
