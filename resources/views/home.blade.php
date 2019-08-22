@extends('layouts.app')

@section('content')
        <div class="section section-buttons">
            <div class="container">
                <div class="title">
                    <h2> Latest Video </h2>
                    <p style="margin-top: 5px">
                    @if(request()->has('search') && request()->get('search') != ''){

                        you are searching in <b>{{request()->get('search')}} </b> | <a href="{{route('home')}}">Reset</a>
                    }
                    @endif
                    </p>

                </div>
                @include('frontend.shared.video-row')


        </div>
@endsection
