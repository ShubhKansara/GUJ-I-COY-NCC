@component('mail::message')
<b>Hi {{ $maildata['user_full_name'] }},</b>

@component('mail::panel')
<p>
    We've got some exciting news.<br/><br/>
    For some time now, we've been developing our own user-friendly AI chatbot tool that lives inside the ExtraHourz app. I'm excited to share with you that it's ready to use! Please access your chatbot portal at <a target="_blank" href="{{ $maildata['invite_link'] }}">link</a>.
    <br/><br/>
    Key Features:
    <ul>
        <li>Build and revise chatbots for different positions</li>
        <li>Create a complex series of pre-screening questions</li>
        <li>Score answers based on the importance of each question</li>
        <li>View candidate responses</li>
        <li>View detailed job performance data</li>
        <li>Connect chatbot link to other job boards you are using</li>
    </ul>
    <br/>
    If you have any questions, please do not hesitate to contact Connie Kolakowski at <a href="mailto:ckolakowski@extrahourz.com" target="_blank" rel="noopener noreferrer">ckolakowski@extrahourz.com</a>.
</p>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
