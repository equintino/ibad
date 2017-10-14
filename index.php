<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
       <title>Login</title>
    <link rel="stylesheet" href="web/css/global.css" />
    <link rel="stylesheet" href="web/css/login-style.css" />
    <script>
        $(document).ready(function(){
            $(':submit').click(function(){
                var login=$(':text').val();
                var senha=$(':password').val();
                document.cookie='login='+login+';path=/';
                document.cookie='senha='+senha+';path=/';
            })
        })
    </script>
</head>
    <body class="login" >
<div id="auth_wraper">
    <div class="auth_header">
        <img src="web/logo.png" alt="IBAD" height='70px' />
    </div>
    <div id="auth_container">
        <!--Signup Container-->
        <div id="login_container">
            <h2 class="signup_heading" >Entre com seu Login</h2>
            <div class="login_or"></div>
            <div id="div_error_box_login" ></div>
                <form action="main.php" name='formlogin' id="signinForm" class="signinForm" method="post" >   
                <ul>
                    <li>
                        <input type="text" name="login" id="uname_log" value="" placeholder="Login" class="required requiredField Email fg-input text fg-fw" autofocus />
                    </li>
                    <li>
                        <input type="password" name="senha" id="password_log" value="" placeholder="Senha" class="required requiredField  fg-input text fg-fw" />
                    </li>
                    <li>
                        <div class="clear"></div>
                        <input class="submit signin_btn fg-btn blue large inline fg-fw bold" type='submit' value="Entre"/>
                        <input type="hidden" name="submitted" id="submitted" value="true" />
                    </li>
                </ul>
                </form> 
        </div>
    </div>                   		
</div>
</body>
</html>