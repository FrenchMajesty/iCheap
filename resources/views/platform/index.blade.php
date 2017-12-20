@section('pageTitle', 'Home')

@extends ('layouts.platform')

@section('content')
<style>
    .embeded {
        height: 50px;
        color: #fff;
        font-weight: 700;
        background: #1abc9c;
    }
</style>
<div class="slider-area">
    <div class="zigzag-bottom"></div>
    <div id="slide-list" class="carousel carousel-fade slide" data-ride="carousel">
        
        <!--div class="slide-bulletz">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="carousel-indicators slide-indicators">
                            <li data-target="#slide-list" data-slide-to="0" class="active"></li>
                        </ol>                            
                    </div>
                </div>
            </div>
        </div-->

        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="single-slide">
                    <div class="slide-bg slide-one"></div>
                    <div class="slide-text-wrapper">
                        <div class="slide-text">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="slide-content">
                                            <h2>Sell your textbooks for cash!</h2>
                                            <p>We will buy your textbook from you with <b>CASH</b>. Free shipping included.</p>
                                            <br>
                                            <form method="POST" action="{{route('search')}}">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <label>Book's ISBN</label>
                                                        <div class="input-group">
                                                          <input type="text" name="isbn" class="form-control" placeholder="Search by ISBN Number" aria-label="Search by ISBN Number" maxlength="15" value="{{old('isbn')}}" autofocus required style="height: 50px;">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-secondary embeded" type="button">Search !
                                                                </button>
                                                            </span>
                                                        </div>
                                                    <br>
                                                </div>
                                                @if ($errors->has('isbn'))
                                                    <span class="alert alert-danger help-block">
                                                        <strong>{{ $errors->first('isbn') }}</strong>
                                                    </span>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="single-slide">
                    <div class="slide-bg slide-two"></div>
                    <div class="slide-text-wrapper">
                        <div class="slide-text">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-6">
                                        <div class="slide-content">
                                            <h2>We are great</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe aspernatur, dolorum harum molestias tempora deserunt voluptas possimus quos eveniet, vitae voluptatem accusantium atque deleniti inventore. Enim quam placeat expedita! Quibusdam!</p>
                                            <a href="" class="readmore">Learn more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="single-slide">
                    <div class="slide-bg slide-three"></div>
                    <div class="slide-text-wrapper">
                        <div class="slide-text">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-6">
                                        <div class="slide-content">
                                            <h2>We are superb</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, eius?</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti voluptates necessitatibus dicta recusandae quae amet nobis sapiente explicabo voluptatibus rerum nihil quas saepe, tempore error odio quam obcaecati suscipit sequi.</p>
                                            <a href="" class="readmore">Learn more</a>
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
</div> <!-- End slider area -->

<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="single-promo">
                    <i class="fa fa-refresh"></i>
                    <p>15 days response</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo">
                    <i class="fa fa-truck"></i>
                    <p>Free shipping</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo">
                    <i class="fa fa-lock"></i>
                    <p>Secure payments</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo">
                    <i class="fa fa-gift"></i>
                    <p>Referral bonus</p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->

<div class="maincontent-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">The Story Behind {{env('APP_NAME')}}</h2>
                    <div class="col-md-4">
                        <img src="http://via.placeholder.com/350x350">
                    </div>
                    <div class="col-md-8">
                        [Inspirational story behind this great startup here]
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->
@endsection

@section('js')
@endsection