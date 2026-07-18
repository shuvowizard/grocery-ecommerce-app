@extends('admin.layouts.base')

@section('childContent')

    @include('admin.layouts.partials.navbar')
    @include('admin.layouts.partials.sidebar')

    <div class="main-content">
         @yield('content')
    </div>

@endsection