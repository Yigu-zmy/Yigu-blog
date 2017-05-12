@extends('home.base')


@section('header')
    @include('boot_.boot_Header')
    @endsection

@section('slide')
    @include('home.slide')
@endsection


@section('content')
    @include('home.content')
    @endsection


@section('footer')
    @include('boot_.boot_Footer')
    @endsection