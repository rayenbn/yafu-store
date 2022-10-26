@component('mail::message')
## Hi, This is {{ $data['name']}}
#### I Hear you from: {{ $data['hear']}}


<p>{{ $data['message']}}</p>
<p>The best Time to reach me: {{ $data['reach']}}</p>
Thanks,<br>

## {{ $data['company']}}
<h5>{{ $data['name']}}</h5>
<h5>Email:{{ $data['email']}}</h5>
<h5>Phone:{{ $data['phone']}}</h5>
{{ config('app.name') }}

@endcomponent
