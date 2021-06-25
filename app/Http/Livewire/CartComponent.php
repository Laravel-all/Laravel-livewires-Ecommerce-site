<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Coupon;
use Cart;
use Illuminate\Support\Facades\Auth;


class CartComponent extends Component
{

    public $haveCouponCode;
    public $couponCode;
    public $discount;
    public $subTotalAfterDiscount;
    public $taxafterDiscount;
    public $totalAfterDiscount;

    public function increaseQuantity($rowId)
    {
        $product=Cart::Instance('cart')->get($rowId);
        $qty = $product->qty+1;
        Cart::Instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');

    }

    public function DecreaseQuantity($rowId)
    {
        $product=Cart::Instance('cart')->get($rowId);
        $qty = $product->qty-1;
        Cart::Instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');

    }

    public function destroy($rowId)
    {
       Cart::Instance('cart')->remove($rowId);
       $this->emitTo('cart-count-component','refreshComponent');

        session()->flash('success_message','Item Has Been Removed');
    }

    
    public function destroyAll()
    {
       Cart::Instance('cart')->destroy();
       $this->emitTo('cart-count-component','refreshComponent');

       
    }

    public function switchToSaveForLater($rowId)
    {
        $item=Cart::Instance('cart')->get($rowId);
        Cart::Instance('cart')->remove($rowId);
        Cart::Instance('saveForLater')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
       $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('success_message','Item Has Been Saved for later');

    }


    public function moveTocart($rowId)
    {
        $item=Cart::Instance('saveForLater')->get($rowId);
        Cart::Instance('saveForLater')->remove($rowId);
        Cart::Instance('cart')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
       $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('s_success_message','Item Has Been move to cart');
    }


    
    public function deleteFromSaveForLater($rowId)
    {
       Cart::Instance('saveForLater')->remove($rowId);
       
        session()->flash('s_success_message','Item Has Been remove from save from later');
    }


        
    public function applyCouponCode()
    {
        $coupon =Coupon::where('code',$this->couponCode)->where('expire_date','>=',Carbon::today() )->where('cart_value','<=',Cart::instance('cart')->subTotal())->first();
       
        if(!$coupon)
        {
            session()->flash('coupon_message','coupon code is invalid');
            return;
        }

        session()->put('coupon',[
            'code'=>$coupon->code,
            'type'=>$coupon->type,
            'value'=>$coupon->value,
            'cart_value'=>$coupon->cart_value
        ]);
       
    }

    public function calculateDiscount()
    {

        if(session()->has('coupon'))
        {
            if(session()->get('coupon')['type'] == 'fixed')
            {
                $this ->discount =session()->get('coupon')['value'];
            }
            else 
            {
                $this ->discount =(Cart::instance('cart')->subtotal * session()->get('coupon')['value'] )/100;

            }

            $this->subTotalAfterDiscount =Cart::instance('cart')->subtotal() - $this->discount;
            $this->taxafterDiscount =($this->subTotalAfterDiscount * config('cart.tax') )/100;
            $this->totalAfterDiscount =$this->subTotalAfterDiscount +  $this->taxafterDiscount;
        }
    }

    public function removeCoupon()
    {
        session()->forget('coupon');

    }


    public function checkout()
    {
       if(Auth::check())
       {
            return redirect()->route('checkout');
       }
       else
       {
            return redirect()->route('login');

       }

    }

    public function setAmountForCheckout()
    {

        if(!Cart::instance('cart')->count()> 0 )
        {
          session()->forget('checkout');
          return;

        }

        if(session()->has('coupon'))
       {
          session()->put('checkout',[
            'discount'=> $this->discount,
            'subtotal'=> $this->subTotalAfterDiscount,
            'tax'=> $this->taxafterDiscount,
            'total'=> $this->subTotalAfterDiscount,
            
          ]);
       }
       else
       {
        session()->put('checkout',[
            'discount'=> 0,
            'subtotal'=>Cart::instance('cart')->subTotal(),
            'tax'=>  Cart::instance('cart')->tax(),
            'total'=>  Cart::instance('cart')->total()
            
          ]);

       }

    }



    public function render()
    {

        if(session()->has('coupon'))
        {
            if(Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value'])
            {
                session()->forget('coupon');
            }
            else
            {
                    $this->calculateDiscount();
            }
        }

        $this->setAmountForCheckout();

        return view('livewire.cart-component')->layout('layouts.base');
    }
}
