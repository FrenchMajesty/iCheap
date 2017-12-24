@component('mail::message')

@component('mail::panel')
# {{$data->name}} Just sent y'all a message..


Here's what the message says:

{{$data->message}}

@endcomponent

@endcomponent