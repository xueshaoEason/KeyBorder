<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="renderer" content="webkit">
		<title></title>
		<link rel="stylesheet" href="public/css/pintuer.css">
		<link rel="stylesheet" href="public/css/admin.css">
		<script src="public/js/jquery.js"></script>
		<script src="public/js/pintuer.js"></script>
	</head>
	<body>
		<form method="post" action="index.php?m=admin&c=lists&a=Addcomment" id="listform">
			<div class="panel admin-panel">
				<div class="panel-head">
					<strong class="icon-reorder">
						内容列表
					</strong>
				</div>
				<table class="table table-hover text-left">
					<tr>
						<td width="110" style="padding-left:30px;">
							<input type="submit" value="删除" name="del"/>
						</td>
						<td width="347" style="font-weight:700">标题</td>
						<td width="347" style="font-weight:700">博文图片</td>
						<td width="140" style="font-weight:700">作者</td>
						<td width="140" style="font-weight:700">回复数量</td>
						<td width="140" style="font-weight:700">浏览次数</td>
						<td width="190" style="font-weight:700">发表时间</td>
					</tr>
					<volist name="list" id="vo">
					<?php if(!empty($result)):?>
						<?php foreach($result as $value):?>
							<tr>
								<td style="text-align:center;">
									<input type="checkbox" name="id[]" value="<?=$value['pid'];?>" />
								</td>
								<td>
									<a href="index.php?m=index&c=single&a=single&pid=<?=$value['pid'];?>">
										<?=$value['title'];?>
									</a>
								</td>
								<td>
									<a href="index.php?m=index&c=single&a=single&pid=<?=$value['pid'];?>">
										<img src="<?=$value['photo'];?>" style="width:80px;height:60px;" target="_blank">
									</a>
								</td>
								<td>
									<?=$value['zid'];?>
								</td>
								<td>
									<?=$count;?>
								</td>
								<td>
									<?=$value['visittotal'];?>
								</td>
								<td>
									<?php  echo date('Y-m-d , H:i:s',$value['createtime']);?>
								</td>
							</tr>
						<?php endforeach;?>
					<?php endif;?>
				</table>
			</div>
		</form>
		<script type="text/javascript">

			//搜索
			function changesearch(){

			}

			//单个删除
			function del(id,mid,iscid){
				if(confirm("您确定要删除吗?")){

				}
			}

			//全选
			$("#checkall").click(function(){
			  $("input[name='id[]']").each(function(){
				  if (this.checked) {
					  this.checked = false;
				  }
				  else {
					  this.checked = true;
				  }
			  });
			})

			//批量删除
			function DelSelect(){
				var Checkbox=false;
				 $("input[name='id[]']").each(function(){
				  if (this.checked==true) {		
					Checkbox=true;	
				  }
				});
				if (Checkbox){
					var t=confirm("您确认要删除选中的内容吗？");
					if (t==false) return false;		
					$("#listform").submit();		
				}
				else{
					alert("请选择您要删除的内容!");
					return false;
				}
			}

			//批量排序
			function sorts(){
				var Checkbox=false;
				 $("input[name='id[]']").each(function(){
				  if (this.checked==true) {		
					Checkbox=true;	
				  }
				});
				if (Checkbox){	
					
					$("#listform").submit();		
				}
				else{
					alert("请选择要操作的内容!");
					return false;
				}
			}


			//批量首页显示
			function changeishome(o){
				var Checkbox=false;
				 $("input[name='id[]']").each(function(){
				  if (this.checked==true) {		
					Checkbox=true;	
				  }
				});
				if (Checkbox){
					
					$("#listform").submit();	
				}
				else{
					alert("请选择要操作的内容!");		
				
					return false;
				}
			}

			//批量推荐
			function changeisvouch(o){
				var Checkbox=false;
				 $("input[name='id[]']").each(function(){
				  if (this.checked==true) {		
					Checkbox=true;	
				  }
				});
				if (Checkbox){
					
					
					$("#listform").submit();	
				}
				else{
					alert("请选择要操作的内容!");	
					
					return false;
				}
			}

			//批量置顶
			function changeistop(o){
				var Checkbox=false;
				 $("input[name='id[]']").each(function(){
				  if (this.checked==true) {		
					Checkbox=true;	
				  }
				});
				if (Checkbox){		
					
					$("#listform").submit();	
				}
				else{
					alert("请选择要操作的内容!");		
				
					return false;
				}
			}


			//批量移动
			function changecate(o){
				var Checkbox=false;
				 $("input[name='id[]']").each(function(){
				  if (this.checked==true) {		
					Checkbox=true;	
				  }
				});
				if (Checkbox){		
					
					$("#listform").submit();		
				}
				else{
					alert("请选择要操作的内容!");
					
					return false;
				}
			}

			//批量复制
			function changecopy(o){
				var Checkbox=false;
				 $("input[name='id[]']").each(function(){
				  if (this.checked==true) {		
					Checkbox=true;	
				  }
				});
				if (Checkbox){	
					var i = 0;
					$("input[name='id[]']").each(function(){
						if (this.checked==true) {
							i++;
						}		
					});
					if(i>1){ 
						alert("只能选择一条信息!");
						$(o).find("option:first").prop("selected","selected");
					}else{
					
						$("#listform").submit();		
					}	
				}
				else{
					alert("请选择要复制的内容!");
					$(o).find("option:first").prop("selected","selected");
					return false;
				}
			}

		</script>
	</body>
</html>