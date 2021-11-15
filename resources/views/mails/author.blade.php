@component('mail::message')
# {{ $maildetails['title'] }}

{{ $maildetails['body'] }}

@component('mail::button', ['url' => "https://alinkhere.com"])

Check it out
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent