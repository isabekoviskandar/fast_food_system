<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryComponent extends Component
{

    public $categories, $name, $sort , $selected_id;

    public $openEditModal = false;
    public $openCreateModal = false;

    public function mount()
    {
        $this->categories = Category::all();
    }
    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'sort' => 'required|integer',
        ]);

        Category::create([
            'name' => $this->name,
            'sort' => $this->sort,
        ]);

        session()->flash('success', 'Category created successfully.');
        $this->resetInputFields();
        $this->categories = Category::all();
        $this->openCreateModal = false;
    }
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        if($category){
            $category->delete();
            $this->categories = Category::all();
            session()->flash('success' , 'Category deleted succesfully');
        }else{
            session()->flash('danger' , 'Sorry we cannot find category');
        }
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->sort = '';
        $this->selected_id = null;
    }

    public function render()
    {
        return view('livewire.category-component');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->selected_id = $category->id;
        $this->name = $category->name;
        $this->sort = $category->sort;
        $this->openEditModal = true; 
    }
    
    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'sort' => 'required|integer',
        ]);
    
        if ($this->selected_id) {
            $category = Category::find($this->selected_id);
            $category->update([
                'name' => $this->name,
                'sort' => $this->sort,
            ]);
            session()->flash('success', 'Category updated successfully.');
            $this->resetInputFields();
            $this->categories = Category::all();
            $this->openEditModal = false; 
        }
    }    
}
