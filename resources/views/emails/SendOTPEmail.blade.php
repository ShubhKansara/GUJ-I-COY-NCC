@component('mail::message')
<b><u>Verification Code</u></b>


@component('mail::panel')
<p>{!! $maildata['body'] !!}</p>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent


