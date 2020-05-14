@extends('errors::illustrated-layout')

@section('title', __('Page not found'))
@section('code', '404')
@section('message', __($exception->getMessage() ?: 'The page you are looking for does not exist.'))
