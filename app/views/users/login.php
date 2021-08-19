
<html>
    <body>
        
    
        <form action="<?php echo URLROOT;?>/users/login" method="post">
            <label for="uname">user name</label>
            <input type="text" name="uname"><br>
            <span> <?php echo $data['unameerror'];?></span>
            <label for="pass">password</label> 
            <input type="password" name="pass"><br>
            <input type="submit" value="login">
        </form>  
        </body>





</html>



<?php
    echo $data['title'];
    ?>