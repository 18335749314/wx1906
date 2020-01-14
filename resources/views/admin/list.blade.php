@extends('layouts.admin')


@section('title','素材管理-展示')


@section('content')
<table class="table">
    <caption>List of users</caption>
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        </tr>
        
    </tbody>
    </table>
@endsection