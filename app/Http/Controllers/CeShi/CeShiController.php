<?php

namespace App\Http\Controllers\CeShi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentModel;
class CeShiController extends Controller
{
//    public function create(){
//        return view('ceshi.create');
//    }
//    public function create_do(){
//        $data = \request()->except('_token');
//        //dd($data);
//        $studentInfo = StudentModel::where('s_name',$data['s_name'])->first();
//        if($data['s_name']==$studentInfo['s_name']){
//            echo "<script>alert('名称yi存在');location='/ceshi/create'</script>";die;
//        }
//        $res = StudentModel::insert($data);
//        if($res){
//            echo "<script>alert('添加成功');location='/ceshi/lists'</script>";
//        }else{
//            echo "<script>alert('添加失败');location='/ceshi/create'</script>";
//        }
//    }
//    public  function lists(){
//        $s_name = \request()->s_name;
//        $where = [];
//        if($s_name){
//            $where[] = ['s_name','like',"%$s_name%"];
//        }
//
//        $res = StudentModel::where($where)->paginate(2);
//        $query = \request()->all();
//
//        if(\request()->ajax()){
//            return view('ceshi.ajax',['data'=>$res,'query'=>$query]);
//        }
//
//        return view('ceshi.list',['data'=>$res,'query'=>$query]);
//    }
}
