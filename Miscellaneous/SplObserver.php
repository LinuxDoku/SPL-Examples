<?php
namespace SplExamples\Miscellaneous;

class Server implements \SplSubject {
	protected $name;
	protected $message;
	protected $observers = array();
	
	public function __construct($name) {
		$this->name = $name;
	}
	
	public function attach(\SplObserver $observer) {
		$this->observers[] = $observer;
	}

	public function detach(\SplObserver $observer) {
		$index = array_search($observer, $this->observers);
		if($index !== false) {
			unset($this->observers[$index]);
		}
	}

	public function notify() {
		foreach($this->observers as $observer) {
			$observer->update($this);
		}
	}
	
	public function sendToAllClients($message) {
		$this->message = $message;
		$this->notify($this);
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getMessage() {
		return $this->message;
	}
}

class Client implements \SplObserver {
	protected $name;
	
	public function __construct($name) {
		$this->name = $name;
	}
	
	public function update(\SplSubject $subject) {
		echo '[', $this->name, ', ', $subject->getName(), '] ', $subject->getMessage(), PHP_EOL; 
	}
}

class Example {
	public function execute() {
		$mailServer = new Server('Mail Server');
		$vcsServer = new Server('VCS Server');
		
		$user1 = new Client('User 1');
		$user2 = new Client('User 2');
		$user3 = new Client('User 3');
		
		$mailServer->attach($user1);
		$mailServer->attach($user3);
		
		$vcsServer->attach($user2);
		$vcsServer->attach($user3);
		
		$mailServer->sendToAllClients('Newsletter Week 1');
		
		// OUTPUT:
		// [User 1, Mail Server] Newsletter Week 1
		// [User 3, Mail Server] Newsletter Week 1
		
		$vcsServer->sendToAllClients('New commit at SPL-Examples');
		
		// OUTPUT:
		// [User 2, VCS Server] New commit at SPL-Examples
		// [User 3, VCS Server] New commit at SPL-Examples 
		
		$vcsServer->attach($user1);
		$vcsServer->detach($user3);
		
		$vcsServer->sendToAllClients('New commit at SPL-Examples');
		
		// OUTPUT:
		// [User 2, VCS Server] New commit at SPL-Examples
		// [User 1, VCS Server] New commit at SPL-Examples 
		
	}
}

(new Example)->execute();