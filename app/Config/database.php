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
	public $default = array(
		'datasource' => 'Database/Postgres',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'edgardo',
		'password' => '12qwaszx',
		'database' => 'Hop',
		'prefix' => '',
		'encoding' => 'utf8',
	);
/* */
	public $test = array(
		'datasource' => 'Database/Postgres',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'edgardo',
		'password' => '12qwaszx',
		'database' => 'Hop',
		'prefix' => '',
		'encoding' => 'utf8',
	);
}
