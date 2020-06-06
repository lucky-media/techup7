@component('mail::message')
# Techup Contact Form

The following visitor wants to contact Techup

<strong>Name:</strong> {{ $data['fname'] }} {{ $data['lname'] }}
<br>
<strong>Email:</strong> {{ $data['email'] }}

<strong>Subject:</strong> {{ $data['subject'] }}
<br>
<strong>Message:</strong> {{ $data['message'] }}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

### Please respond as soon as possible.

Thanks,<br>
{{ config('app.name') }}.mk
@endcomponent
