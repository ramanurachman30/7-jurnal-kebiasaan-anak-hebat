@extends('errors::layouts')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('server is not ready to handle the request'))
