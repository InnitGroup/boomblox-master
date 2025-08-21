
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" id="Boomblox">
<head>
<title>Boomblox | Welcome to Boomblox!</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="/CSS/Facebook/Facebook.css?14793" type="text/css"/>
<link rel="stylesheet" href="/CSS/Facebook/FacebookPro.css?12612" type="text/css"/>
<link rel="stylesheet" href="/CSS/Facebook/Info.css?12612" type="text/css"/>
</head>
<body class="welcome">
 
<div id="book">
<div id="pageheader"><h1 id="homelink"><a href="http://bmblox.xyz/">Facebook</a></h1>
<ul id="gnav">
<li><a href="/Login/Default.aspx">login</a></li>
<li><a href="/Login/New.aspx">register</a></li><li><a href="http://www.facebook.com/help.php">help</a></li>
</ul>
</div>

<div id="sidebar">
<div id="squicklogin">
<form method="post" name="loginform" action=""><input type="hidden" name="challenge" value="a85d4494847795bfe3df46cb7e4bf096">
    <label for="email">Email:</label>
    <input type="hidden" name="noerror" value="1"/>
    <input class="inputtext" type="text" name="email" value="" id="email" size="20"/>
    <label for="pass">Password:</label>
    <input class="inputtext" type="password" name="pass" id="pass" size="20"/>
    <table>
    <tr>
    <td>
    <input type="submit" class="inputsubmit" value="Login" id="doquicklogin" name="doquicklogin"/>
    </td>
    <td>
    &nbsp;
    </td>
    <td>
      <input type="button" class="inputsubmit" value="Register" id="doquickregister" name="doquickregister"/>
    </td>
    </tr>
</table>
</form>
</div>
<div id="ssponsor" class="sponsors"></div></div>
<div id="pagebody" class="pagebody welcome"><div id="header">
  <h1>Welcome to Boomblox!</h1>
</div>
<div id="content">
<!-- 2365fa3194ecdc0cab15721ce967a9f8663937c7 -->

<div class="infocontent">

<h2>Boomblox is a 2008 recreation of the Roblox site and client.</h2>

<p>The site is open to <a href="networks.php">a lot of users</a>, but not everywhere yet. We are in private testing.</p>

<p>You can use Boomblox to:</p>
<ul class="square_bullets">
  <li><span>Make friends on the internet.</span></li>
  <li><span>Play fun games with explosions.</span></li>
  <li><span>Build anything in your imagination.</span></li>
</ul>
<div class="center" style="width:150px;"><input type="button" class="inputbutton" onclick="loginform.submit()" id="login" name="login" value="Login"/>&#8194;<input type="button" class="inputbutton" onclick="document.location='r.php'" id="register" name="register" value="Register"/></div></div>

<script language="javascript" type="text/javascript">
  var email = ge("email");
  var pass = ge("pass");
  var dologin = ge("doquicklogin");
  if (email && pass) {
    if (email.value != "" && pass.value == "") {
      pass.focus();
    } else if (email.value == "") {
      email.focus();
    } else if (email.value != "" && pass.value != "") {
      dologin.focus();
    }
  }
</script>


</div>
<!-- content -->

<div id="pagefooter">
<ul id="fnav">
<li><a href="/info/About.aspx">about</a></li>
<li><a href="/info/Jobs.aspx">jobs</a></li>
<li><a href="/info/TermsOfService.aspx">terms</a></li>
<li><a href="/info/Privacy.aspx">privacy</a></li>
</ul>

<p>a george0001 & marsoc production</p>
  <p>Boomblox | EST Jul 2024</p>
</div>
</div>
<!-- book -->
<!-- ads -->
<div class="sponsors" style="width: 760px; text-align: center; clear: both; margin: 10px auto 15px auto;"></div>
<!-- ads -->
</body>
</html>