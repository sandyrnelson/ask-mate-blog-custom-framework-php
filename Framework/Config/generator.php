<?php

/* This script has to be run in the following cases:
	1) Initializing project for BK-Framework
	2) Updating configuration data
*/

require_once("ConfigGenerator.php");

use BK_Framework\Config\ConfigGenerator;

$generator = new ConfigGenerator();
$generator->run();
