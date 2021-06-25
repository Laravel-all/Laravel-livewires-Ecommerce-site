<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\HomeSlider;

class AdminEditHomeSlidercomponent extends Component
{

    use WithFileUploads;


    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $image;
    public $status;
    public $newimage;
    public $slide_id;


    public function mount($slide_id)
    {

        $sliders=HomeSlider::where('id',$slide_id)->first();
        $this->title =$sliders->title;
        $this->subtitle =$sliders->subtitle;
        $this->price =$sliders->price;
        $this->link =$sliders->link;
        $this->image =$sliders->image;
        $this->status =$sliders->status;
        $this->slide_id =$sliders->id;
        

    }

    public function edithomeslider()
    {

        
        $sliders = HomeSlider::find($this->slide_id);
        $sliders->title = $this->title;
        $sliders->subtitle = $this->subtitle;
        $sliders->price = $this->price;
        $sliders->link = $this->link;

        if($this->newimage)
        {
        $imageName=Carbon::now()->timestamp.'.'.$this->newimage->extension();
        $this->newimage->storeAs('sliders',$imageName);
        $product->image = $imageName;
        }
        $sliders->status = $this->status;
        
        $sliders->save();

        session()->flash('message','Update Successfully');



    }


    public function render()
    {
        return view('livewire.admin.admin-edit-home-slidercomponent')->layout('layouts.base');
    }
}
