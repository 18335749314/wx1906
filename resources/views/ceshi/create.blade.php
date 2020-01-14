<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{url('/ceshi/create_do')}}" method="post">
    @csrf
    学生姓名: <input type="text" name="s_name"><br>
    学生性别: <input type="radio" name="s_sex" value="1">男
              <input type="radio" name="s_sex" value="2">女<br>
    学生电话: <input type="text" name="s_tel"><br>
                <button>添加</button>
</form>
</body>
</html>