@extends('back-end.layout.app')
@section('title')

    {{$pageTitle}}

@endsection


@section('content')

        @component('back-end.layout.header')

        @slot('nav_title')
            {{$pageTitle}}
        @endslot
        @endcomponent

        @component('back-end.shared.edit',['pageTitle'=>$pageTitle,'pagesDes'=>$pagesDes])
      
        <div class="card-body">
            <form action="{{route($routeName.'.update',['id'=>$row->id])}}" method="POST">
                {{method_field('put')}}
            @include('back-end.'.$folderName.'.form')
            
            <button type="submit" class="btn btn-primary pull-right">Update {{$mduleName}}</button>
            <div class="clearfix"></div>
            </form>
        </div>
        
        @endcomponent

@endsection