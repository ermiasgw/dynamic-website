
<html>
    <body>
        
    
        <form action="" method="post">
            user name:<input type="text" name="username"><br>
            <span> <?php echo $data['usernameError'];?></span><br>
            password:<input type="password" name="password"><br>
            <span> <?php echo $data['passwordError'];?></span><br>
            <input type="submit" value="login">
        </form>  
        </body>
</html>
