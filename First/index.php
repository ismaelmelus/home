<?php
abstract class Motor {
	const DIESEL = 0;
	const GASOLINA = 1;
	const BIODIESEL = 2;
	protected $encendido = false;
	protected $cilindros;
	public function enciende() {
		if(!$this->encendido) {
			$this->encendido = true;
			echo "Encendiendo motor ... run run run\n";
		} else {
			throw new Exception("Eh!! Ya encendiste el motor!\n");
		}
	}
}
abstract class Carro {
	protected $motor;
	protected $encendido = false;
	public function enciende() {
		if(!$this->encendido) {
			$this->encendido = true;
			try {
				$this->motor->enciende();
			} catch(Exception $e) {
				die($e->getMessage());
			}
		} else {
			throw new Exception("El carro ya esta encendido!!\n");
		}
	}
}

class MotorDiesel extends Motor {
	public function __construct($cilindros) {
		$this->cilindros = $cilindros;
	}
}
class MotorGasolina extends Motor {
	public function __construct($cilindros) {
		$this->cilindros = $cilindros;
	}
}
class MotorBiodiesel extends Motor {
	public function __construct($cilindros) {
		$this->cilindros = $cilindros;
	}
}
class CarroDiesel extends Carro {
	public function __construct($cilindros) {
		$this->motor = new MotorDiesel($cilindros);
	}
}
class CarroGasolina extends Carro {
	public function __construct($cilindros) {
		$this->motor = new MotorGasolina($cilindros);
	}
}
class CarroBiodiesel extends Carro {
	public function __construct($cilindros) {
		$this->motor = new MotorBiodiesel($cilindros);
	}
}
  //Estoy declarando la Factory como una clase convencional que requiere instanciarse
class CarrosFactory {
	public function __construct();//Podemos crear instancias de Carros, sin tener que instanciar la clase CarrosFactory
	public static function crearCarro($tipoMotor, $cilindros) {
		switch($tipoMotor) {
			case MOTOR::DIESEL:
				return new CarroDiesel($cilindros);
				break;
			case MOTOR::GASOLINA:
				return new CarroGasolina($cilindros);
				break;
			case MOTOR::BIODIESEL:
				return new CarroBiodiesel($cilindros);
		}
	}
}

$camioneta = CarrosFactory::crearCarro(MOTOR::DIESEL,    8);
$sedan	   = CarrosFactory::crearCarro(MOTOR::GASOLINA,  4);
$autobus   = CarrosFactory::crearCarro(MOTOR::DIESEL,    8);
$hibrido   = CarrosFactory::crearCarro(MOTOR::BIODIESEL, 4);
$camioneta->enciende();
$sedan->enciende();
$autobus->enciende();
$hibrido->enciende();