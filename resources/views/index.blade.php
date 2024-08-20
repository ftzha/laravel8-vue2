@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="container">
        <h1>Welcome to My Laravel App</h1>
        {{-- <example-component></example-component> --}}
        <employee-list></employee-list>
    </div>
@endsection
