<?php

class product {
	public $name  = 'default_name';
	public $price = 0;
	public $desc  = 'default_description';

	function __construct($name, $price, $desc) {
		$this->name  = $name;
		$this->price = $price;
		$this->desc  = $desc; 
	}


	publice function getInfo() {
		return "Product name : " . $this->name;
	}
}

class soda extends product {
	public $flavor;

	function __construct($name, $price, $desc, $flavor) {
		parrent::__construct($name, $price, $desc);
		$this->flavor = $flavor;
	}

	public function getInfo() {
		return "Product name : " . $this->name . " Flavor " . $thid->flavor;
	}
}

$shirt = new product("Potato Chips", 100, "Stupid T-shirt");
$soda = new soda("Potato Juice", 1, "Taste like mixed shit");

echo $soda->getInfo();

?>