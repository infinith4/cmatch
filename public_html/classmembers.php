<?php
session_save_path("/home/cmatch/public_html/tmp");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />

<title>受講者</title>
<!-- 全ページ共通start-->
<link rel="shortcut icon" href="img/icon06.ico" type="image/vnd.microsoft.icon">
<!-- 全ページ共通end-->

</head>

<body>
<?php
session_start();
//session_regenerate_id(TRUE);

require('dbconnect.php');
?>
<?php
	//print($_REQUEST['code']);
	$code=$_REQUEST['code'];
	$selclass=$_REQUEST['selclass'];
	$_SESSION[code]=$_REQUEST['code'];
	$_SESSION[selclass]=$_REQUEST['selclass'];

?>

<div align="center">
      <?php
	
	$recordclass=mysql_query("SELECT * FROM $selclass WHERE (code='{$code}')");
    	$tableclass=mysql_fetch_assoc($recordclass);
    	
    	print($tableclass[subject]."<br>");
    	print($tableclass[teacher]."<br>");
    	print("(".$tableclass[time].")<br><br>");
    	
    	?>
    	
    	<?php
    	$m=0;
    	$n=0;
    	
	
    	?>
    	<?php
	$recordsub=mysql_query("SELECT * FROM submitsubject WHERE (time LIKE '%{$tableclass[time]}%')");
	//$tablesub=mysql_fetch_assoc($recordsub);
	//print("recordsub:".count($recordsub));
		while($tablesub=mysql_fetch_assoc($recordsub)){
			
			$recordpro=mysql_query("SELECT * FROM profiles WHERE (memberid='{$tablesub[memberid]}')");
			$tablepro=mysql_fetch_assoc($recordpro);
			if($_SESSION[memberid]!==$tablesub[memberid]){
				
				//print("<td>".$tablepro[handle]."</td>");
				$classmemsid[]=$tablesub[memberid];
				$classmemshan[]=$tablepro[handle];
				
				$n++;
				
			}
			
		}
		print("受講者数：".$n."人<br><br>");
		$row=$n%5;
		//print($row."行<br>");
		//print("<table border='1'><tr>");
		$i=0;
		
		while($i<$n){
			
			
			//print("i:".$i);
			if($i %5===0){
			?>
			
			<a href="membersclass.php?membersid=<?php print($classmemsid[$i]); ?>" target='_blank'>
			<font size="2" color="#3399ff" onmouseout="this.color='#3399ff'" onmouseover="this.color='#cc33ff'">
			<?php print($classmemshan[$i])?>
			</font>
			</a>
			<a href="favoriteadd.php?membersid=<?php print($classmemsid[$i]); ?>"
    			onClick="window.open('favoriteadd.php?membersid=<?php print($classmemsid[$i]); ?>',
    			'win','width=500,height=400,menubar=no,status=no,scrollbars=yes,location=no') ; return false ;">
    			<!--
    			<img src="img/fav02.png" alt="<?php print($classmemshan[$i])?>さんをお気に入りに追加する"  title="<?php print($classmemshan[$i])?>さんをお気に入りに追加する"></a>
			-->
			<img src="img/favadd02.png" onmouseout="this.src='img/favadd02.png';"  onmouseover="this.src='img/onfavadd02.png';" alt="<?php print($classmemshan[$i])?>さんをお気に入りに追加する"  title="<?php print($classmemshan[$i])?>さんをお気に入りに追加する"></a>
			
			<?php	
			}elseif($i %5===4){
			?>	
			<a href="membersclass.php?membersid=<?php print($classmemsid[$i]); ?>" target='_blank'>
			<font size="2" color="#3399ff" onmouseout="this.color='#3399ff'" onmouseover="this.color='#cc33ff'">
			<?php print($classmemshan[$i])?>
			</font>
			</a>
			<a href="favoriteadd.php?membersid=<?php print($classmemsid[$i]); ?>"
    			onClick="window.open('favoriteadd.php?membersid=<?php print($classmemsid[$i]); ?>',
    			'win','width=500,height=400,menubar=no,status=no,scrollbars=yes,location=no') ; return false ;">
    			<img src="img/favadd02.png" onmouseout="this.src='img/favadd02.png';"  onmouseover="this.src='img/onfavadd02.png';" alt="<?php print($classmemshan[$i])?>さんをお気に入りに追加する"  title="<?php print($classmemshan[$i])?>さんをお気に入りに追加する"></a>
			<br>
				
			<?php	
				
			}else{
			?>	
			<a href="membersclass.php?membersid=<?php print($classmemsid[$i]); ?>" target='_blank'>
			<font size="2" color="#3399ff" onmouseout="this.color='#3399ff'" onmouseover="this.color='#cc33ff'">
			<?php print($classmemshan[$i])?>
			</font>
			</a>
			<a href="favoriteadd.php?membersid=<?php print($classmemsid[$i]); ?>"
    			onClick="window.open('favoriteadd.php?membersid=<?php print($classmemsid[$i]); ?>',
    			'win','width=500,height=400,menubar=no,status=no,scrollbars=yes,location=no') ; return false ;">
    			<img src="img/favadd02.png" onmouseout="this.src='img/favadd02.png';"  onmouseover="this.src='img/onfavadd02.png';" alt="<?php print($classmemshan[$i])?>さんをお気に入りに追加する"  title="<?php print($classmemshan[$i])?>さんをお気に入りに追加する"></a>
			
			
			<?php	
				
			}
			$i++;
		}
	
    		
    	?>

</body>

</html>