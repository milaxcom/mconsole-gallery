@extends('mconsole::app')

@section('content')

@include('mconsole::partials.table', [
    'add' => '/mconsole/gallery/create',
])

@endsection