@extends('layouts.admin')


@section('title','渠道管理-展示')


@section('content')
<table class="table">
    <caption>渠道----详情页面</caption>
    <thead>
        <tr>
        <th scope="col">渠道名称</th>
        <th scope="col">渠道标识</th>
        <th scope="col">二维码</th>
        <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $k=>$v)
        <tr>
        <th scope="row">{{$v->channel_name}}</th>
        <th scope="row">{{$v->channel_status}}</th>
        <th scope="row">
            <img src="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={{$v->ticket}}" width="100px">
            
        </th>
        <th scope="row">
            <a href="{{url('/channel/delete/'.$v->c_id)}}" class="btn btn-danger">删除</a>
            <a href="{{url('/channel/update/'.$v->c_id)}}" class="btn btn-danger">修改</a>
        </th>
        </tr>
    @endforeach    
    </tbody>
    </table>
   
@endsection