@extends ('layouts.platform')

@section('pageTitle', 'Common Questions')

@section('content')
<div class="single-product-area">
    <div class="container">
    	<div class="row">
			<h1>Frequently Asked Questions</h1>
    	</div>
    	<br>
        <div class="row">
			<div class="col-sm-6 customer_details">
                <div class="row">
                	<h3>What does this site do?</h3>
                    <p>There are many sites that buy used textbooks, but the prices these site offer vary widely. In some cases, one site may buy a book for one or two dollars while another site might offer $20. Obviously, it’s worth looking around to make sure you’re getting the most money for your used books.</p>
                    <p>That's where {{env('APP_NAME')}} comes in. We believe in offering the best prices for books to students because as opposed to our competitors we know that good business practices is <b>the best</b> advertisment!</p>
                </div>                                
			</div>
			<div class="col-sm-6 customer_details">
                <div class="row">
                	<h3>How do I find the ISBN on my book?</h3>
                    <p>The ISBN (International Standard Book Number) is a 10-or 13-digit number usually displayed above or below a barcode, typically on the back cover of a book.</p>
                	<p>Occasionally, it appears on a book’s front pages. The ISBN may have one or more hyphens, and it may end in an X.</p>
					<p>Most books published since 1970’s have an ISBN. Older books do not.</p>
                </div>                                
			</div>
			<div class="col-sm-6 customer_details">
                <div class="row">
                	<h3>What if my book doesn't have an ISBN or is a rare, collectible, and antique item?</h3>
                    <p>In these cases, find a local bookstore where you can rely on experts. If you believe your book may have some relatively high value, you could try looking for similar copies on eBay or <a href="http://abebooks.com" target="_blank">AbeBooks.com</a>.</p>
                </div>                                
			</div>
			<div class="col-sm-6 customer_details">
                <div class="row">
                	<h3>How should I package my book to avoid damage?</h3>
                    <p>Our general rule is to pack your books the way you’d want them to be packaged if you were buying them for yourself. In most cases, you need only a tight-fitting, sturdy cardboard box. In a loose-fitting box, the books moves around during shipping, sometimes resulting in damaged corners, spines, and pages. </p>
                    <p>To protect them from water damage, place books inside plastic wrap before placing them into the box. When you’re shipping multiple books, wrap each one in plastic, stack them nicely in a box, and pad any extra space tightly with newspaper. It doesn’t hurt to seal the box well with tape, adding extra tape around corners where water may easily get inside.</p>
                </div>                                
			</div>
			<div class="col-sm-6 customer_details">
                <div class="row">
                	<h3>What condition should my book be in order to sell it?</h3>
                    <p>The book needs to be at least usable. The buying price we give on the books we buy is under the assumption that the book is in <u>excellent</u> conditions. If it is damaged, then our team will re-determine the new buying price based on how much damage there is. </p>
                </div>                                
			</div>
			<div class="col-sm-6 customer_details">
                <div class="row">
                	<h3>How long before I get paid?</h3>
                    <p>It depends on how far you live from our headquarters that is based in Dallas, Texas. From the time your book gets to us, it will take less than two weeks for us to process it and send you your check via mail.</p>
                    <p>We will keep you updated and you will receive emails throughout the process so you'll know what stage we are at.</p>
                </div>                                
			</div>

			<div class="col-sm-6 customer_details">
                <div class="row">
                	<h3>Do you have a mobile version of the site?</h3>
                    <p>Yes! Our website is mobile responsive so the website <a href="{{env('APP_URL')}}" target="_blank">{{env('APP_URL')}}</a> can easily be browsed on the web browser of any phone.</p>
                </div>                                
			</div>

		</div>
	</div>
</div>
@endsection