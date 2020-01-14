
<table class="table table-striped table-hover table-bordered table-condensed">
    <tr>
        <td>id</td>
        <td>姓名</td>
        <td>性别</td>
        <td>电话</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
        <tr>
            <td>{{$v->s_id}}</td>
            <td>{{$v->s_name}}</td>
            <td>{{$v->s_sex==1?'男':'女'}}</td>
            <td>{{$v->s_tel}}</td>
            <td><a href="">删除</a></td>
        </tr>
    @endforeach
</table>
