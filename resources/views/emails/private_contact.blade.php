@component('mail::message')
<p>Hi, This is {{ $data['name'] ?? ''}}</p>

<p>{{ $data['question'] ?? '' }}</p>

<p>Product Quantity: {{ $data['product_quantity'] ?? ''}}</p>
<p>Website: {{ $data['website'] ?? '' }}</p>
<p>social_media: {{ $data['social_media'] ?? '' }}</p>

Thanks,<br>
<h5>{{ $data['name'] ?? '' }}</h5>
<h5>{{ $data['company_name'] ?? '' }}</h5>
<h5>Email:{{ $data['email'] ?? '' }}</h5>
<h5>Phone:{{ $data['phone'] ?? '' }}</h5>
{{ config('app.name') }}
@endcomponent 