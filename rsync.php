<?php
include 'config.php';

$str = '';

foreach( $_POST as $P )
	foreach( $P as $p )
		foreach( $dest as $d => $f){
			$c = "rsync --delete -e 'ssh -p $rsync_port' -a -P -z --force {$source['path']}$p $rsync_user@$ip_prefix$d:$f$p\n";
			echo $c;
			$str = exec($c,$output);

			if (count($output)>0)
				for($r=0; $r < count($output);$r++)
					echo nl2br($output [$r]).' ';
			echo '<hr />';
		}

//$str = exec("rsync --delete -e 'ssh -p 22' -a -P -z --force /var/www/public_html/ user@192.168.10.2:/var/www/public_html/",$output);			
?>
