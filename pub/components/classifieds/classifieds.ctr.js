(function(){
	"use strict";

	// Refer to kowsarApp module
	// PATH : /scripts/app.js
	angular
		.module("kowsarApp")
		.controller("classifiedsCtrl", function($scope, $state, $http, classifiedsFactory, $mdSidenav, $mdToast, $mdDialog) {
			// ====== check controller name [ classifiedsCtrl - classifieds ]
			// FUNCTIONS and VARIABLES
			var vm = this;

			vm.categories;
			vm.classified;
			vm.classifieds;
			vm.closeSidebar	 	 = closeSidebar;
			vm.deleteClassified  = deleteClassified;
			vm.editing;
			vm.editClassified	 = editClassified;
			vm.openSidebar		 = openSidebar;
							

			
			//$http.get('data/classifieds.json').then(function(classifieds) {
			classifiedsFactory.getclassifieds().then(function(classifieds) {
				vm.classifieds = classifieds.data;
				//console.log(classifieds);
				vm.categories = getCategories(vm.classifieds);
			});

			/*$http.get('https://api.github.com/users').then(function(classifieds){
				vm.classifieds = classifieds.data;
				//console.log(classifieds);
				vm.categories = getCategories(vm.classifieds);
			})
			ng-src = avatar_url
			*/

			$scope.$on('newClassified', function(event, classified) {
				classified.id = vm.classifieds.length + 1;
				vm.classifieds.push(classified)
				showToast('classified Saved');
			});

			$scope.$on('editSaved', function(event, message) {
				showToast(message)
			})

			// Assume that i logged in as amin khoshzahmat
			// with private variable called contact
			var contact = {
				name: "Amin khoshzahmat",
				phone: "09383354374",
				email: "aminkhoshzahmat@gmail.com"
			}


			// open the "Add new Classifieds"
			function openSidebar (){
				//$mdSidenav('left').open();
				$state.go('classifieds.new');
			}			
			// close the "Add new Classifieds"
			function closeSidebar (){
				$mdSidenav('left').close();
			}

			// Add new Classifieds
			function saveClassified (classified) {
				if(classified){
					classified.posted = Date.now();
					classified.contact = contact;
					vm.classifieds.push(classified);
					// Clear classified object (clear the form)
					vm.classified = {};
					closeSidebar();
					// Show message after Saving Data
					showToast('New Classified Added');
				}
			};

			// Modify Specified Classified ied ied ... :p
			function editClassified (classified) {
				$state.go('classifieds.edit', {
					id: classified.id,
					classified: classified
				})
			}

			// Save an editing classified
			function saveEdit (classified) {
				vm.editing = false;
				vm.classified = {};
				closeSidebar();
				showToast('Edit Saved!');
			}

			function deleteClassified (event, classified) {
				var confirm = $mdDialog.confirm()
					.title("Are you sure you want to delete " + classified.title + " ?")
					.ok('Yes, Do it!')
					.cancel("Don't")
					.targetEvent(event);
				$mdDialog.show(confirm).then(function() {
					var index = vm.classifieds.indexOf(classified);	
					vm.classifieds.splice(index, 1);
					showToast(classified.title + " Deleted");
				}, function() {

				});
			}

			// Function fo Custom TOAST
			function showToast(message) {
				$mdToast.show(
					$mdToast.simple()
					.content(message)
					.position('top, right')
					.hideDelay(3000)
				);
			}

			function getCategories(classifieds) {
				var categories = [];
				angular.forEach(classifieds, function(item) {
					angular.forEach(item.categories, function(category){
						categories.push(category);
					});
				});

				// return all uniq category
				return _.uniq(categories);
			}
			
		})
		.filter('keyboardShortcut', function($window) {
		    return function(str) {
		      if (!str) return;
		      var keys = str.split('-');
		      var isOSX = /Mac OS X/.test($window.navigator.userAgent);

		      var seperator = (!isOSX || keys.length > 2) ? '+' : '';

		      var abbreviations = {
		        M: isOSX ? '' : 'Ctrl',
		        A: isOSX ? 'Option' : 'Alt',
		        S: 'Shift'
		      };

		      return keys.map(function(key, index) {
		        var last = index == keys.length - 1;
		        return last ? key : abbreviations[key];
		      }).join(seperator);
		    };
		  })
		  .controller('DemoBasicCtrl', function DemoCtrl($mdDialog) {
		    this.settings = {
		      printLayout: true,
		      showRuler: true,
		      showSpellingSuggestions: true,
		      presentationMode: 'edit'
		    };

		    this.sampleAction = function(name, ev) {
		      $mdDialog.show($mdDialog.alert()
		        .title(name)
		        .textContent('You triggered the "' + name + '" action')
		        .ok('Great')
		        .targetEvent(ev)
		      );
		    };
		  });
})();