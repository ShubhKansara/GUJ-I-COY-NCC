@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::layout.demo'),
    'subtitle' => '',
    'breadcrumb' => ['Demo']]
)

@section('content')
    @include('boilerplate::plugins.demo')
@endsection