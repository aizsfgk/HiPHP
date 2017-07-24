<?php
/**
 * 运行文件
 */
namespace framework;

use framework\Request;
use framework\Response;
use framework\App;
use framework\handle\ConfigHandle;
use framework\handle\RouterHandle;
use framework\exception\CoreHttpException;

require_once(__DIR__ . '/App.php');

try {
	// 加载
	//echo "load";
	//
	// ---------- init ---------- //
	$app = new App(ROOT_PATH, function() {
		return require( __DIR__ . '/Load.php');
	});

	// ---------- loading handle module ---------- //
	
	// config 
	$app->load(function () {
		return new ConfigHandle();
	});

	// router
	$app->load(function () {
		return new RouterHandle();
	});

	// log
	$app->load(function () {

		echo "\n\n\n";
		echo "load log\n";
	});
	
	// error
	$app->load(function () {
		echo "load error\n";
	});
	 
	// exception
	$app->load(function () {
		echo "load exception\n";
	});
	// 

	// db
	$app->load(function () {
		echo "load db\n";
	});
	// nosql
	$app->load(function () {
		echo "load nosql\n";
	});
	// userDefined
	$app->load(function() {
		echo "load userDefined\n";
	});




	// ---------- start app ---------- //
	$app->run(function() use ($app) {
		return new Request($app);
	});
	
	// ---------- stop app and response ---------- //
	$app->response(function() {
		return new Response(); 
	});
	
} catch (CoreHttpException $e) {
	// 捕获自定义的异常
	$e->response();
}