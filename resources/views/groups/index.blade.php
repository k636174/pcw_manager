@php
    $title = __('Users');
@endphp
@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($groups as $group)
                    <tr>
                        <td>{{ $group->id }}</td>
                        <td><a href="{{ url('groups/'.$group->id) }}">{{ $group->groupname }}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
