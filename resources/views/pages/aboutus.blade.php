@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/aboutus.css') }}">

@section('content')
<section class="hero"
    style="background-image: url('{{ asset('images/tanem.png') }}')">

    <div class="hero-text">
        <h1>
            <span class="highlight">Restore</span>
            the Coast, Reduce Your Carbon Footprint
        </h1>
        <p>
            A transparent carbon offset platform focused on
            mangrove forest rehabilitation in Indonesia.
        </p>
    </div>

</section>
@endsection