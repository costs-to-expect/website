@extends('errors::layout')

@section('title', __('Costs to Expect is unavailable'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Costs to Expect is unavailable, a new release is in progress'))
