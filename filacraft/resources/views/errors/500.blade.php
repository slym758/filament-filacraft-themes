@php
    $style = \Illuminate\Support\Facades\Cookie::get('filacraft-error-style', 'illustrated');
    $code = 500;
    $title = 'Sunucu Hatasi';
    $message = 'Bir sorun olustu. Lutfen daha sonra tekrar deneyin.';
@endphp

@include("filacraft::errors.styles.{$style}", compact('code', 'title', 'message'))
