
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo Core::$URLROOT;?>../css/style.css">
    </head>
        <body>
                
        <form action=""  method="POST">
                user name:<input type="text" name="username" ><br>
                <span> <?php echo $data['usernameError'];?></span><br>
                email:<input type="email" name="email" ><br>
                <span> <?php echo $data['emailError'];?></span><br>
                phone:<input type="text" name="phone" ><br>
                <span> <?php echo $data['phoneError'];?></span><br>
                password:<input type="password" name="password" ><br>
                <span> <?php echo $data['passwordError'];?></span><br>
                confirm password:<input type="password" name="confirm" ><br>
                <span> <?php echo $data['confirmError'];?></span><br>
                <ul>
                        <li><input type="radio" name="template" value="a" > template a<a href="<?php echo Core::$URLROOT;?>templates/a/1"><img src="<?php echo Core::$URLROOT;?>../img/2.jpg" width="40px"/></a></li><br>
                        <li><input type="radio" name="template" value="b" > template b<a href="<?php echo Core::$URLROOT;?>templates/b/1"><img src="<?php echo Core::$URLROOT;?>../img/3.jpg" width="40px"></a></li><br>
                        <li><input type="radio" name="template" value="c" > template c<a href="<?php echo Core::$URLROOT;?>templates/c/1"><img src="<?php echo Core::$URLROOT;?>../img/2.jpg" width="40px"></a></li><br>
                </ul>
                <span> <?php echo $data['templateError'];?></span><br>
                <input type="submit" value='register'>
        </form>  
        </body>
        
</html>
 