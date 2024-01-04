<div class="card">
    <div class="card-header">
        <h5>Account Details</h5>
    </div>
    <div class="card-body">
        <form wire:submit='update' name="enq">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>User Name <span class="required">*</span></label>
                    <input wire:model='username' required=""  class="form-control" name="username" type="text" />
                </div>
                <div class="form-group col-md-6">
                    <label>Full name<span class="required">*</span></label>
                    <input wire:model='name' required=""  class="form-control" name="name" type="text"/>
                </div>
            
                <div class="form-group col-md-12">
                    <label>Email Address <span class="required">*</span></label>
                    <input wire:model='email' required="" class="form-control" name="email" type="email" />
                </div>
                <div class="form-group col-md-6">
                    <label>Phone<span class="required">*</span></label>
                    <input wire:model='phone' required=""  class="form-control" name="phone" type="phone" />
                </div>

                <div class="form-group col-md-6">
                    <label>Address<span class="required">*</span></label>
                    <input wire:model='address' required="" class="form-control" name="address" type="text" />
                </div>

                <div class="form-group ">
                    <label>User Photo</label>
                    <input wire:model='profile_photo_path' class="form-control" id="image" name="profile_photo_path" type="file" />
                </div>
                
                <div class="form-group col-md-12">
                    <img id="showImage" src="{{ (!empty($user->profile_photo_path)) ? url ('storage/'.$user->profile_photo_path) : url ('upload/user_images/no_image.jpg') }}" alt="user" class="rounded-circle p-1 bg-primary" width="110"/>
                </div>
                
            
                <div class="col-md-12">
                    <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    
</div>