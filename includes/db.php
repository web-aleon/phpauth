<?php
// ONLY FOR PHP 5.3+
require_once (__DIR__.'/../libs/rb.php');
R::setup( 'mysql:host=localhost;dbname=phpauth', 'root', 'q1w2e3r4' ); //for both mysql or mariaDB

session_start();