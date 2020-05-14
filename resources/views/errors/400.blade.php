@extends('errors::illustrated-layout')

@section('title', __('Forbidden'))
@section('code', '400')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
