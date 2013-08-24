<?php
namespace SplExamples\Interfaces;

class Task {
	public $name;
	
	public function __construct($name) {
		$this->name = $name;
	}
}

class TaskList implements \Countable {
	protected $tasks;
	
	public function __construct() {
		$this->tasks = array();
	}
	
	public function add(Task $task) {
		$this->tasks[] = $task;
	}
	
	public function count() {
		return count($this->tasks);
	}	
}

class Example {
	public function execute() {
		$taskList = new TaskList;
		
		$taskList->add(new Task('Task 1'));
		$taskList->add(new Task('Task 2'));
		$taskList->add(new Task('Task 3'));
		
		echo count($taskList), PHP_EOL;
		
		// OUTPUT:
		// 3
		
		$taskList->add(new Task('Task 4'));
		echo count($taskList), PHP_EOL;
		
		// OUTPUT: 
		// 4
	}
}

(new Example)->execute();