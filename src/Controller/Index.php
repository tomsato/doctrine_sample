<?php

namespace Sample\Controller;

// 本当はphp.iniに記述するのが望ましい
date_default_timezone_set('Asia/Tokyo');

class Index
{
	protected $ci;
	public function __construct(\Slim\Container $ci)
	{
		$this->ci = $ci;
	}

	public function __invoke($request, $response, $args)
	{
		$entity = $this->ci->em->find('\Sample\Entity\Book', '0000');
		echo "<pre>";
		var_dump($entity);
		echo "</pre>";
	}
}
