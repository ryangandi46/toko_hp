<!DOCTYPE html>
<html>
<head>   
<title>Berkah Jaya</title>
 
 <link rel="preconnect" href="https://fonts.gstatic.com">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
 <!--Stylesheet-->
 <style media="screen">
   *,
*:before,
*:after{
 padding: 0;
 margin: 0;
 box-sizing: border-box;
}
body{
 background-color: #080710;
}
.background{
 width: 430px;
 height: 520px;
 position: absolute;
 transform: translate(-50%,-50%);
 left: 50%;
 top: 50%;
}
.background .shape{
 height: 200px;
 width: 200px;
 position: absolute;
 border-radius: 50%;
}
.shape:first-child{
 background: linear-gradient(
     #1845ad,
     #23a2f6
 );
 left: -80px;
 top: -80px;
}
.shape:last-child{
 background: linear-gradient(
     to right,
     #ff512f,
     #f09819
 );
 right: -30px;
 bottom: -80px;
}
form{
 height: 520px;
 width: 400px;
 background-color: rgba(255,255,255,0.13);
 position: absolute;
 transform: translate(-50%,-50%);
 top: 50%;
 left: 50%;
 border-radius: 10px;
 backdrop-filter: blur(10px);
 border: 2px solid rgba(255,255,255,0.1);
 box-shadow: 0 0 40px rgba(8,7,16,0.6);
 padding: 50px 35px;
}
form *{
 font-family: 'Poppins',sans-serif;
 color: #ffffff;
 letter-spacing: 0.5px;
 outline: none;
 border: none;
}
form h3{
 font-size: 32px;
 font-weight: 500;
 line-height: 42px;
 text-align: center;
}

label{
 display: block;
 margin-top: 30px;
 font-size: 16px;
 font-weight: 500;
}
input{
 display: block;
 height: 50px;
 width: 100%;
 background-color: rgba(255,255,255,0.07);
 border-radius: 10px;
 padding: 0 10px;
 margin-top: 8px;
 font-size: 14px;
 font-weight: 300;
}

.checkbox{
 display: inline-block;    
 width: 10%;    
}
::placeholder{
 color: #e5e5e5;
}
button{
 margin-top: 10px;
 width: 100%;
 background-color: #ffffff;
 color: #080710;
 padding: 15px 0;
 font-size: 18px;
 font-weight: 600;
 border-radius: 10px;
 cursor: pointer;
}


 </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post" action="login.php">
        <h3>Login Here</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="Username" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password"  name="password" id="pass" required>

        <div class="checkbox">
            <input style="height: 20px;"type="checkbox" name="" onclick="show()">            
        </div>
        <span>Show Password</span><br>

        <button name="login">Log In</button>        
        <button name="Reset">Reset</button>        
    </form>
    <script>
        function show() {
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";                
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>
