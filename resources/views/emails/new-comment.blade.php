@component('mail::message')
# New comment on your content

Commented by: <br>

<strong>Name:</strong> {{ $info['name'] }} <br>
<strong>Email:</strong> {{ $info['email'] }} <br>
<strong>Comment:</strong> {{ $info['comment'] }} <br>

@component('mail::button', ['url' => $info['url']])
Reply here
@endcomponent

Thanks,<br>
{{ config('app.name') }}.mk
@endcomponent
