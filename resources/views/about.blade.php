@extends('layout')
@section('content')
    <h3>About Page</h3>
    @foreach($data as $key=>$value)
        {{ $key.' is '.$value.'<br>' }}
    @endforeach
@endsection 