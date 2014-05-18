<?php

class DATABASE_CONFIG {
/*	Base de Datos Producción */
/* 
	public $default = array(
		'datasource' => 'Database/Postgres',
		'persistent' => false,
		'host' => '192.168.1.116',
		'login' => 'postgres',
		'password' => 'zec2012',
		'database' => 'Hop',
		'prefix' => '',
		'encoding' => 'utf8',
		'port' => '5432'
	);
/* */
/*	Base de Datos Pruebas */
/* */
	// public $default = array(
	// 	'datasource' => 'Database/Postgres',
	// 	'persistent' => false,
	// 	'host' => 'localhost',
	// 	'port' => '5432',
	// 	'login' => 'postgres',
	// 	'password' => '53195319',
	// 	'database' => 'Hop',
	// 	'prefix' => '',
	// 	'encoding' => 'utf8',
	// );
	public $default = array(
		'datasource' => 'Database/Postgres',
		'persistent' => false,
		'host' => '186.103.146.219',
		'port' => '5432',
		'login' => 'postgres',
		'password' => 'clouder',
		'database' => 'hop_nuevo',
		'prefix' => '',
		'encoding' => 'utf8',
	);
/* */
	public $test = array(
		'datasource' => 'Database/Postgres',
		'persistent' => false,
		'host' => 'localhost',
		'port' => '5432',
		'login' => 'postgres',
		'password' => '53195319',
		'database' => 'Hop',
		'prefix' => '',
		'encoding' => 'utf8',
	);
}
