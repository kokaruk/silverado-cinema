<?php

/* Important Notice:
 *  Do not use on Coreteaching servers. Use debug module instead.
 *  This code is only for local and protected cloud servers.
 *  It is a voilation of RMIT policy to use this on Coreteaching servers.
 */
 
if (strpos($_SERVER['SERVER_NAME'],'csit.rmit.edu.au')!==false) {
  include_once('/home/eh1/e54061/public_html/wp/debug.php');
} else {
// turns off error reporting from this point on so students are not bothered with annoying messages and notices etc.
  error_reporting(0);
  
  $sessionMsg='';
  if(!isset($_SESSION)) {
    $sessionMsg="*** need session_start() ***\n";
    session_start();
  }

// string to-from boolean conversion functions
  function b2s($bP)
  {
    return $bP ? "true" : "false";
  }
  function s2b($sP)
  {
    return ($sP == "true");
  }

// Action flag defaults
  $flags['Reverse']=false;
  $flags['KeepOpen']=true;
  $flags['LargeFont']=false;
  $flags['AbsolutePosition']=false;
 
// Modify flags
  function cookFlag($fP)
  {
    global $flags;
    $exp=time()+3600*24*7*12;
    $logicCombo = ((isset($_POST['action']) && $_POST['action'] == $fP) ? 1 : 0);
    $logicCombo += (isset($_COOKIE[$fP]) ? 2 : 0);
    //$_SESSION['debug'][$fP]=$logicCombo;
    
    switch ($logicCombo) {
      case 0: // first time, no cookie, no action - set default flag
      case 1: // no cookie, action pressed; won't happen, safety fallback
        setcookie($fP,b2s($flags[$fP]),$exp);
        break;
      case 2: // cookie set, no action, update flag from cookie
        $flags[$fP] = s2b($_COOKIE[$fP]);
        break;
      case 3: // cookie set, action pressed, toggle cookie and flag
        setcookie($fP,( (s2b($_COOKIE[$fP]) ? 'false' : 'true')),$exp);
        $flags[$fP] = !s2b($_COOKIE[$fP]);
        break;
    }
  }

// update flags from cookies
  cookFlag('Reverse');
  cookFlag('KeepOpen');
  cookFlag('LargeFont');
  cookFlag('AbsolutePosition');

// Takes a pipe delimited names string, returns a session branch
  function makeSessionBranch($nameP)
  {
    $nameA = explode('|',$nameP); 
    $nameE='$_SESSION';
    foreach ($nameA as $segment)
    {
      if (preg_match('/^[0-9]+$/',$segment))
        $nameE.="[$segment]";
      else
        $nameE.="['$segment']";
        
    }
    return $nameE;
  }

  if (isset($_POST['action']))
  {
    if ($_POST['action']=='Reset')
    {
      if(empty($_POST['name']))
      {
        foreach ($_SESSION as $key => $value)  
          if ($key!='hood')
            unset($_SESSION[$key]);
      }
      else
        eval('unset('.makeSessionBranch($_POST['name']).');');
    } 
    else if ($_POST['action']=='Set')
    {
      $nameE = makeSessionBranch($_POST['name']);
      if(empty($_POST['value'])||$_POST['value']=='false')
        $nameE.'=false;';
      else if($_POST['value']=='true')
        $nameE.='=true;';
      else 
        $nameE.='=$_POST[\'value\'];';    
      eval($nameE);      
    }
  }

  $colors = ( ($flags['Reverse'] ) ?
  'background-color:#ffe; color:#006' :
  'background-color:black; color:yellow' );


  $fontSize = ( ($flags['LargeFont'] ) ?
  'font-size:14pt;' :
  'font-size:10pt;' );

  $open = ( ($flags['KeepOpen'] ) ?
  ' open' :
  '' );

  $absPn = ( ($flags['AbsolutePosition'] ) ?
  ' position: absolute; ' :
  '' );

?>

<style>
  #WP-debug {
    z-index: 10;
    <?php echo $absPn; ?>
    background-color:rgba(255,255,255,0.6);
  }
  #WP-debug * {
    font-family: "Courier New", monospace !important;
  }
  #WP-debug details {
    overflow: visible;
  }

  #WP-debug pre {
    clear:both;
    white-space: pre-wrap;       /* css-3 */
    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    word-wrap: break-word;       /* Internet Explorer 5.5+ */
    text-align:left;
    <?php echo $fontSize; ?>
    padding-left: 10px;
    min-width:900px;
    padding-bottom:100px;
    <?php echo $colors; ?>
  }
  #WP-debug pre div {
    margin-left: 100px;
    text-indent: -100px;
  }
  
  #WP-debug form span {
    box-shadow: 0px 0px 2px 2px rgba(0,0,0,0.3);
    margin: 0px 5px;
    padding: 5px;
  }
  #WP-debug input { max-width: 100px; }
</style>
<div id='WP-debug'>
<details <?php echo ($open) ; ?>>
  
<summary>Debug Show/Hide</summary>
<p>
  <form method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' >
    <span>SESSION Name:
    <input type=text name=name /> Value: <input type=text name=value />
    <input type=submit name=action value=Set />
    <input type=submit name=action value=Reset /></span>
    <span>LocalStorage:
    <input type='button' value='Log' onclick='console.log(localStorage);' />
    <input type='button' value='Clear' onclick='localStorage.clear();' /></span> 
    <span>Module:
    <input type=submit name=action value='KeepOpen' />
    <input type=submit name=action value='Reverse' />
    <input type=submit name=action value='LargeFont' />
    <input type=submit name=action value='AbsolutePosition' /></span>
  </form>
</p>

<pre>
$_SESSION contains:
<?php echo $sessionMsg; print_r($_SESSION); ?>

$_POST contains:
<?php print_r($_POST); ?>

$_GET contains:
<?php print_r($_GET); ?>

$_COOKIE contains:
<?php print_r($_COOKIE); ?>

<?php
  error_reporting(0);

/* Debug Lite:
   Page code will always be printed. No checks for staff or student access.
   Feel free to put in your own security check below (ie replace true with something decent)
   Only use on locally hosted or protected cloud environments such as private cloud9 environments
*/

  $lines=file($_SERVER['SCRIPT_FILENAME']);
  foreach($lines as $i => $line)
    printf("%3u: %1s",$i+1,htmlentities($line),"\n");
  echo "<hr>";
  
?>
</pre>
</details>
<?php } ?>