<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['em'] = function ($c) {
	$isDevMode = true;
	$configuration = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(array(__DIR__.'../src/Entity'), $isDevMode);
	$configuration->setProxyDir('/tmp/proxies');
	$configuration->setAutoGenerateProxyClasses(\Doctrine\Common\Proxy\AbstractProxyFactory::AUTOGENERATE_ALWAYS);
	$dbParams = array(
		'dbname'    => 'MYDB',
		'user'      => 'root',
		'password'  => '',
		'driver'    => 'pdo_mysql',
	);
	$evm = new \Doctrine\Common\EventManager();
	if($isDevMode) {
		$evm->addEventSubscriber(new \Doctrine\DBAL\Event\Listeners\MysqlSessionInit());
	}
	return \Doctrine\ORM\EntityManager::create($dbParams, $configuration, $evm);
};
