<?php

/*
 * This file is part of the php-cliparser package.
 *
 * (c) Koma <komazhang@foxmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$baseDir = dirname(__DIR__);
require $baseDir.'/vendor/autoload.php';

// /path/to/your/scriptfile.php --config test.yml -d -n 1 --name koma
$parser = new \CliParser\CliParser();
$parser->parse();

var_dump($parser->hasArgs('config'));
var_dump($parser->getArgs('config'));
var_dump($parser->getAllArgs());
