@php
    $title = __('Group') . ': ' . $group->groupname;
@endphp
@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>

        {{-- 編集・削除ボタン --}}
        <div>
            <a href="{{ url('groups/'.$group->id.'/edit') }}" class="btn btn-primary">
                {{ __('Edit') }}
            </a>
            {{-- #TODO:そのうち実装 --}}
            <a href="#" class="btn btn-danger">
                {{ __('Delete') }}
            </a>
        </div>

        {{-- ユーザー1件の情報 --}}
        <dl class="row">
            <dt class="col-md-2">{{ __('ID') }}</dt>
            <dd class="col-md-10">{{ $group->id }}</dd>
            <dt class="col-md-2">{{ __('groupname') }}</dt>
            <dd class="col-md-10">{{ $group->groupname }}</dd>
        </dl>
    </div>
@endsection
