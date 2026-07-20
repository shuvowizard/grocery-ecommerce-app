@extends('frontend.layouts.app')

@section('content')
    <!-- Hero Section -->
    @include('components.hero-section')

    <!-- Features Section -->
    @include('components.features')

    <!-- Categories Section -->
    @include('components.categories')

    <!-- Featured Products Section -->
    @include('components.featured-products')
@endsection