<?php
$source = array('ip' => '1',
				'path' => '/var/www/public_html/'
			);
$dest = array( 	
			// 'IP' => 'PATH'
			'2' => '/var/www/public_html/'
			);

$ip_prefix = '192.168.0.';
$rsync_user = 'user';
$rsync_port = '22';

$dont_list = array( '.', '..', '.ssh', '.Xauthority', '.bash_history', '.lesshst', '.viminfo', '.lftp', '.git' );
?>