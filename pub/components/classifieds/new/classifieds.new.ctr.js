(function(){
	"use strict";

	angular
		.module('kowsarApp')
		.controller("newClassifiedsCtrl", function($scope, $state, $mdSidenav, $timeout ,$mdDialog, classifiedsFactory){
			
			var vm = this;
			vm.closeSidebar = closeSidebar;
			vm.saveClassified = saveClassified;

			$timeout(function(){
				$mdSidenav('left').open();
			},300);


			$scope.$watch('vm.sidenavOpen', function(sidenav){
				if(sidenav === false) {
					$mdSidenav('left')
						.close()
						.then(function(){
							$state.go('classifieds');
						});
				}
			});


		function closeSidebar() {
			vm.sidenavOpen = false;
		}

		function saveClassified(classified) {
			if(classified){
				classified.contact = {
					name: "Amin khoshzahmat",
					phone: "09383354374",
					email: "aminkhoshzahmat@gmail.com"
				}
				$scope.$emit('newClassified', classified);
				vm.sidenavOpen = false;
			}
		}


		})
		.controller("loginClassifiedsCtrl", function($scope, $state, $mdSidenav, $timeout ,$mdDialog, classifiedsFactory){
			function checkLogin(){
				$state.go('login');
			}
		})

})();