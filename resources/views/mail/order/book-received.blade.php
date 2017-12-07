@component('mail::message')

@component('mail::panel')
# Howdi there {{$order->user->firstname}}!


We just wanted to let you know that your book *"{{$order->book->title}}"* you want to sell and shipped to us was received in our possession and processed into our system today.

You can click the button below to see its journey and know exactly when it arrived.

@if($button)
@component('mail::button', ['url' => $button['url'], 'color' => 'blue'])
{{$button['message']}}
@endcomponent
@endif

## Now what? The Next Step..

The next step is going to be for someone in our team to examinate your book and check out the quality, see if pages are torn, if the cover is still in one piece, if it has Ghandi's autograph, etc.. You know, standard stuff. 

Then, based on that appraisal we will know how much to write you on a check and we will mail you that payment to your address. When we send out your payment you will receive the tracking number of your **check** so you can stalk it *everyday* until it gets there... 

It's okay, we already know you do that, no biggie. That's why we have this feature.

If you need to contact support about this order please keep these informations handy: 
* The order ID is : **#{{$order->id}}**
* The tracking number is: [{{$order->shippingLabel->tracking_number}}]({{$order->shippingLabel->tracking_url}})

Thanks,

-The {{ env('APP_NAME') }} team

<div class="italic"><br><br>
Do not reply to this email; it was automatically generated.<br>

For security reasons, {{env('APP_NAME')}} will never ask you for your password via email.
</div>
@endcomponent

@endcomponent