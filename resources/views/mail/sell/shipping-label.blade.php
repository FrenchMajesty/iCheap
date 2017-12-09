@component('mail::message')

@component('mail::panel')
# Hey there {{$order->user->firstname}}!


Here is the shipping label for your book *"{{$order->book->title}}"*. <br><br>

- The order ID is : **#{{$order->id}}**
- The tracking number is: [{{$order->shippingLabel->tracking_number}}]({{$order->shippingLabel->tracking_url}})

After you send your textbook in the mail, you can track it with the tracking number on this page:
<{{$order->shippingLabel->tracking_url}}>

**Click the button below to get your shipping label.**

@if($button)
@component('mail::button', ['url' => $button['url'], 'color' => 'blue'])
{{$button['message']}}
@endcomponent
@endif

Thanks,

-The {{ env('APP_NAME') }} team

<div class="italic"><br><br>
Do not reply to this email; it was automatically generated.<br>

For security reasons, {{env('APP_NAME')}} will never ask you for your password via email.
</div>
@endcomponent

@endcomponent