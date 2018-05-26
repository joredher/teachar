@extends('layouts.errors')

@section('title', 'No Se Encuentra')

@section('imagen')
    <img src="{{ asset('imagenes/404.png') }}" alt="404_Image">
@endsection

@section('numero', '404')

@section('texto_uno', '¡Oops! Página No Encontrada.')

@section('texto_dos', 'La página que está buscando no existe o se ha movido.')