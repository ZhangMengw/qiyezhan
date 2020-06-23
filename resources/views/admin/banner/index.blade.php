<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广告-有点</title>
<link rel="stylesheet" type="text/css" href="/css/css.css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="/js/page.js" ></script> -->
<style>
        .aaa nav ul{
            margin-left: 40%;

        }
        .aaa nav ul li .page-link{
            float: left;
            margin-left: 10px;
            width: 17px;
            height: 20px;
            background: #5bc0de;
            line-height: 20px;
            padding-left: 8px;
            color: #ffffff;
         }

</style>
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">导航栏管理</a>&nbsp;-</span>&nbsp;查看
			</div>
		</div>
		<div class="page">
			<!-- banner页面样式 -->
			<div class="banner">
				<!-- banner 表格 显示 -->
				<div class="banShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">id</td>
							<td width="315px" class="tdColor">导航名称</td>
							<td width="308px" class="tdColor">链接地址</td>
							<td width="215px" class="tdColor">是否显示</td>
							<td width="180px" class="tdColor">排序</td>
							<td width="450px" class="tdColor">添加时间</td>
							<td width="125px" class="tdColor">操作</td>
						</tr>
                        @foreach($data as $itme)
						<tr>
							<td>{{$itme->id}}</td>
							<td>{{$itme->name}}</td>
							<td><a class="bsA" href="#">{{$itme->url}}</a></td>
							<td id="{{$itme->id}}" class="hubei" status='{{$itme->hidden}}'>{{$itme->hidden==1 ? "是" : "否"}}
                            </td>
							<td  s_id="{{$itme->id}}">
                                <span class="span_sorts">{{$itme->sorts}}</span>
                            </td>
							<td>{{date('Y-m-d H:i:s',$itme->addtime)}}</td>
							<td><a href="{{url('/admin/banner/updates/'.$itme->id)}}"><img class="operation updban"
									src="/img/update.png"></a> <img class="operation delban"
								src="/img/delete.png" banner_id="{{$itme->id}}"></td>
						</tr>
                        @endforeach
                        <tr><td class="aaa" colspan="6">{{$data->links()}}</td></tr>
					</table>
					<div class="paging">
                    </div>
				</div>
				<!-- banner 表格 显示 end-->
			</div>
			<!-- banner页面样式end -->
		</div>

	</div>


	<!-- 删除弹出框 -->
	<div class="banDel">
		<div class="delete">
			<div class="close">
				<a><img src="/img/shanchu.png" /></a>
			</div>
			<p class="delP1">你确定要删除此条记录吗？</p>
			<p class="delP2">
				<a href="#" class="ok yes" id="del">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
	<!-- 删除弹出框  end-->
</body>

</html>

<script>
    $(function(){
        //删除
        $(document).on("click",".delban",function(){
            var id = $(this).attr("banner_id");
            // alert(id);
            $(".banDel").show();
            $(".yes").click(function(){
                $.ajax({
                    type:"get",
                    url:"/admin/banner/del",
                    data:{id:id},
                    dataType:"json",
                    success:function(res){
                        // console.log(res);
                        if(res.status=="true"){
                            alert(res.msg);
                            window.location.href=res.result;
                        }else{
                            alert(res.msg);
                        }
                    }
                })
            });
        })
        $(document).on("click",".no",function(){
            $(".banDel").hide();
        })


    $(document).on("click",".hubei",function(){
        var data = {};
        data.id = $(this).attr("id");
        data.status = $(this).attr("status");
        var obj = $(this);
        $.get("/admin/banner/ajaxname",data,function(res){
            // console.log(res);
            if(res.status=="true"){
                obj.attr("status",res.msg);
                obj.text(res.result);
            }
        },"json")
    })



    //即点即改 排序
    $(document).on("click",".span_sorts",function(){
        var name = $(this).text();
        // console.log(name);
        $(this).parent().html('<input type="text" class="input_sorts" value='+name+'>');
    })
    //即点即改失去焦点
    $(document).on("blur",".input_sorts",function(){
        // alert("123");
        var obj = $(this);
        var new_name = $(this).val();
        var id = $(this).parent().attr("s_id");
        // alert(id);

        var data = {};
        data.new_name = new_name;
        data.id = id;

        // console.log(data);
        $.get("/admin/banner/ajaxsorts",data,function(res){
            // console.log(res);
            if(res.status=="true"){
                obj.parent().html('<span class="span_name">'+new_name+'</span>');
            }
        },'json');

    })


})
</script>
