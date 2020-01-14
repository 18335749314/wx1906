<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Xinwen;
class NewsController extends Controller
{
    public function add(){
        return view('xinwen.add');
    }
    public function add_do(Request $request){
        $data=$request->except('_token');
        $res=Xinwen::create($data);
        if($res){
            echo "<script>alert('添加成功');location.href='/news/list'</script>";
        }else{
            echo "<script>alert('添加失败');location.href='/news/add'</script>";
        }
       
    }
    public function list(){
        //搜索
        $x_zz = request()->x_zz;
        $x_bt = request()->x_bt;
        // dump($x_bt);
        $where=[];
        if($x_zz){
            $where[]=['x_zz','like',"%$x_zz%"];
        }
        if($x_bt){
            $where[]=['x_bt','like',"%$x_bt%"];
        }
        $data = Xinwen::where($where)->paginate(3);
        $query=request()->all();
        return view('xinwen.list',['data'=>$data,'query'=>$query]);
    }
    public function delete($x_id){
        // dd($x_id);
        $res = Xinwen::where('x_id',$x_id)->delete();
        if($res){
            echo "<script>alert('删除成功');location.href='/news/list'</script>";
        }else{
            echo "<script>alert('删除失败');location.href='/news/list'</script>";
        }
    }

}


   


