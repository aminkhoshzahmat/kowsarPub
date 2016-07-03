<?php

	// DEFINING FACTORY CLASS
	class factory
	{
		public static function build($type)
		{
			$class = 'Format' . $type;
			if (!class_exist($class_exist)) {
				throw new Exception('Missing format Class.');
			}
			return new $class;
		}
	}

	// INTERFACES NEEDS TO BE DECLARED
	interface FormatInterface {}

	class FormatString implements FormatInterface {}
	class FormatNumber implements FormatInterface {}

	// CREATE INSTANCE FormatString
	try {
		$string = factory::build('String');
	} catch (Exception $e) {
		echo $e->getMessage();
	}

	// CREATE INSTANCE FormatNumber
	try {
		$number = factory::build('Number');
	} catch (Exception $e) {
		echo $e->getMessage();
	}


	# ======================================================
	class carFactory {
 
	    public function __construct() {
	        // ... //
	    }
	 
	    public static function build ($type = '') {
	             
	        if($type == '') {
	            throw new Exception('Invalid Car Type.');
	        } else {
	 
	            $className = 'car_'.ucfirst($type);
	 
	            // Assuming Class files are already loaded using autoload concept
	            if(class_exists($className)) {
	                return new $className();
	            } else {
	                throw new Exception('Car type not found.');
	            }
	        }
	    }
	}

	class car_Sedan {
	    public function __construct() {
	        echo "Creating Sedan";
	    }
	}
 
	class car_Suv {
	    public function __construct() {
	        echo "Creating SUV";
	    }
	}

?>