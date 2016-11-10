<?php
/**
 * Created by PhpStorm.
 * User: umut
 * Date: 10/11/16
 * Time: 15:03
 */

ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);

include ('adConfig.php');
include ('myDFP.php');


$dfp = new myDFP($config);

$dfp->init();
?>
<html>
<head>

<?php echo $dfp->getHead();?>
</head>

<body>
<?php echo $dfp->displayAd('toproll');?>

    
<?php echo $dfp->displayAd('sidebar-1');?>
</body>
</html>
