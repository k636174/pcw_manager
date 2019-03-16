@php
    $title = __('Edit').': '.$host->hostname;
@endphp
@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        <form action="{{ url('hosts/'.$host->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label style="color:black">{{ __('hostname') }}</label>
                <input type="text" class="form-control" value="{{ $host->hostname }}" disabled>
            </div>

            <div class="form-group">
                <label style="color:black">{{ __('SRC_GIP') }}</label>
                <input type="text" class="form-control" value="{{ $host->host_ips->src_gip  }}" disabled>
            </div>

            <div class="form-group">
                <label style="color:black">{{ __('SRC_LIP') }}</label>
                <input type="text" class="form-control" value="{{ $host->host_ips->src_lip  }}" disabled>
            </div>

            <div class="form-group">
                <label for="groupname" style="color:black">{{ __('GROUPNAME') }}</label>
                <select name="group_id" class="form-control">
                    @foreach( $groups as $index => $name)
                        <option value="{{ $name["id"] }}" @if($name["id"]  == $host->groups[0]->id) selected @endif>{{$name["groupname"]}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </form>
    </div>

    <?php var_dump($host->groups);?>

    //var_dump($host->hostname);
    //var//dump($host->host_ips->src_gip);
    //var_dump($host->host_ips->src_lip);
    //foreach ($host->groups as $group) {
    //    var_dump($group->id);
    //    var_dump($group->groupname);
    //}
    //exit;

@endsection
