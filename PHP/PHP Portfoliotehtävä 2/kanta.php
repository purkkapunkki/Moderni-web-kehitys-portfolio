<?php
# TODO: siirrä omaan tiedostoon, tai nimeä tämä tiedosto uudelleen?
session_start();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysql = mysqli_connect("localhost", "utelias", "12345", "kysymyskanta");
$mysql->query("SET NAMES utf8;");
?>