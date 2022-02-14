@extends('without_sidebar')

@section('content')

<subscribe-component :user_id="{{ auth()->user()->id }}"></subscribe-component>

@endsection
