<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use illuminate\Support\Str;

class AdminAddCategoryComponent extends Component
{
    public $name;
    public $slug;

    public function genarateslug(){

        $this->slug=str::slug($this->name);
    }


    public function updated($fields)
    {

        $this->validateOnly($fields,[
            'name'=>'required',
            'slug'=>'required|unique:categories'

        ]);

    }

    public function storeCategory()
    {

        $this->validate([
            'name'=>'required',
            'slug'=>'required|unique:categories'
        ]);

        $category=new Category();
        $category->name=$this->name;
        $category->slug=$this->slug;
        $category->save();
        session()->flash('message','Category has been created succesfully!');


    }

    public function render()
    {
        
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base');
    }
}
