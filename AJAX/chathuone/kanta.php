<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysql = new mysqli('localhost', 'chat-kayttaja', 'salasana123', 'chatkanta');
?>