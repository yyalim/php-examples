<?php

require 'vendor/autoload.php';

// use Acme\{Person,Staff,Business};
//
// $person = new Person('yusuf');
// $staff = new Staff([$person]);
// $business = new Business($staff);
// $person2 = new Person('Ali veli');
// $business->hire($person2);
// var_dump($business);

use Acme\{RegisterUser, AuthController};

$r = new RegisterUser();
$c = new AuthController($r);
var_dump($c);

$c->register();

