@component('mail::message')

@component('mail::panel')

# Yo {{$order->user->firstname}} we've got some good news!

We have examined the book "*{{$order->book->title}}*" you sent us {{$order->created_at->diffForHumans()}} and our team appraised it and wrote you a check for it of **${{number_format($order->payment_amount, 2)}}**. 

We are going to be sending that over to you in the next couple of days.

To track the delivery, please click the button below.

@if($button)
@component('mail::button', ['url' => $button['url'], 'color' => 'blue'])
{{$button['message']}}
@endcomponent
@endif

If you cannot click that button just copy and paste this link in your browser window: <{{$order->paymentShipping->tracking_url}}>

Thanks, 

-The {{ env('APP_NAME') }} team

<div class="italic"><br><br>
Do not reply to this email; it was automatically generated.<br>

For security reasons, {{env('APP_NAME')}} will never ask you for your password via email.
</div>
@endcomponent

@endcomponent