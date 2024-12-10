<?php

namespace App\Livewire;

use App\Models\Bolim;
use Livewire\Component;

class BolimComponent extends Component
{

    public $bolims;
    public $name, $bolimId, $is_active;

    public function mount()
    {
        $this->bolims = Bolim::all();
    }

    public function render()
    {
        return view('livewire.bolim-component');
    }

    public function create()
    {
        $this->resetFields(); // Clear any previously entered data
        $this->dispatch('open-create-modal'); // Trigger a modal to open
    }
    

    public function resetFields()
    {
        $this->name = '';
        $this->bolimId = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'is_active' =>'required|boolean',
        ]);
    
        Bolim::create([
            'name' => $this->name,
            'is_active' =>$this->is_active,
        ]);
    
        $this->bolims = Bolim::all(); // Refresh the list
        session()->flash('message', 'Bolim created successfully.');
        $this->resetFields();
        $this->dispatch('close-create-modal'); // Close the modal after saving
    }

    public function edit($id)
    {
        $bolim = Bolim::findOrFail($id);
        $this->bolimId = $bolim->id;
        $this->name = $bolim->name;
        $this->is_active = $bolim->is_active;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'is_active' =>'required|boolean',
        ]);

        $bolim = Bolim::findOrFail($this->bolimId);
        $bolim->update([
            'name' => $this->name,
            'is_active' =>$this->is_active
        ]);

        $this->bolims = Bolim::all();
        session()->flash('message', 'Bolim updated successfully.');
        $this->resetFields();
    }

    public function delete($id)
    {
        $bolim = Bolim::findOrFail($id);
        $bolim->delete();

        $this->bolims = Bolim::all();
        session()->flash('message', 'Bolim deleted successfully.');
    }
}
