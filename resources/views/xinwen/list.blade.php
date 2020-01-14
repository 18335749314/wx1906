@extends('layouts.admin')


@section('title','素材管理-展示')


@section('content')
<table class="table">
    <caption>新闻----详情页面</caption>
    <form action="">
        <input type="text" name="x_zz" value="{{$query['x_zz']??''}}">
        <button>作者</button><br>
        <input type="text" name="x_bt" value="{{$query['x_bt']??''}}">
        <button>标题</button>
    </form>
    <thead>
        <tr>
        <th scope="col">标题</th>
        <th scope="col">内容</th>
        <th scope="col">作者</th>
        <th scope="col">时间</th>
        <th scope="col">点击量</th>
        <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $k=>$v)
        <tr>
        <th scope="row">{{$v->x_bt}}</th>
        <th scope="row">{{$v->x_nr}}</th>
        <th scope="row">{{$v->x_zz}}</th>
        <th scope="row">{{$v->x_time}}</th>
        <th scope="row">{{$v->x_djl}}</th>
        <th scope="row">
            <a href="{{url('/news/delete/'.$v->x_id)}}" class="btn btn-danger">删除</a>
            <a href="{{url('/news/update/'.$v->x_id)}}" class="btn btn-danger">修改</a>
        </th>
        </tr>
    @endforeach    
    </tbody>
    </table>
    {{$data->links()}}
@endsection