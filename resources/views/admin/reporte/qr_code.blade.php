@extends('layouts.reporte')

@section('title', 'QR Code')

@section('style')
@endsection

@section('content')
<div class="visible-print text-center">
    {!! QrCode::size(250)->generate($qrCode); !!}
</div>
@endsection
