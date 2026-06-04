@extends('layout.app')

@section('content')

    @livewire(
        'dynamic-page',
        ['page' => $page]
    )

@endsection