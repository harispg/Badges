@component('mail::message')
# Welcome {{$user->name}}

We are glad to have you as a customer. Feel free to buy lots of stuff and give us lots of money. LOTS!

- one

- two

- three

@component('mail::button', ['url' => route('allBadges')])
Go to badges
@endcomponent

@component('mail::panel')
This panel is here to show how smart and intelegent I truly am. TRULY!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
