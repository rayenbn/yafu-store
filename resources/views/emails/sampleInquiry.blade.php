@component('mail::message')
## Hi, This is {{ $data['name']}}


<p>I would like to inquiry for a {{ $data['product']}} sample.</p>

<p>Thanks for inquiry from us, we recieved your inquiry about a sample, our sales manager will contact you within 24h.</p>

Thanks,<br>

<h5>Name: {{ $data['name']}}</h5>
<h5>Email:{{ $data['email']}}</h5>
<h5>Phone:{{ $data['phone']}}</h5>
<h5>Address:{{ $data['address']}}</h5>
{{ config('app.name') }}

@endcomponent
