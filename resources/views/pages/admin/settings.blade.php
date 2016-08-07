@extends('layouts.admin.main')

@section('heading')


@stop


@section('pagetitle')

    Site Settings

@stop


@section('content')

    <div class="form-page-medium">

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        
        <form class="form-horizontal" role="form" method="post" action="{{ url('admin/settings') }}">
            {{ csrf_field() }}
                @foreach ($settings as $setting)

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-5">
                            <label for="{{ $setting->name }}" class="control-label">{{ $setting->description }}</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="{{ $setting->name }}" id="{{ $setting->name }}" placeholder="{{ $setting->setting }}" value="{{ $setting->setting }}">
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                 </div>

                 @endforeach

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-custom">Save</button>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </form>
    </div>

@stop


@section('footer')



@stop