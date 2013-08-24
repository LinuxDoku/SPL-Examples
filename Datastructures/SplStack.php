<?php
namespace SplExamples\Datastructures;

class Example {
	protected $stack;
	
	public function __construct() {
		$this->stack = new \SplStack();
	}
	
	public function execute() {		
		$this->stack->push('Task 1');
		$this->stack->push('Task 2');
		$this->stack->push('Task 3');
		
		$this->stack->rewind();
		$this->write();
		
		// OUTPUT: 
		// Task 3
		// Task 2
		// Task 1
		
		// modify iterator mode (delete after access, e.g. for a task queue)
		$this->stack->setIteratorMode(\SplDoublyLinkedList::IT_MODE_LIFO | \SplDoublyLinkedList::IT_MODE_DELETE);
		$this->stack->rewind();
		$this->write();
		
		// OUTPUT: 
		// Task 3
		// Task 2
		// Task 1
		
		$this->stack->rewind();
		$this->write();
		
		// OUTPUT:
		// 
	}
	
	protected function write() {
		while($this->stack->valid()) {
			echo $this->stack->current(), PHP_EOL;
			$this->stack->next();
		}
	}
}

(new Example)->execute();