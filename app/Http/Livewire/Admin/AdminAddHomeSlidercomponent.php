<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Homeslider;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminAddHomeSlidercomponent extends Component
{

    use WithFileUploads;


    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $image;
    public $status;

    public function mount()
    {
        $this->status= 0;


    }
    
    public function addslide()
    {

        $slider = new Homeslider();
         $slider->title= $this->title;
         $slider->subtitle= $this->subtitle;
         $slider->price= $this->price;
         $slider->link= $this->link;
         
         $imageName=Carbon::now()->timestamp.'.'.$this->image->extension();
         $this->image->storeAs('sliders',$imageName);
         $slider->image=$imageName;

         $slider->status= $this->status;
         $slider->save();
         session()->flash('message','slide has been created succusfully');

    }


    public function render()
    {
        return view('livewire.admin.admin-add-home-slidercomponent')->layout('layouts.base');
    }
}
