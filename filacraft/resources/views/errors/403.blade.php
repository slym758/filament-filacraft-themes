@php
    $style = \Illuminate\Support\Facades\Cookie::get('filacraft-error-style', 'illustrated');
    $code = 403;
    $title = 'Erisim Engellendi';
    $message = 'Bu sayfaya erisim yetkiniz bulunmamaktadir.';
@endphp

@include("filacraft::errors.styles.{$style}", compact('code', 'title', 'message'))
