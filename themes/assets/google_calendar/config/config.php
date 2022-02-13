<?php
$root = "http://" . $_SERVER['HTTP_HOST'];
$currentDir = str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$root .= $currentDir;
$config['base_url'] = $root;