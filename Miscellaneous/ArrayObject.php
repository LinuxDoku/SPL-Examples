<?php
namespace Miscellaneous\ArrayObjects;

class BetterArrayObject extends \ArrayObject {
	public function __get($name) {
		return $this[$name];
	}
	
	public function __set($name, $value) {
		$this[$name] = $value;
	}
	
	public function toArray() {
		return (array)$this;
	}
}

class Example {
	public function execute() {
		$array = new \ArrayObject;
		$array['test'] = 'Hello World';
		$array['foo'] = 'bar';
		
		print_r((array)$array);
		
		// OUTPUT:
		// Array ( [test] => Hello World [foo] => bar ) 
		
		$betterArray = new BetterArrayObject;
		$betterArray['test'] = 'Hello World';
		$betterArray->foo = 'bar';
		
		print_r($betterArray->toArray());
		
		// OUTPUT:
		// Array ( [test] => Hello World [foo] => bar ) 
		
	}
}

(new Example)->execute();