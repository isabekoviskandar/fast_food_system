<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryComponent extends Component
{

    public $categories, $name, $sort;

    public function mount()
    {
        $this->categories = Category::all();
    }
    public function create()
    {
        $this->validate([
            'name'=>'required|string',
            'sort'=>'required|integer',
        ]);

        Category::create([
            'name'=>$this->name,
            'sort'=>$this->sort,
        ]);

        $this->resetInput();
        $this->categories = Category::all();
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

    private function resetInput()
    {
        $this->name = '';
        $this->sort = '';
    }

    public function render()
    {
        return view('livewire.category-component');
    }
}
