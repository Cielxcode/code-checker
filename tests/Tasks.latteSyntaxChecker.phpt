<?php

use Nette\CodeChecker\Result;
use Nette\CodeChecker\Tasks;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';


test(function () {
	$result = new Result;
	Tasks::latteSyntaxChecker('', $result); // no error
	Assert::same([], $result->getMessages());
});

test(function () {
	$result = new Result;
	Tasks::latteSyntaxChecker('{hello}', $result); // ignores unknown macros
	Assert::same([[Result::WARNING, 'Unknown macro {hello}', 1]], $result->getMessages());
});

test(function () {
	$result = new Result;
	Tasks::latteSyntaxChecker('{hello', $result);
	Assert::same([[Result::ERROR, 'Malformed macro', 1]], $result->getMessages());
});
