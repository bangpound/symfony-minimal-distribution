#!/usr/bin/env php
<?php

/*
 * This file is part of the Symfony Standard Edition.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Bundle\MinimalBundle\Composer\ScriptHandler;

if (PHP_SAPI !== 'cli') {
    echo 'Warning: '.__FILE__.' should be invoked via the CLI version of PHP, not the '.PHP_SAPI.' SAPI'.PHP_EOL;
}

function getRealpath($path, $message = 'Directory %s does not seem to be valid.')
{
    if (!$path = realpath($path)) {
        exit(sprintf($message, $path));
    }

    return $path;
}

$argv = $_SERVER['argv'];
$autoloadDir = $bootstrapDir = null;

// allow the base path to be passed as the first argument, or default
if (isset($argv[1])) {
    $bootstrapDir = getRealpath($argv[1]);
    if (isset($argv[2])) {
        $autoloadDir = getRealpath($argv[2]);
    }
}

$rootDir = __DIR__.'/../../../../../../../..';
if (null === $autoloadDir) {
    $autoloadDir = getRealpath($rootDir.'/app', 'Looks like you don\'t have a standard layout.');
}
if (null === $bootstrapDir) {
    $bootstrapDir = getRealpath($rootDir.'/var');
}

require_once $autoloadDir.'/autoload.php';

// here we pass realpaths as resolution between absolute and relative path can be wrong
ScriptHandler::doBuildBootstrap($bootstrapDir, $autoloadDir);
