<?php
$ftp_server = "win8044.site4now.net";
$ftp_user = "monorbeta-001";
$ftp_password = "spF528@HkQdHi2n";

$ftp_conn = ftp_connect($ftp_server);

if (!$ftp_conn) {
    throw new Exception('Failed to connect to FTP server.');
}

$login_result = ftp_login($ftp_conn, $ftp_user, $ftp_password);

if (!$login_result) {
    throw new Exception('FTP login failed. Check your credentials.');
}

echo "Connected to FTP server and logged in successfully.";

?>