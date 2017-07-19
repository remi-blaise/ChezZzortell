<?php
session_start();
include_once ('included/stats/Visitor.class.php');
include_once ('included/stats/VisitorManager.class.php');
include_once ('included/stats/DbConnection.class.php');
new Visitor ( new VisitorManager ( DbConnection::newDb() ) );