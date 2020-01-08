<?php namespace AcmeInc;

class RegisterUser {
	public function execute(
		array $data,
		RepondsToUserRegistration $listener
	) {
		var_dump('Registratin the user.');

		if(rand(0, 1) == 1)	{
			$listener->userRegisteredSuccessfully();
		} else {
			$listener->userRegisteredFailed();
		}
	}
}

