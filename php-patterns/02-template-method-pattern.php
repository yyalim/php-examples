<?php

abstract class Sub {
	abstract protected function addPrimaryToppings();

	public function make() {
		return $this
			->layBread()
			->addLettuce()
			->addPrimaryToppings()
			->addSauces();
	}

	protected function layBread() {
		var_dump("laying bread");
		return $this;
	}

	protected function addLettuce() {
		var_dump("laying lettuce");
		return $this;
	}

	protected function addSauces() {
		var_dump("laying Sauces");
		return $this;
	}
}

class TurkeySub extends Sub {
	public function addPrimaryToppings() {
		var_dump("laying turkey");
		return $this;
	}
}

class VeggieSub extends Sub {
	public function addPrimaryToppings() {
		var_dump("laying Veggies");
		return $this;
	}
}

(new VeggieSub)->make();
(new TurkeySub)->make();
