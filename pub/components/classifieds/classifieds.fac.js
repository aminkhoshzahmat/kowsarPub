(function(){
	"use strict";

	angular
		.module("kowsarApp")
		.factory("classifiedsFactory", function($http){
			// use classifieds data where eve we want to, with XHR request!
			function getclassifieds() {
				return $http.get('data/classifieds.json');
			}

			return {
				getclassifieds: getclassifieds
			}

		});
})();