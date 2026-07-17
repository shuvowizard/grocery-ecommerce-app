@extends('admin.layouts.base')

@section('childContent')

    @include('admin.layouts.partials.navbar')
    @include('admin.layouts.partials.sidebar')

    @yield('content')

@endsection