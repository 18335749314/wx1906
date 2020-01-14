@extends('layouts.admin')


@section('title','素材管理-添加')


@section('content')




<div class="ibox-content">
    <form class="form-horizontal m-t" id="signupForm"  action="{{url('/news/add_do')}}" method="post">
        <div class="form-group">
            <label class="col-sm-3 control-label">标题:</label>
            <div class="col-sm-8">
                <input id="firstname" name="x_bt" class="form-control" type="text">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">内容:</label>
            <div class="col-sm-8">
                <textarea name="x_nr" id="" cols="140" rows="10"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">作者:</label>
            <div class="col-sm-8">
                <input id="username" name="x_zz" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-3">
                <button class="btn btn-primary" type="submit">提交</button>
            </div>
        </div>
    </form>
</div>
@endsection