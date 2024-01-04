<div class="tab-pane fade" id="Reviews">
    <style>

        .star-rating{
        font-size:0;
        white-space:nowrap;
        display:inline-block;
        width:250px;
        height:50px;
        overflow:hidden;
        position:relative;
        background:
            url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjREREREREIiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
        background-size: contain;
        i{
            opacity: 0;
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 20%;
            z-index: 1;
            background: 
                url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjRkZERjg4IiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');  
            background-size: contain;
        }
        input{ 
            -moz-appearance:none;
            -webkit-appearance:none;
            opacity: 0;
            display:inline-block;
            width: 20%;
            height: 100%; 
            margin:0;
            padding:0;
            z-index: 2;
            position: relative;
            &:hover + i,
            &:checked + i{
            opacity:1;    
            }
        }
        i ~ i{
            width: 40%;
        }
        i ~ i ~ i{
            width: 60%;
        }
        i ~ i ~ i ~ i{
            width: 80%;
        }
        i ~ i ~ i ~ i ~ i{
            width: 100%;
        }
        }

        //JUST COSMETIC STUFF FROM HERE ON. THESE AREN'T THE DROIDS YOU ARE LOOKING FOR: MOVE ALONG. 

        //just styling for the number
        .choice{
        position: fixed;
        top: 0;
        left:0;
        right:0;
        text-align: center;
        padding: 20px;
        display:block;
        }

        //reset, center n shiz (don't mind this stuff)
        *, ::after, ::before{
        height: 100%;
        padding:0;
        margin:0;
        box-sizing: border-box;
        text-align: center;  
        vertical-align: middle;
        }
        
    </style>
    <!--Comments-->
    <div class="comments-area">
        <div class="row">
            <div class="col-lg-10">
                <h4 class="mb-30">Customer questions & answers</h4>
                <div class="comment-list">
                    @foreach ($reviews as $review)
                        <div class="single-comment justify-content-between d-flex mb-30">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb text-center">
                                    <img src="{{asset('storage/'.$review->user->profile_photo_path)}}" alt="" />
                                    <a href="#" class="font-heading text-brand">{{$review->user->username}}</a>
                                </div>
                                <div class="desc">
                                    <div class="d-flex justify-content-between mb-10">
                                        <div class="d-flex align-items-center">
                                            <span class="font-xs text-muted">{{$review->created_at->diffForHumans()}} </span>
                                        </div>
                                        <div class="product-rate d-inline-block">
                                            @if ($review->rating == NULL)
                                                <div class="product-rating" style="width: 0%"></div>
                                            
                                            @elseif($review->rating == 1)
                                                <div class="product-rating" style="width: 20%"></div>
                                            @elseif($review->rating == 2)
                                                <div class="product-rating" style="width: 40%"></div>
                                            @elseif($review->rating == 3)
                                                <div class="product-rating" style="width: 60%"></div>
                                            @elseif($review->rating == 4)
                                                <div class="product-rating" style="width: 80%"></div>
                                            @elseif($review->rating == 5)
                                                <div class="product-rating" style="width: 100%"></div>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="mb-10">{{$review->comment}} <a href="#" class="reply">Reply</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                   
                </div>
            </div>
           
        </div>
    </div>
    <!--comment form-->
    <div class="comment-form">
        <h4 class="mb-15">Add a review</h4>
        <form wire:submit.prevent='submitReview' class="form-contact comment_form" id="commentForm">
            <span class="star-rating">
                <input wire:model='rating' type="radio" name="rating" value="1"><i></i>
                <input wire:model='rating' type="radio" name="rating" value="2"><i></i>
                <input wire:model='rating' type="radio" name="rating" value="3"><i></i>
                <input wire:model='rating' type="radio" name="rating" value="4"><i></i>
                <input wire:model='rating' type="radio" name="rating" value="5"><i></i>
            </span>
            <strong class="choice">Choose a rating</strong>
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea wire:model='comment' required class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                    
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <button type="submit" class="button button-contactForm">Submit Review</button>
                        </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(':radio').change(
            function(){
                $('.choice').text( this.value + ' stars' );
            } 
            )
    </script>
</div>