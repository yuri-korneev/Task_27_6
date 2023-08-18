<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Сервис работы с картинками</title>
<link rel="stylesheet" type="text/css" href="/css/style.css" media="screen" />
</head>

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous"> -->

<link rel="stylesheet" href="/css/bootstrap.min.css" crossorigin="anonymous">

<body onload="new Accordian('basic-accordian',5,'header_highlight');">

	<div id="header">
    	<div id="logo"><a href="/main"><img src="/images/logo_new.gif" alt="" title="" border="0" /></a></div>
    
        <div id="menu">
            <ul>                                              
                <li><a class="current" href="/main" title="">Главная</a></li>
                <li class="divider"></li>
                <li><a href="/main/about" title="">О нас</a></li>
                <li class="divider"></li>
                <li><a href="/main/news" title="">Новости</a></li>
                <li class="divider"></li>
                <li><a href="/signup" title="">Регистрация</a></li>
                <li class="divider"></li>
                <li><a href="/login" title="">Авторизация</a></li>
                <li class="divider"></li>
                <li><a href="/login/logout" title="">Выйти</a></li>
                <li class="divider"></li>
                <li><a href="/main/contacts" title="">Контакты</a></li>
            </ul>
        </div>
    
    </div>

    <div id="middle_box">

    </div>
    
<div id="main_content">
    
    <?php if (isset($_SESSION['logged_user'])) : ?>
        
        <font color="#a3659a"><b><?php echo $_SESSION['logged_user']->username . ', ' . 'Вы авторизованы!'?></font></b><br>

    <?php elseif ( isset($_SESSION["role"]) && $_SESSION["role"] == 'VK') : ?>

        <font color="#a3659a"><b><?php echo $_SESSION["username"] . ', ' . 'Вы авторизованы!'?></font></b><br>

    <?php endif ?>


    <div id="img_big">

    </div>         
           
    
    <div class="content">
        
    <?php include_once $content_view; ?>

    </div> 

    
            
            
     <div id="footer">
     	<div class="copyright">
        <img src="/images/footer_logo_new.gif" alt="" title="" />
        </div>
    	<div class="footer_links">
       <!-- <a href="http://csstemplatesmarket.com"><img src="images/csstemplatesmarket.gif" alt="csstemplatesmarket" title="csstemplatesmarket" border="0" /></a> -->
        </div>
    
    
    </div>


</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- <script src="/JS/jquery-3.3.1.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="/JS/bootstrap.bundle.min.js"></script>

    <script src="/JS/form_signup.js"></script>  
    <script src="/JS/form_login.js"></script>
    <script src="/JS/form_upload.js"></script>
    <script src="/JS/form_img.js"></script>
   
    
</body>
</html>
