@component('mail::message')

@component('mail::panel')
# Hey there {{$order->user->name}}!


Here is the shipping label for your book <i>"{{$order->book->title}}"</i>. <br><br>

The order ID is : <b>#{{$order->id}}</b> <br>
The tracking number is: <a href="{{$order->shippingLabel->tracking_url}}">{{$order->shippingLabel->tracking_number}}</a><br>

After you send your textbook in the mail, you can track it with the tracking number on this page:
<a href="{{$order->shippingLabel->tracking_url}}">{{$order->shippingLabel->tracking_url}}</a>
<br>
<b>Click the button below to get your shipping label.</b>

@if($button)
@component('mail::button', ['url' => $button['url'], 'color' => 'blue'])
{{$button['message']}}
@endcomponent
@endif

If you this email was sent to you by mistake, just ignore it and continue to have a fantastic rest of your day!
<br><br>
Thanks, <br>

-{{ env('APP_NAME') }} team

<div class="italic"><br><br>
Do not reply to this email; it was automatically generated.<br>

For security reasons, {{env('APP_NAME')}} will never ask you for your password via email.
</div>
@endcomponent

@endcomponent