var exposer = (function(){
	"use strict";

	var privateVariable = 10;

	var privateMethod = function() {
		console.log("inside a private method");
		privateVariable++;
	}

	var methodToExpose = function() {
		console.log("The method i want to expose");
	}

	return {
		first: methodToExpose,
		second: privateMethod
	};	

})();