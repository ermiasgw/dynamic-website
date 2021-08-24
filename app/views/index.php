<html>
    <body>
        <header>
            <h2> logo </h2>
            <form action="" method='GET'>
                <input type="search" name='search'>
                <input type="submit" value="search">
            </form >
            <?php
                    if(isLoggedIn()){
                        echo '<a href="'.Core::$URLROOT.'users/logout">log out</a>';
                    }else{
                        echo '<a href="'.Core::$URLROOT.'users/login">log in</a>';
                        echo '<a href="'.Core::$URLROOT.'users/register">register</a>';
                    }
            ?>
        </header>
        <div>
            <ul>
                <?php
                    if(isLoggedIn()){
                        echo '<li><a href="'.Core::$URLROOT.'templates/'.$_SESSION['template'].'/'.$_SESSION['username'].'">my website</a></li>';
                        echo '<li><a href="#">update my template</a></li>';
                        echo '<li><a href="#">about me</a></li>';
                    }
                ?>
                
                
                
            </ul>
        </div>
        <div>
            <ul>
                <?php
                    if($data['OBJ']){
                        foreach($data['OBJ'] as $a){
                            echo '<li><a href="'.Core::$URLROOT.'templates/'.$a->template.'/'.$a->username.'">'.$a->username.' '.$a->rank.'</a></li>';
                        }
                    }else{
                        echo 'no result';
                    }
                
                
                
                ?>
            </ul>
        </div>
        
        
    </body>
</html>