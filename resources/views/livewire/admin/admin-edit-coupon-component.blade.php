<div>
   <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                            Edit Coupon
                            </div>

                            <div class="col-md-6">
                                <a href="{{route('admin.coupons')}}" class="btn btn-success pull-right">All Coupon</a> 
                            </div>
                        </div>

                    </div>

                    <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message')}}</div>
                    @endif

                        <form class="form-horizontal" wire:submit.prevent="updateCoupon">

                           

                            <div class="form-group">
                            <label class="col-md-4 control-label">Coupon Code</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Coupon Code" class="form-control input-md" wire:model="code"/>
                                @error('code') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            </div>

                            <div class="form-group">
                            <label class="col-md-4 control-label">Coupon Type</label>
                            <div class="col-md-4">
                               <select class="form-control" wire:model="type">
                               <option>Select</option>
                               <option value="Fixed">Fixed</option>
                               <option value="present">Precent</option>
                               </select>
                            </div>
                            </div>

                            <div class="form-group">
                            <label class="col-md-4 control-label">Coupon Value</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Coupon Value" class="form-control input-md" wire:model="value"/>
                                @error('value') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            </div> 
                            
                             <div class="form-group">
                            <label class="col-md-4 control-label">Cart Value</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Cart Value" class="form-control input-md" wire:model="cart_value"/>
                                @error('cart_value') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            </div>

                            <div class="form-group">
                            <label class="col-md-4 control-label">Expire Date</label>
                            <div class="col-md-4">
                                <input type="text" id="expire_date" placeholder="Expire Date" class="form-control input-md" wire:model="expire_date"/>
                                @error('expire_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            </div> 



                            <div class="form-group">
                            <label class="col-md-4 control-label"> </label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            </div>
                        </form>

                    </div>
                
                </div>
            
            </div>
        
        </div>
   </div>
</div>



@push('scripts')
<script>
    $(function(){
        $('#expire-date').datetimepicker({
            format:'Y-MM-DD',
             
                    icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down",
                previous: "fa fa-chevron-left",
                next: "fa fa-chevron-right",
                today: "fa fa-clock-o",
                clear: "fa fa-trash-o"
                    },
        })
        .on('dp.change',function(ev){
               
            var data=$('#expire-date').val();
                @this.set('expire_date',data);

                
               
        });
    });

   

</script>


@endpush