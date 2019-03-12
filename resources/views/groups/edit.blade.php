@php
    $title = __('Edit').': '.$group->groupname;
@endphp
@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        <form action="{{ url('groups/'.$group->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="groupname">{{ __('groupname') }}</label>
                <input id="groupname" type="text" class="form-control" name="groupname" value="{{ $group->groupname }}" required autofocus>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </form>
    </div>
@endsection
