@component('mail::message')
<b><u>You've got a new application for {{ trim($maildata['chatbot']['chatbot_name']) }}</u> 🎉</b>

@component('mail::panel')
{{-- <p>{!! $maildata['body'] !!}</p> --}}
<div class="text-align:left;float:left">
    @component('mail::button', ['url' => $maildata['attechment_url']])
    Click Here to view Report
    @endcomponent
</div>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
