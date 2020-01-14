@extends('layouts.admin')


@section('title','渠道管理-添加')


@section('content')




<div class="ibox-content">
    <form class="form-horizontal m-t" id="signupForm"  action="{{url('/channel/add_do')}}" method="post">
        <div class="form-group">
            <label class="col-sm-3 control-label">渠道名称</label>
            <div class="col-sm-8">
                <input id="firstname" name="channel_name" class="form-control" type="text">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">渠道标识</label>
            <div class="col-sm-8">
                <input id="username" name="channel_status" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-3">
                <button class="btn btn-primary" type="submit">添加</button>
            </div>
        </div>
    </form>
</div>
@endsection