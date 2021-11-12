@component('mail::message')
# {{ $maildetails['title'] }}

{{ $maildetails['body'] }}

@component('mail::button', ['url' => "https://alinkhere.com"])

Review
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent