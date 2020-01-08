<?php

interface Subject {
	public function attach($observerable);
	public function detach($observer);
	public function notify();
}

interface Observer {
	public function handle();
}

class Login implements Subject {
	protected $observers = [];

	public function attach($observerable) {
		if(is_array($observerable)) {
			return $this->attachObservers($observerable);
		} else {
			$this->observers[] = $observerable;
		}
	}

	public function detach($index) {
		unset($this->observers[$index]);
	}

	public function notify() {
		foreach($this->observers as $observer)	{
			$observer->handle();
		}
	}

	public function fire() {
		$this->notify();
	}

	private function attachObservers($observable) {
		foreach($observable as $observer) {
			if(!$observer instanceof Observer) {
				throw new Exception;
			}

			$this->attach($observer);
		}
	}
}

class LogHandler implements Observer {
	public function handle() {
		var_dump('Log something important');
	}
}

class EmailNotifier implements Observer {
	public function handle() {
		var_dump('Fire off an email');
	}
}

class LoginReporter implements Observer {
	public function handle() {
		var_dump('Reporting login');
	}
}

$login = new Login;
$login->attach([
	new LogHandler,
	new EmailNotifier,
	new LoginReporter
]);


$login->notify();
