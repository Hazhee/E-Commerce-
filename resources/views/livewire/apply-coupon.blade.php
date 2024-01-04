<div class="col-lg-5">
    @if (Session::has('coupon'))
                        
    @else
        <div class="p-40">
            <h4 class="mb-10">Apply Coupon</h4>
            <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</p>
            <form wire:submit.prevent='applyCoupon' action="#">
                <div class="d-flex justify-content-between">
                    <input wire:model='coupon' class="font-medium mr-15 coupon" name="Coupon" placeholder="Enter Your Coupon">
                
                    <button type="submit" class="btn"><i class="fi-rs-label mr-10"></i>Apply</button>
                    
                </div>
                @error('coupon')
                    <span style="display: block" class="text-danger">{{$message}}</span>
                @enderror
            </form>
        </div>
    @endif
</div>