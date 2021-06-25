<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminHomeSlidercomponent extends Component
{

    public function deleteslider($id)
    {

        $slider=Homeslider::find($id);
        $slider->delete();
        session()->flash('message','deleted successfully');


    }

    
    public function render()
    {
        $sliders =  HomeSlider::all();
        return view('livewire.admin.admin-home-slidercomponent',['sliders'=>$sliders])->layout('layouts.base');
    }
}
