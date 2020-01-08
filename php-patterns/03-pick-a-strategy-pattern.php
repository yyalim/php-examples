<?php

interface Logger {
	public function log($data);
}

class logToFile implements Logger {
	public function log($data) {
		var_dump("log the data to the file");
	}
}

class logToDatabase implements Logger {
	public function log($data) {
		var_dump("log the data to the database");
	}
}

class logToXWebService implements Logger {
	public function log($data) {
		var_dump("log the data to the Saas Site");
	}
}

class App {
	public function log($data, Logger $logger = null) {
		$logger = $logger ?: new LogToFile;
		$logger->log($data);
	}
}

(new App)->log('hello world', new LogToDatabase);

