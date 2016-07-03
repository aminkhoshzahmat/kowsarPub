(function(){
	"use strict";

	angular
		.module('kowsarApp')
		.controller("editClassifiedsCtrl", function($scope, $state, $mdSidenav, $timeout ,$mdDialog, classifiedsFactory){
			
			var vm = this;
			vm.closeSidebar = closeSidebar;
			vm.saveEdit = saveEdit;
			vm.classified = $state.params.classified;

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

		function saveEdit(classified) {
			$scope.$emit('editSaved', 'Edit saved')
			vm.sidenavOpen = false;
		}


		})
		.controller("loginClassifiedsCtrl", function($scope, $state, $mdSidenav, $timeout ,$mdDialog, classifiedsFactory){
			function checkLogin(){
				$state.go('login');
			}
		})

})();