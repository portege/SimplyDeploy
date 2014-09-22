<?php
# desc: deploy application to production servers
# boi - portege@gmail.com
# 20091018
# original filename : rsync

include 'config.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>SimplyDeploy</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<script src="inc/jquery.js" type="text/javascript"></script>
		<script src="inc/jquery.easing.js" type="text/javascript"></script>
		<script src="inc/jqueryFileTree.js" type="text/javascript"></script>
		<link href="inc/jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="inc/main.css" rel="stylesheet" type="text/css" media="screen" />
		<script type="text/javascript">

			$(document).ready( function() {

				$('#fileTreeDemo_1').fileTree({ root: '<?php echo $source['path']; ?>', script: 'inc/jqueryFileTree.php' }, function(file) {
					alert(file);
				});
			});
		</script>

		<script type="text/javascript">
			var c = 0;
			$("#list_dir span").live("click", function() {
				var v = $(this).attr("id").replace('b','');
				$("#t"+v).remove();
				$("#f"+v).remove();
				c--;
				return false;
			});

			function add_dir(s){
				++c;
				root = "<?php echo $source['path']; ?>";
				$("#list_dir").append("<div id=\"t"+c+"\">"+s+"&nbsp;&nbsp;<span class=\"add\" id=\"b"+c+"\">[remove]</span></div>");
				s = s.replace(root,'');
				$("#form_dir").append("<input name=\"field_dir[]\" id=\"f"+c+"\" type=\"hidden\" value=\""+s+"\">");
			}

			function do_rsync(){
				var x = $('#form');
				$('input[name=button_deploy]', x).attr('value', 'Loading..').attr('disabled', 'disabled');

 				$.post("rsync.php", $("#form_dir input").serialize(), function(data){
					$("#progress").html(data);
					$('input[name=button_deploy]', x).attr('value', 'Deploy!').removeAttr('disabled');
				});
			}
		</script>

</head>

<body>
	<div class="container">
		<div class="example">
			<h2>Source path (<?php echo $source['path']; ?>)</h2>

			<div id="fileTreeDemo_1" class="demo"></div>
		</div>
		<div class="example" style="padding-left:4%;">
			<h2>File(s) to deploy</h2>
			<div id="list_dir" class="demo"></div><div id="form_dir"></div>
		</div>
		<div style="clear:both; padding:10px; text-align:center;"><form name="form" id="form"><input type="button" name="button_deploy" value="Deploy!" onClick="do_rsync();"> </form></div>
		<div class="progress" id="progress"></div>
	</div>
</body>
</html>
