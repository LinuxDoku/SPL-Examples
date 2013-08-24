<?php
namespace SplExamples\Datastructures;

class ContractSellers extends \SplHeap {
	protected function compare($value1, $value2) {
		if($value1[1] === $value2[1])
			return 0;
		else if($value1[1] > $value2[1])
			return 1;
		else
			return -1;
	}
}

class Example {
	public function execute() {
		$contractSellers = new ContractSellers;
		$contractSellers->insert(array('John Doe', 7));
		$contractSellers->insert(array('Example Guy', 3));
		$contractSellers->insert(array('Foo Bar', 12));
		
		foreach($contractSellers as $seller) {
			echo $seller[0] . ' selled ' . $seller[1] . ' contracts' . PHP_EOL;
		}
		
		// OUTPUT:
		// Foo Bar selled 12 contracts 
		// John Doe selled 7 contracts
		// Example Guy selled 3 contracts
	}
}

(new Example)->execute();