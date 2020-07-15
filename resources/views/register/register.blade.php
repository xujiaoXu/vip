<form action="/do_register" method="post">
    公司名：<input type="text" name="name"><br/>
    法人：<input type="text" name="man"><br/>
    公司地址：<input type="text" name="address"><br/>
    联系人电话：<input type="text" name="tel"><br/>
    Email:<input type="text" name="youxiang"><br/>
    密码：<input type="password" name="pwd"><br/>
    确认密码：<input type="password" name="repwd"><br/>
    <button type="submit" id="reg">注册</button>
    <button type="reset">重置</button>
    <a href="{{url('login/login')}}"><h5 style="color:pink">去登录</h5></a>

    <form>
<script src="/static/jquery.min.js"></script>
<script>
    $(function(){
        $(document).on('click','#reg',function(){
            var data = {};
            data.name = $('input[name=name]').val();
            data.man = $('input[name=man]').val();
            data.address = $('input[name=address]').val();
            data.tel = $('input[name=tel]').val();
            data.youxiang = $('input[name=youxiang]').val();
            data.pwd = $('input[name=pwd]').val();
            var repwd = $('input[name=repwd]').val();
            if(data.pwd != repwd){
                alert('两次密码必须一致!');
                return false;
            }
            $.ajax({
                data:data,
                type:'post',
                dataType:'json',
                url:'/do_register',
                success:function(res){
                    if(res.errno == '00000'){
                        alert(res.msg);
                        location.href = '/login/login'
                    }else{
                        alert(res.msg);
                    }
                }
            });
        });
    })
</script>
