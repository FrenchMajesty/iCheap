@section('pageTitle', 'Sell your textbook "'.$book->title.'"')

@extends('layouts.platform')

@section('content')
<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a class="btn btn-arial" href="{{route('index')}}">Return to index</a>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="product-content-right">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <img src="{{$book->image}}" style="width: 70%" alt="">
                                </div>
                                
                                <div class="product-gallery">
                                    <img src="img/product-thumb-1.jpg" alt="">
                                    <img src="img/product-thumb-2.jpg" alt="">
                                    <img src="img/product-thumb-3.jpg" alt="">
                                    <img src="img/product-thumb-4.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name">{{$book->title}}</h2>
                                <div class="product-inner-price">
                                    <ins style="font-size: 3em">${{$book->price}}</ins> <!--del>$800.00</del-->
                                </div>    
                                
                                <form action="" class="cart">
                                    <a href="{{route('book.sell',[$book->id])}}" class="btn btn-danger btn-lg">Sell my Book</a>
                                </form>   
                                <div class="product-inner-category">
                                    <p>Author(s): {{$book->authors}}</p>
                                    <p>Publisher: {{$book->publisher}}</p>
                                </div> 
                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>Product Description</h2>  
                                            <p>{{$book->description}}</p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <h2>Reviews</h2>
                                            <div class="submit-review">
                                                <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                <div class="rating-chooser">
                                                    <p>Your rating</p>

                                                    <div class="rating-wrap-post">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                <p><input type="submit" value="Submit"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                    
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	
</script>
@endsection