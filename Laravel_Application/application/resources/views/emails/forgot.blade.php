<x-mail::message>
# send mail
Name: {{$user->name}}

Email: {{$user->email}}
 
Your password resset!
 
{{-- <x-mail::button :url="url('reset/')$user->remember_token" >
    Reset Password
</x-mail::button> --}}
@component('mail::button', ['url' => url('reset/'.$user->remember_token)])
Reset Password
@endcomponent


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>