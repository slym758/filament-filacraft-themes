@php
    $style = \Illuminate\Support\Facades\Cookie::get('filacraft-error-style', 'illustrated');
    $code = 404;
    $title = 'Sayfa Bulunamadi';
    $message = 'Aradiginiz sayfa mevcut degil veya tasinmis olabilir.';
@endphp

@include("filacraft::errors.styles.{$style}", compact('code', 'title', 'message'))
