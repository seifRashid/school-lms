@component('mail::message')
Hello {{$user->name}} 😎,
<p>We understand what has just happened</p>

@component('mail::button', ['url'=> url('reset/'.$user->remember_token)])
    Reset your password 🚀
@endcomponent
    <p>Please contact if any issue arises😇</p>
    {{config('app.name')}}
@endcomponent