@extends('errors::layouts')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Server is busy, please come back latter!'))
