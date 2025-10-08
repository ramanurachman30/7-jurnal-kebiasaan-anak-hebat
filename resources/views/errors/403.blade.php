@extends('errors::layouts')

@section('title', __('Forbidden'))
@section('code', '403')
{{-- @section('message', __($exception->getMessage() ?: 'Forbidden')) --}}
@section('message', 'This page is not allowed to access, please contact admin of  to give permisson.');
