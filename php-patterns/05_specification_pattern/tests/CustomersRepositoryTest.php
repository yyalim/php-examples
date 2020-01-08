<?php

use Illuminate\Database\Capsule\Manager as DB;

class CustomersRepositoryTest extends PHPUnit\Framework\TestCase {
	protected $customers;

	public function setUp(): void {
		$this->setUpDatabase();
		$this->migrateTables();

		$this->customers = new CustomersRepository;
	}

	protected function setUpDatabase() {
		$database = new DB;
		$database->addConnection([
			'driver' => 'sqlite',
			'database' => ':memory:'
		]);

		$database->bootEloquent();
		$database->setAsGlobal();
	}

	protected function migrateTables() {
		DB::schema()->create('customers', function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('type');
			$table->timeStamps();
		});

		Customer::create(['name' => 'Joe', 'type' => 'gold']);
		Customer::create(['name' => 'Yusuf', 'type' => 'bronze']);
		Customer::create(['name' => 'Goerge', 'type' => 'silver']);
		Customer::create(['name' => 'Tim', 'type' => 'gold']);
	}

	public function test_it_fetches_all_customers() {
		$results = $this->customers->all();

		$this->assertCount(4, $results);
	}

	public function test_it_fetches_all_customers_who_match_a_given_specification() {
		$spec = new CustomerIsGold;
		$results = $this->customers->whoMatch($spec);
		$this->assertCount(2, $results);
	}
}
