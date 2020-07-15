    用户：<input type="text" name="name" placeholder="公司名"><br/>
    密码：<input type="password" name="pwd"><br/>
    <button type="submit" id="login">登录</button>
<script src="/static/jquery.min.js"></script>
<script>
    $(function(){
        $(document).on('click','#login',function(){
            var data = {};
            data.name = $('input[name=name]').val();
            data.pwd = $('input[name=pwd]').val();
            $.ajax({
                data:data,
                dataType: 'json',
                type:'post',
                url:'/login/do_login',
                success:function (res) {
                    if(res.errno == '00000'){
                        alert(res.msg);
                        location.href = '/';
                    }
                }
            });
        })


    })
</script>