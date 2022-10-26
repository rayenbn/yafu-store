@component('mail::message')
<p>Hi, This is {{ $data['name'] ?? ''}}</p>

<p>{{ $data['message']}}</p>

Thanks,<br>
<h5>{{ $data['name'] ?? '' }}</h5>
<h5>{{ $data['company_name'] ?? '' }}</h5>
<h5>Email:{{ $data['email']}}</h5>
<h5>Phone:{{ $data['phone']}}</h5>
{{ config('app.name') }}
@endcomponent
