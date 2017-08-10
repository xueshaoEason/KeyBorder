<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?=$title;?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <!-- Bootstrap styles -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">


    <!-- Font-Awesome -->
    <link rel="stylesheet" href="public/css/font-awesome/css/font-awesome.min.css">

    <!-- Google Webfonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600|PT+Serif:400,400italic' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link rel="stylesheet" href="public/css/style.css" id="theme-styles">

    <script type="text/javascript" src='public/js/jquery-1.11.3.min.js'></script>

    <!--[if lt IE 9]>
        <script src="js/vendor/google/html5-3.6-respond-1.1.0.min.js"></script>
    <![endif]-->

</head>
<body>
    <header>
        <div class="widewrapper masthead">
            <div class="container">
                <a href="index.html" id="logo">
                    <img src="public/images/logo2.png" height="150" width="350" alt="clean Blog">
                </a>

                <div id="mobile-nav-toggle" class="pull-right">
                    <a href="#" data-toggle="collapse" data-target=".clean-nav .navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>

                <nav class="pull-right clean-nav">
                    <div class="collapse navbar-collapse">
                        <ul class="nav nav-pills navbar-nav">
							<li>
								<a href="index.php?m=index&c=index&a=index">Home</a>
							</li>
							<?php if(!empty($_SESSION['username'])):?>
								<li>
									<a><?=$_SESSION['username'];?></a>
								</li>
								<?php if((!empty($_SESSION['usertype']) && $_SESSION['usertype'] == 1)):?>
									<li>
										<a href="index.php?m=admin&c=index&a=index">Center</a>
									</li>
								<?php endif;?>	
								<li> 
									<a href="index.php?m=index&c=user&a=out">Quit</a>
								</li>
							<?php else: ?>
								<li>
									<a href="index.php?m=index&c=user&a=login">Login</a>
								</li>
								<li>
									<a href="index.php?m=index&c=user&a=register">Register</a>
								</li>
							<?php endif;?>
						</ul>
                    </div>
                </nav>        

            </div>
        </div>

        <div class="widewrapper subheader">
            <div class="container">
                <div class="clean-breadcrumb">
                    <a href="index.php?m=index&c=index&a=index">Home</a>
                    <span class="separator">&#x2F;</span>
                    <a href="index.php?m=index&c=user&a=register">Register</a>
                </div>
                <div class="clean-searchbox">
                    <form action="#" method="get" accept-charset="utf-8">
                        <input class="searchfield" id="searchbox" type="text" placeholder="<?=$web['Signature'];?>">
                         <!-- <button class="searchbutton" type="submit">
                            <i class="fa fa-search"></i>
                        </button> -->
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="widewrapper main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 clean-superblock" id="contact">
                    <h2>Register</h2>

                    <form action="index.php?m=index&c=user&a=checkRegister" method="post" accept-charset="utf-8" class="contact-form">
                        <input type="text" name="name" id="contact-name" placeholder="Name" class="form-control input-lg">
                        <input type="password" name="pwd" id="contact-pwd" placeholder="Password" class="form-control input-lg">
						<input type="text" name="email" id="contact-email" placeholder="Email" class="form-control input-lg">
                        <input type="text" name="ver" id="contact-ver" placeholder="Verify" class="form-control input-lg">
						<div id="img-ver">
							<img src="index.php?m=index&c=user&a=yzm" onclick="show();" id="yzm"/> 
						</div>
                        <script>
                            function show()
                            {
                                var obj = document.getElementById('yzm');
                                obj.src = "index.php?m=index&c=user&a=yzm&"+Math.random();
                            }
                        </script>
                        <input type="text" name="phone" placeholder="Phone number" id='mobile' placeholder="Password" class="form-control input-lg">
                        <div class="buttons clearfix">
                            <button type="submit" id="sendmsg" class="btn btn-xlarge btn-clean-one">SMS verification code</button>
                        </div>
                        <input type="text" name="code" class="form-control input-lg" placeholder="Phone Verify">
                        <div class="buttons clearfix">
                            <button type="submit" class="btn btn-xlarge btn-clean-one">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   <footer>
        <div class="widewrapper footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 footer-widget">
                        <h3> <i class="fa fa-user"></i>About me</h3>

                            <table style="width:300px;height:170px;">
                                <tr>
                                    <td>name</td>
                                    <td><?=$web['Owner'];?></td>
                                </tr>
                                <tr>
                                    <td>Signature</td>
                                    <td><?=$web['Signature'];?></td>
                                </tr>
                                <tr>
                                    <td>School</td>
                                    <td><?=$web['School'];?></td>
                                </tr>
                                <tr>
                                    <td>Job</td>
                                    <td><?=$web['Job'];?></td>
                                </tr>
                                <tr>
                                    <td>Hobby</td>
                                    <td><?=$web['Hobby'];?></td>
                                </tr>
                                 <tr>
                                    <td>Nickname</td>
                                    <td><?=$web['Nickname'];?></td>
                                </tr>
                                 <tr>
                                    <td>Tel</td>
                                    <td><?=$web['Tel'];?></td>
                                </tr>
                                 <tr>
                                    <td>Email</td>
                                    <td><?=$web['Email'];?></td>
                                </tr>
                                 <tr>
                                    <td>Postcode</td>
                                    <td><?=$web['Postcode'];?></td>
                                </tr>
                                 <tr>
                                    <td>Address</td>
                                    <td><?=$web['Address'];?></td>
                                </tr>
                            </table>
                    </div>

                    <div class="col-md-4 footer-widget">
                        <h3> <i class="fa fa-pencil"></i>Recent Articles</h3>
                        <ul class="clean-list">
                            <?php if(!empty($re)):?>
                                <?php foreach($re as $val):?>
                                    <li><a href="index.php?m=index&c=single&a=single&pid=<?=$val['pid'];?>"><?=$val['title'];?></a></li>
                                <?php endforeach;?>
                            <?php endif;?>

                        </ul>
                    </div>

                    <div class="col-md-4 footer-widget">
                        <h3> <i class="fa fa-envelope"></i>Contact Me</h3>

                            <table style="width:300px;height:170px;">
                                <tr>
                                    <td>Nickname</td>
                                    <td><?=$web['Nickname'];?></td>
                                </tr>
                                <tr>
                                    <td>Tel</td>
                                    <td><?=$web['Tel'];?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?=$web['Email'];?></td>
                                </tr>
                                <tr>
                                    <td>Postcode</td>
                                    <td><?=$web['Postcode'];?></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><?=$web['Address'];?></td>
                                </tr>
                            </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="widewrapper copyright">
            Copyright 2017 . The Snow is very strong</div>
    </footer>

    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/modernizr.js"></script>

</body>

<script type="text/javascript">
    //验证手机号
    $("#mobile").blur(function(){
        var value = $(this).val();
        //console.log(value,typeof value);
        if ( 0 == value.lenght || "" == value) {
            //alert("手机号不能为空！")
            $(this).focus();
        } else {
            // $.post('index.php?c=user&a=sendSMS',{phone:value},function(data){
            //     if (data) {
            //         alert("手机号重复！");
            //     }
            // });
        }

    });

    var InterValObj; //timer变量，控制时间
    var count = 60; //间隔函数，1秒执行
    var curCount;//当前剩余秒数
    var code = ""; //验证码
    var codeLength = 6;//验证码长度

    $('#sendmsg').click(function () {
        var phone = $("#mobile").val();
        console.log(phone);
        $.post('index.php?c=user&a=sendSMS',{mobile:phone},function(data){
            if(data){
                        console.log(data);
                        curCount = count;
                       //设置button效果，开始计时
                       $("#sendmsg").css("background-color", "LightSkyBlue");
                       $("#sendmsg").attr("disabled", "true");
                       $("#sendmsg").html("获取" + curCount + "秒");
                       InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
                      // alert("验证码发送成功，请查收!");
                  }
        });

        return false;
    })

    function SetRemainTime() {
        if (curCount == 0) {
            window.clearInterval(InterValObj);//停止计时器
            $("#sendmsg").removeAttr("disabled");//启用按钮
            $("#sendmsg").css("background-color", "");
            $("#sendmsg").html("重发验证码");
            code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效
        }
        else {
            curCount--;
            $("#sendmsg").html("获取" + curCount + "秒");
        }
    }
</script>
</html>