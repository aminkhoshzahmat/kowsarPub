
angular
	.module("kowsarApp", ["ngMaterial", "ui.router"])
	.config(function($mdThemingProvider, $stateProvider){
		$mdThemingProvider.theme('default')
			.primaryPalette('green')
			.accentPalette('deep-orange');


	$stateProvider
		.state('classifieds', {
			url: '/classifieds',
			templateUrl: 'components/classifieds/classifieds.tpl.html',
			controller: 'classifiedsCtrl as vm'
		})
		.state('classifieds.new', {
			url: '/new',
			templateUrl: 'components/classifieds/new/classifieds.new.tpl.html',
			controller: 'newClassifiedsCtrl as vm'
		})
		.state('classifieds.edit', {
			url: '/edit/:id',
			templateUrl: 'components/classifieds/edit/classifieds.edit.tpl.html',
			controller: 'editClassifiedsCtrl as vm',
			params: {
				classified: null
			}
		})
		.state('login', {
			url: '/login',
			templateUrl: 'check.html',
			controller: 'loginClassifiedsCtrl as loginVm'
		})
	});