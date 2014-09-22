<ul class="jqueryFileTree" style="display: none;">
<?php
include '../config.php';
$dir = $_POST['dir'];
$array_d = array();
$array_f = array();
$dir = str_replace("%20"," ",$dir);
if (is_dir($dir))
    if ($dh = opendir($dir))
        while (($file = readdir($dh)) !== false)
//			if ($file!='..' and $file!='.' and $file!='.ssh')
			if (!in_array($file, $dont_list))
				(filetype($dir.$file)=='dir')? $array_d[] = $file : $array_f[] = $file;
closedir($dh);

sort($array_d);
sort($array_f);

foreach( $array_d as $d )
	echo '<li class="directory collapsed"><a href="#" rel="'.$dir.$d.'/">'.$d.'</a>&nbsp;&nbsp;<span onclick="add_dir(\''.$dir.$d.'/\')" class="add">[add]</span></li>';
foreach( $array_f as $f )
	echo '<li class="file ext_'.pathinfo($f, PATHINFO_EXTENSION).'"><a href="#" rel="'.$dir.$f.'/">'.$f.'</a>&nbsp;&nbsp;<span onclick="add_dir(\''.$dir.$f.'\')" class="add">[add]</span></li>';
?>
</ul>
