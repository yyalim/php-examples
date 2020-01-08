<?php
	class CustomersRepository {
		public function whoMatch(CustomerSpecification $specification) {
			$customers = Customer::query();
			$customers = $specification->asScope($customers);

			return $customers->get();
		}

		public function all() {
			return Customer::all();	
		}
	}

