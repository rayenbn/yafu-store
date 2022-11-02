@component('mail::layout')

{{-- Header --}}
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        {{ config('app.name') }}
    @endcomponent
@endslot

{{-- Body --}}
<table align="left" width="570" cellpadding="0" cellspacing="0" style="color: black;">
    <tr>
        <td align="left" style="font-size: 16px; font-family: Avenir,sans-serif;">
            <p style="color: black;">Dear {{ ucfirst($clientName) }}</p>

			<p style="color: black;">Congrats on your order at Yafu pet toys manufacture. <br>
			We have already received your product details.<p>

			{{--  <p style="color: black;">Attached you can find your invoice.<br>
			You can also find a summary of your order <a href="{{ route('profile') }}#submitted_orders">here</a></p> --}}

			<p style="color: black">Please pay the invoice within 15 days.<br>
            <span style="font-weight: 600">Your production will be started right after we receive your payment.</span></p>
           {{-- @if(count($files) > 0)
                <p style="color: black">Your artwork files</p>
            @foreach ($files as $key => $file)
                <ul>
                    <li><a href="https://www.yafu-pet-toys.com{{ $file['path'] }}" > {{ $file['image'] }} </a></li>
                </ul>
            @endforeach
            @endif --}}
			Cheers <br>
			Rayen Ben
        </td>
    </tr>
</table>

<table align="left" width="570" cellpadding="0" cellspacing="0" style="margin-top: 15px;">
    <tr>
        <td align="left" style="font-size: 10px; color: #7b7e7d; font-family: Verdana,sans-serif;">
          
            <b>Rayen Ben</b> <br>
            <br>
            rayen@yafu-pey-toys.com<br>
			CN: +86 13226604307
        </td>
    </tr>
</table>

{{-- Subcopy --}}
@isset($subcopy)
    @slot('subcopy')
        @component('mail::subcopy')
            {{ $subcopy }}
        @endcomponent
    @endslot
@endisset

{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    @endcomponent
@endslot

@endcomponent