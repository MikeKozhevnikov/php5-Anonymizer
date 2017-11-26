<?php 

if (basename(__FILE__) == basename($_SERVER['PHP_SELF']))
	{
	exit(0);
	}
echo '<?xml version="1.0" encoding="utf-8"?>';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="utf-8">
<head>
<title>PHP 5 Proxy anonymizer</title>
<link rel="stylesheet" type="text/css" href="style.css" title="Default Theme" media="all" />
</head>
<body bgcolor=#1c1c1c background="bg.png" onload="document.getElementById('address_box').focus()">
<center>
<img src="proxy.png">

<table>
<div id="container"><td>

  <ul id="navigation">
    <lif><a href="<?php echo $GLOBALS['_script_base'] ?>"></a></li>
    <lif><a href="javascript:alert('cookie managment has not been implemented yet')"></a></li>
  </ul>

<?php

switch ($data['category'])
{
    case 'auth':
?>

  <div id="auth"><p>
  <b>Enter your username and password for "<?php echo htmlspecialchars($data['realm']) ?>" on <?php echo $GLOBALS['_url_parts']['host'] ?></b>
  <form method="post" action="">
    <input type="hidden" name="<?php echo $GLOBALS['_config']['basic_auth_var_name'] ?>" value="<?php echo base64_encode($data['realm']) ?>" />
    <label>Username <input type="text" name="username" value="" /></label> <label>Password <input type="password" name="password" value="" /></label> <input type="submit" value="Login" />
  </form></p></div>

<?php

break;
    case 'error':
echo '<div id="error"><p>';

switch ($data['group'])
{
    case 'url':
echo '';
switch ($data['type'])
{
    case 'internal':
$message = '';
break;
    case 'external':
switch ($data['error'])
{
    case 1:
$message = '';
break;
case 2:
$message = '';
break;
}
break;
}
break;
case 'resource':
echo '<b></b> ';
switch ($data['type'])
{
case 'file_size':
$message = '<br />'
 . 'Maxiumum permissible file size is <b>' . number_format($GLOBALS['_config']['max_file_size']/1048576, 2) . ' MB</b><br />'
 . 'Requested file size is <b>' . number_format($GLOBALS['_content_length']/1048576, 2) . ' MB</b>';
break;
    case 'hotlinking':
$message = 'It appears that you are trying to access a resource through this proxy from a remote Website.<br />'
 . 'For security reasons, please use the form below to do so.';
break;
}
break;
}
echo '' . $message . '</p></div>';
break;
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
<ul id="form">
<div id="address_bar"><label><input style="font-size:16px; color:#e2e2e2; border-radius:8px; border:3px solid #e70555; height:26px; width:270px; margin-top:5pt; margin-left:1pt; background-color:#4c4c4c;" value="http://" id="address_box" type="text" name="<?php echo $GLOBALS['_config']['url_var_name'] ?>" value="<?php echo isset($GLOBALS['_url']) ? htmlspecialchars($GLOBALS['_url']) : '' ?>"  />
<BR><BR><BR>    

<?php
foreach ($GLOBALS['_flags'] as $flag_name => $flag_value)
	{
	if (!$GLOBALS['_frozen_flags'][$flag_name])
		{
		echo '<div class="option"><label><input style="margin-left:5pt;" type="checkbox"  name="'
			 . $GLOBALS['_config']['flags_var_name'] . '[' . $flag_name . ']"' 
			 . ($flag_value ? ' checked="checked"' : '') . ' />' 
			 . $GLOBALS['_labels'][$flag_name][1] . '</label></li>' . "\n";
		}
	}
?>

</ul></table></label></li>
</form>
</div>
</body>
</html>