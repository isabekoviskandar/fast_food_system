<?php

namespace App\Livewire;

use App\Models\Bolim;
use App\Models\Hodim;
use App\Models\User;
use Carbon\Carbon;
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
            'start_time' => 'required|date_format:Y-m-d\TH:i', // Match datetime-local format
            'end_time' => 'required|date_format:Y-m-d\TH:i|after:start_time',
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

    public function store()
{
    try {
        // Validate the input
        $validatedData = $this->validate();

        // Convert datetime-local input to proper datetime format
        $validatedData['start_time'] = Carbon::parse($validatedData['start_time'])->format('Y-m-d H:i:s');
        $validatedData['end_time'] = Carbon::parse($validatedData['end_time'])->format('Y-m-d H:i:s');

        // Calculate time difference
        $start = Carbon::parse($validatedData['start_time']);
        $end = Carbon::parse($validatedData['end_time']);
        $validatedData['time'] = $end->diffInHours($start);

        // Create Hodim
        Hodim::create($validatedData);

        // Reset form
        $this->reset([
            'user_id', 'bolim_id', 'oylik_type', 'oylik_miqdori',
            'bonus', 'oylik_time', 'start_time', 'end_time',
            'time', 'isCreateMode'
        ]);

        // Flash success message
        session()->flash('message', 'Hodim created successfully.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Log or handle validation errors
        \Log::error('Validation Errors:', $e->errors());
        
        // Flash validation errors
        session()->flash('errors', $e->errors());
    } catch (\Exception $e) {
        // Log any other unexpected errors
        \Log::error('Hodim Creation Error:', ['message' => $e->getMessage()]);
        
        // Flash a generic error message
        session()->flash('error', 'An error occurred while creating the Hodim.');
    }
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

    public function update()
    {
        $validatedData = $this->validate();
        
        $start = Carbon::parse($validatedData['start_time']);
        $end = Carbon::parse($validatedData['end_time']);
        $validatedData['time'] = $end->diffInHours($start);
    
        $hodim = Hodim::findOrFail($this->hodimId);
        $hodim->update($validatedData);
    
        $this->reset([
            'hodimId', 'user_id', 'bolim_id', 'oylik_type', 'oylik_miqdori', 
            'bonus', 'oylik_time', 'start_time', 'end_time', 
            'time', 'isEditMode'
        ]);
    
        session()->flash('message', 'Hodim updated successfully.');
    }

    public function deleteHodim($id)
    {
        $hodim = Hodim::findOrFail($id);
        $hodim->delete();

        session()->flash('message', 'Hodim deleted successfully.');
    }

    public function resetInputFields()
    {
        $this->reset([
            'hodimId', 'user_id', 'bolim_id', 'oylik_type', 'oylik_miqdori', 
            'bonus', 'oylik_time', 'start_time', 'end_time', 
            'time', 'isEditMode', 'isCreateMode'
        ]);
    }

    public function render()
    {
        return view('livewire.hodim-component', [
            'hodims' => Hodim::all()
        ]);
    }
}