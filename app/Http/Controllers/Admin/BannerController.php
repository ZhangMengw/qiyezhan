<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BannerController extends Controller
{
    public function create(){
        return view("admin.banner.create");
    }
    //添加执行
    public function store(Request $request){
        $arr = $request->all();
        if(empty($arr["name"])){
            $message = $this->datacode("false","00001","导航栏名称不能为空");
        }else if(empty($arr["url"])){
            $message = $this->datacode("false","00001","连接地址不能为空");
        }else if(empty($arr["sorts"])){
            $message = $this->datacode("false","00001","排序不能为空");
        }else{
            $arr["addtime"] = time();
            // print_r($arr);exit;
            $data = DB::table("banner")->insert($arr);
            // echo $data;exit;
            if($data){
                $message = $this->datacode("true","00000","添加成功","/admin/banner/index");
                // print_r($message);
            }else{
                $message = $this->datacode("false","00001","添加失败");
            }
        }
        echo json_encode($message);
    }
    public function datacode($status="",$code=1,$msg="",$result=""){
        $message = [];
        $message["status"] = $status;
        $message["code"] = $code;
        $message["msg"] = $msg;
        $message["result"] = $result;
        return $message;
    }

    //导航展示
    public function index(){
        $data = DB::table("banner")->where("is_del",1)->orderBy("sorts","asc")->paginate(3);
        // dd($data);
        return view("admin.banner.index",compact("data"));
    }

    //删除
    public function del(){
        $id = request()->get("id");
        // echo $id;
        $del = DB::table("banner")->where("id",$id)->update(["is_del"=>2]);
        // print_r($del);exit;

        if($del){
            $message = $this->datacode("true","00000","删除成功","/admin/banner/index");
        }else{
            $message = $this->datacode("false","00001","删除失败");
        }
        echo json_encode($message);
    }

    //修改
    public function updates($id){
        $res = DB::table("banner")->where("id",$id)->first();
        return view("admin.banner.updates",compact("res"));
    }

    //执行修改
    public function upd(Request $request){
        $arr = $request->all();
        // print_r($arr);exit;
        if(empty($arr["name"])){
            $message = $this->datacode("false","00001","导航栏名称不能为空");
        }else if(empty($arr["url"])){
            $message = $this->datacode("false","00001","连接地址不能为空");
        }else if(empty($arr["sorts"])){
            $message = $this->datacode("false","00001","排序不能为空");
        }else{
            $arr["addtime"] = time();
            // print_r($arr);exit;
            $data = DB::table("banner")->where("id",$arr["id"])->update($arr);
            // echo $data;exit;
            if($data){
                $message = $this->datacode("true","00000","修改成功","/admin/banner/index");
                // print_r($message);
            }else{
                $message = $this->datacode("false","00001","修改失败");
            }
        }
        echo json_encode($message);
    }

    //即点即改
    public function ajaxname(Request $request){
        $arr = $request->all();
        $status = $arr["status"]==1?2:1;
        // print_r($status);exit;
        $res = DB::table("banner")->where("id",$arr["id"])->update(["hidden"=>$status]);
        if($res){
            $add = $arr["status"]==1?"否":"是";
            $message = $this->datacode("true","00000",$status,$add);
        }

        echo json_encode($message);
    }

    public function ajaxsorts(Request $request){
        $arr = $request->all();
        // print_r($arr);exit;
        $res = DB::table("banner")->where("id",$arr["id"])->update(["sorts"=>$arr["new_name"]]);
        if($res){
            $message = $this->datacode("true","00000","修改成功");
        }

        echo json_encode($message);
    }
}
