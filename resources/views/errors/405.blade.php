@extends('layouts.errors')

@section('title', 'No Funciona')

@section('imagen')
    <img src="{{ asset('imagenes/404.png') }}" alt="404_Image">
@endsection

@section('numero', '405')

@section('texto_uno', '¡Oops! No se Encuentra.')

@section('texto_dos', 'La página que está buscando no existe o se ha movido.')