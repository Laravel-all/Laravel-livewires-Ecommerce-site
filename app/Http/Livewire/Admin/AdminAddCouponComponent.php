<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Coupon;


class AdminAddCouponComponent extends Component
{

    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $expire_date;

    public function  updated($fields)
    {
        $this->validateOnly($fields,[

            'code'=>'required|unique:coupons',
            'type'=>'required',
            'value'=>'required|numeric',
            'cart_value'=>'required|numeric',
            'expire_date'=>'required'


        ]);
    }

    public function  storeCoupon()
    {
            $this->validate([
                'code'=>'required|unique:coupons',
                'type'=>'required',
                'value'=>'required|numeric',
                'cart_value'=>'required|numeric',
                'expire_date'=>'required'
            ]);

            $coupon = new Coupon();
            $coupon->code = $this->code;
            $coupon->type = $this->type;
            $coupon->value = $this->value;
            $coupon->cart_value = $this->cart_value;
            $coupon->expire_date = $this->expire_date;
            $coupon->save();
            session()->flash('message','Coupon has been created successfully');

    }
    public function render()
    {
        return view('livewire.admin.admin-add-coupon-component')->layout('layouts.base');
    }
}
