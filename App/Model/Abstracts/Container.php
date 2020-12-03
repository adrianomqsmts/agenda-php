<?php

namespace App\Model\Abstracts;

use App\Model\Abstracts\Connection;

class Container {

  // A funçãp irá instanciar dinamicamente o objeto em MODEL, passando a conexão estabelecida
	public static function getModel($model) {
		$class = "\\App\\Model\\".ucfirst($model);
		$conn = Connection::getDb();

		return new $class($conn);
	}
}


?>