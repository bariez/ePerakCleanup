@component('mail::message')
# Hi

{{ $message }}

@if($url)
@component('mail::button', ['url' => $url])
{{ $url }}
@endcomponent
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
