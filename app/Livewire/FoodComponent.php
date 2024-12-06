<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;
use Livewire\WithFileUploads;

class FoodComponent extends Component
{
    use WithFileUploads;

    public $category_id, $name, $image, $price, $foods, $selected_id, $categories;
    public $openEditModal = false;
    public $openCreateModal = false;

    public function mount()
    {
        $this->foods = Food::all();
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.food-component');
    }

    public function create()
    {
        $this->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:5000',
            'price' => 'required|integer',
        ]);
    
         // dd($this->category_id, $this->name, $this->image, $this->price);
    
        $filePath = $this->image->store('storage/', 'public');
     
        Food::create([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'image' => $filePath,
            'price' => $this->price,
        ]);
    
        session()->flash('success', 'Food created successfully!');
        $this->resetInputFields();
        $this->foods = Food::all();
        $this->openCreateModal = false;
    }
    

    public function delete($id)
    {
        $food = Food::findOrFail($id);

        if ($food) {
            if ($food->image && file_exists(storage_path('app/public/' . $food->image))) {
                unlink(storage_path('app/public/' . $food->image));
            }
            $food->delete();
            $this->foods = Food::all();
            session()->flash('warning', 'Food deleted!');
        } else {
            session()->flash('danger', "Sorry, we cannot find this food!");
        }
    }

    public function edit($id)
    {
        $food = Food::findOrFail($id);
        $this->selected_id = $food->id;
        $this->category_id = $food->category_id;
        $this->name = $food->name;
        $this->image = null; 
        $this->price = $food->price;
        $this->openEditModal = true;
    }

    public function update()
    {
        $this->validate([
            'category_id' => 'required',
            'name' => 'required|string',
            'image' => 'nullable|image|max:5000', 
            'price' => 'required|integer',
        ]);

        if ($this->selected_id) {
            $food = Food::findOrFail($this->selected_id);

            $filePath = $food->image; 
            if ($this->image) {
                if (file_exists(storage_path('app/public/' . $food->image))) {
                    unlink(storage_path('app/public/' . $food->image));
                }
                $filePath = $this->image->store('storage/', 'public');
            }

            $food->update([
                'category_id' => $this->category_id,
                'name' => $this->name,
                'image' => $filePath,
                'price' => $this->price,
            ]);

            session()->flash('success', 'Food updated successfully!');
            $this->resetInputFields();
            $this->foods = Food::all();
            $this->openEditModal = false;
        } else {
            session()->flash('danger', 'Sorry, we cannot find food!');
        }
    }

    private function resetInputFields()
    {
        $this->category_id = '';
        $this->name = '';
        $this->image = null;
        $this->price = '';
        $this->selected_id = null;
    }
}
