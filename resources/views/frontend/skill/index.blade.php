@extends('layouts.app')

@section('content')
        <div class="section section-buttons">
            <div class="container">
                <div class="title">
                    <h2> {{$skill->name}} </h2>
                </div>

               @include('frontend.shared.video-row')

        </div>
@endsection
