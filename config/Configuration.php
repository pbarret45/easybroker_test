<?php
namespace Config;

class Configuration
{
	public function __construct()
	{
		$dotenv = \Dotenv\Dotenv::createImmutable("./");
		$dotenv->load();
		\define('EASYBROKER_API_URL', $_ENV["EASYBROKER_API_URL"]);
		\define('EASYBROKER_API_KEY', $_ENV["EASYBROKER_API_KEY"]);
	}
}