<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\HomeCategory;


class AdminHomeCategorycomponent extends Component
{

    public $selected_categories=[];
    public $numberofproducts;

    public function mount()
    {
        $category=HomeCategory::find(1);

        // explore function beaccouse multivalue

        $this->selected_categories=explode(',',"$category->sel_categories");
        $this->numberofproducts=$category->no_of_products; 

    }

    public function updateHomeCategory()
    {
        $category=HomeCategory::find(1);
        $category->sel_categories=implode(',',$this->selected_categories);
        $category->no_of_products=$this->numberofproducts;
        $category->save();

        session()->flash('message','HomeCategory has been updated successfully!');

    }

    public function render()
    {
        $categories=Category::all();
        return view('livewire.admin.admin-home-categorycomponent',['categories'=>$categories])->layout('layouts.base');
    }
}
