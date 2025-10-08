@extends('errors::layouts')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('This page is not allowed to access, please login to application to access the page.'))
@section('button')
    <a href="{{ route('login') }}" class="mt-3 btn btn-primary btn-sm">
        {{ __('Login') }}
    </a>
@endsection
