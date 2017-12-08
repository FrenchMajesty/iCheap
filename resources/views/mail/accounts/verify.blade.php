@component('mail::message')

@component('mail::panel')
# {{$title}}


Hey there {{$user->name}}!

Welcome to {{env('APP_NAME')}}. Ready to get started? 

The next step for you is to confirm your address email so we can send you shipping labels via email and update on the status of your orders.

*We won't spam you I promise.* 

To verify your email, click the button below.

@if($button)
@component('mail::button', ['url' => $button['url'], 'color' => 'blue'])
{{$button['message']}}
@endcomponent
@endif

If you did not sign up on {{env('APP_NAME')}} and don't know what this email is about, just ignore it and have a fantastic rest of your day!

Thanks, 

-The {{ env('APP_NAME') }} team

<div class="italic"><br><br>
Do not reply to this email; it was automatically generated.<br>

For security reasons, {{env('APP_NAME')}} will never ask you for your password via email.
</div>
@endcomponent

@endcomponent