@extends('back-end.layout.app')

@section('title')
    {{ $pageTitle }}
@endsection

@section('content')

    @component('back-end.layout.header')
        @slot('nav_title')
            {{ $pageTitle }}
        @endslot
    @endcomponent

    @component('back-end.shared.create' , ['pageTitle' => $pageTitle , 'pagesDes' => $pagesDes])
        <form action="{{ route($routeName.'.store') }}" method="POST">
            @include('back-end.'.$folderName.'.form')
            <button type="submit" class="btn btn-primary pull-right">Add {{ $mduleName }}</button>
            <div class="clearfix"></div>
        </form>
    @endcomponent
@endsection