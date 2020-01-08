<?php

abstract class HomeChecker {
	protected $successor;

	public abstract function check(HomeStatus $home);

	public function succeedWith(HomeChecker $successor) {
		$this->successor = $successor;
	}

	public function next(HomeStatus $home) {
		if($this->successor) {
			$this->successor->check($home);
		}
	}
}

class Locks extends HomeChecker {
	public function check(HomeStatus $home) {
		if(!$home->locked) {
			throw new Exception("the doors are not locked!! Abort abort.");
		}

		$this->next($home);
	}
}

class Lights extends HomeChecker {
	public function check(HomeStatus $home) {
		if(!$home->lightsOff) {
			throw new Exception("the lights are still on!! Abort abort.");
		}

		$this->next($home);
	}
}
class Alarm extends HomeChecker {
	public function check(HomeStatus $home) {
		if(!$home->alarmOn) {
			throw new Exception("The alarm was not set!! Abort abort.");
		}

		$this->next($home);
	}
}

class HomeStatus {
	public $alarmOn = true;
	public $locked = true;
	public $lightsOff = true;
}

$locks = new Locks;
$ligths = new Lights;
$alarm = new Alarm;

$locks->succeedWith($ligths);
$ligths->succeedWith($alarm);

$locks->check(new HomeStatus);

