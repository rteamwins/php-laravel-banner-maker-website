@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    Update Account

@stop


@section('content')

    @if(Session::has('page'))
        {!! Session::get('page')->htmlcode !!}
    @endif



@stop


@section('footer')



@stop