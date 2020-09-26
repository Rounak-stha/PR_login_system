<?php 
	require "header.php"
?>

<main>
	<div class="anything">
      <form action = "includes/login.php" method = "POST">
         <!--   con = Container  for items in the form-->
         <div class="con">
         <header class="headform">
            <h2>Hello There!</h2>
            <p>Welcome! You can login here using your username and password.</p>
         </header>
         <br>
         <div class="fieldset">
               <span class="input-item">
                 <i class="user-circle"></i>
               </span>
               <input name = "username" class="form-input" id="txt-input" type="text" placeholder="UserName" required>   
            <br>         
               <input name = "email" class="form-input" id="txt-input" type="text" placeholder="email" required>   
            <br>          
            <span class="input-item">
              <i class="key"></i>
             </span>
            <input class="form-input" type="password" placeholder="Password" id="pwd"  name="password" required>          
            <br>
            <button name = "login-submit" value = "submit" class="log-in"> Log In </button>
         </div>
         <div class="other">
            <button class="btn submits frgt-pass">Forgot Password</button>
            <button name = "signup-submit" value = "submit" class="btn submits sign-up">Sign Up
            <i class="user-plus" aria-hidden="true"></i>
            </button>

         </div>
                
        </div>      
      </form>
      </div>
      <script type="text/javascript" src="dom.js"></script>
</main>

<?php 
	require "footer.php"
?>