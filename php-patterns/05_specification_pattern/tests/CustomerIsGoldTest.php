<?php
class CustomerIsGoldTest extends PHPUnit\Framework\TestCase {
	public function test_a_customer_is_gold_if_they_have_respective_type() {
		$specification = new CustomerIsGold;
		$goldCustomer = new Customer(['name'=> 'Tim', 'type' => 'gold']);
		$silverCustomer = new Customer(['name'=> 'Joe', 'type' => 'silver']);

		$this->assertTrue($specification->isSatisfiedBy($goldCustomer));
		$this->assertFalse($specification->isSatisfiedBy($silverCustomer));
	}
}

