<?php
namespace SplExamples\Datastructures;

class Example {
	protected $queue;
	
	public function __construct() {
		$this->queue = new \SplQueue;
	}
	
	public function execute() {
		$this->queue->enqueue(function() {
			echo 'Task 1 done', PHP_EOL;
		});
		
		$this->queue->enqueue(function() {
			echo 'Task 2 done', PHP_EOL;
		});
		
		$this->queue->enqueue(function() {
			echo 'Task 3 done', PHP_EOL;
		});
		
		$this->work();
		
		// OUTPUT:
		// Task 1 done
		// Task 2 done
		// Task 3 done
		
		$this->queue->dequeue();
		$this->work();
		
		// OUTPUT:
		// Task 2 done
		// Task 3 done
		
		$this->queue->setIteratorMode(\SplDoublyLinkedList::IT_MODE_FIFO | \SplDoublyLinkedList::IT_MODE_DELETE);
		$this->work();
		
		// OUTPUT:
		// Task 2 done
		// Task 3 done
		
		$this->work();
		// OUTPUT:
		//
	}
	
	protected function work() {
		foreach($this->queue as $task) {
			$task();
		}
	}
}

(new Example)->execute();