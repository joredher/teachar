@extends('layouts.errors')

@section('title', 'Error Servidor')

@section('imagen')
    <img src="{{ asset('imagenes/500.png') }}" alt="500_Image">
@endsection

@section('numero', '500')

@section('texto_uno', 'Error Interno del Servidor')

@section('texto_dos', 'Algo va mal con nuestros servidores, por favor intente de nuevo más tarde..')