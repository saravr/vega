<!DOCTYPE html> 
<html> 
<head> 
  <meta name=viewport content="user-scalable=no,width=device-width" />
  <link rel="stylesheet" href="http://code.jquery.com/mobile/latest/jquery.mobile.css" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/mobile/latest/jquery.mobile.js"></script>

</head> 

<body> 

<div data-role=page data-add-back-btn=true 
     data-back-btn-text=Previous>
  <div data-role=header>
    <h1>Window 2</h1>
  </div>

  <div data-role=content>
    <p> Window content </p>
  </div>

  <div data-role=content>
    <p> Window content </p>
    <a href=./back2.php?xx=yy data-role=button> Goto window 3 </a>
  </div>
</div>

</body>
</html>
