<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部-有点</title>
<link rel="stylesheet" type="text/css" href="/css/css.css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">导航栏管理</a>&nbsp;-</span>&nbsp;添加
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTop">
					<span>添加导航栏</span>
				</div>
				<div class="baBody">
					<div class="bbD">
						导航栏名称：<input type="text" class="input1" name="banner_name"/>
					</div>
					<div class="bbD">
						导航栏地址：<input type="text" class="input1" name="url"/>
					</div>
					<div class="bbD">
						是否显示：<input type="radio" checked="checked" value="1" name='hidden'/>是<input
							type="radio" value="2" name="hidden"/>否
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;排序：<input class="input2" name="sorts"
							type="text" />
					</div>
					<div class="bbD">
						<p class="bbDP">
							<button class="btn_ok btn_yes" href="#" id="but">提交</button>
						</p>
					</div>
				</div>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>

<script>
    $(function(){
        $(document).on("click","#but",function(){
            var data = {};
            data.name = $("input[name='banner_name']").val();
            data.url = $("input[name='url']").val();
            data.hidden = $('input:radio:checked').val();
            data.sorts = $("input[name='sorts']").val();

            var url = "/admin/banner/store";
            // console.log(data);
            $.ajax({
                type:"post",
                url:url,
                data:data,
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
        })
    })

$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>
