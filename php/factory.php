<?php

// Automobile Class
class Automobile {
	private $vehicleModel;
	private $vehicleMake;

	public function __construct($make, $model) {
		$this->vehicleMake = $make;
		$this->vehicleModel = $model;
	}

	public function getModelAndMake() {
		return $this->vehicleModel . " " . $this->vehicleMake;
	}
}



// Factory class for Automobile
class AutomobileFactory {
	public static function create($model, $make) {
		return new Automobile($model, $make);
	}
}

$veyron = AutomobileFactory::create("Bugatti", "veyron");
?>