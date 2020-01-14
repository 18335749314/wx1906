@extends('layouts.admin')


@section('title', '素材管理添加')


@section('content')


    <br>
    <br>
    <br>
    <h3>素材管理--添加</h3>
    <br>
    <br>
    <form action="{{url('/media/add_show')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">素材名称</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="素材名称" name="m_name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">素材格式</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="素材格式" name="m_format">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">启用时间</label>
            <select name="add_time" id="" class="form-control input-lg">
                <option value="1">临时</option>
                <option value="2">永久</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">素材图片</label>
            <input type="file" id="exampleInputFile" name="file">
        </div>
        <div class="checkbox">


        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
@endsection