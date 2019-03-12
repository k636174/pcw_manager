@php
    $title = __('Create Group');
@endphp
@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        <form action="{{ url('groups') }}" method="post">
            @csrf {{-- CSRF保護 --}}
            @method('POST') {{-- 疑似フォームメソッド --}}
            <div class="form-group">
                <label for="name">{{ __('groupname') }}</label>
                <input id="name" type="text" class="form-control" name="groupname" required autofocus>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </form>
    </div>
@endsection
