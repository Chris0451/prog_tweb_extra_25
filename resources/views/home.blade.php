@extends('layouts.home_layouts.app')

@section('content')

    @include('layouts.home_layouts.hero')

    @include('layouts.home_layouts.products', ['prodotti' => $prodotti])

    @include('layouts.home_layouts.centers')

    @include('layouts.home_layouts.contacts')

@endsection