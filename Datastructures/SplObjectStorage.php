<?php
namespace SplExamples\Datastructures;

class User {
	public $name;
	public $age;
	
	public function __construct($name, $age) {
		$this->name = $name;
		$this->age = $age;
	}
}

class IntelliUserStorage extends \SplObjectStorage {
	public function getAverageAge() {
		$sum = 0;
		foreach($this as $user) {
			$sum += $user->age;
		}
		return $sum / count($this);
	}
}

class Example {
	public function execute() {
		$userStorage = new \SplObjectStorage;
		
		$foo = new User('Foo', 21);
		$bar = new User('Bar', 40);
		$lulz = new User('Lulz', 12);
		$nobody = new User('Nobody', 63);
		
		$userStorage->attach($foo);
		$userStorage->attach($bar);
		$userStorage->attach($lulz);
		
		var_dump((bool)$userStorage->contains($bar));
		var_dump((bool)$userStorage->contains($nobody));
		
		// OUTPUT:
		// bool(true)
		// bool(false)
		
		$intelliUserStorage = new IntelliUserStorage;
		$intelliUserStorage->addAll($userStorage);
		
		echo $intelliUserStorage->getAverageAge(), PHP_EOL;
		
		// OUTPUT:
		// 24.333333333333 
		
		$intelliUserStorage->detach($lulz);
		
		echo $intelliUserStorage->getAverageAge(), PHP_EOL;
		
		// OUTPUT:
		// 30.5 
	}
}

(new Example)->execute();