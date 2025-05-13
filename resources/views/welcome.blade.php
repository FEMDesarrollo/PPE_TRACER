@extends('Layouts.app')

@section('page_title', 'PANEL ADMINISTRATIVO')

@section('subtitle', ' Panel Administrativo')

@section('content')
@include('Layouts.sidebar', ['Permisos' => $Permisos])

@endsection
