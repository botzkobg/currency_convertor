<?php
//Auto loader
spl_autoload_register( function ($className) {
	$className = ltrim($className, '\\');
	$fileName  = '';
	if ($lastNsPos = strrpos($className, '\\')) {
		$namespace = substr($className, 0, $lastNsPos);
		$className = substr($className, $lastNsPos + 1);
		$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	}
	$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

	require_once $fileName;
});

/**
 * Show usage and exit
 */
function showUsage() {
	echo 'Not correct usage !
Uage: php ./' . basename(__FILE__) . ' {quantity} {source} {destination}
Example: php ./' . basename(__FILE__) . ' 10.00 USD EUR
';

	exit(1);
}

if (count($argv) != 4)
	showUsage();

list($script, $quantity, $from, $to) = $argv;

if (doubleval($quantity) != $quantity)
	showUsage();

$converter = new \Libs\Currency\Converter();
echo "Converting {$quantity} {$from} to {$to}\n";
echo "Course: 1.00 {$quantity} to " . $converter->getConvertCourser($from, $to) . " {$to}\n";
echo "{$quantity} {$from} = " . $converter->convert($from, $to, $quantity) . " {$to}\n";
