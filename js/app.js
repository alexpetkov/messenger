(function(){
	
	var mApp = angular.module('myApp', ['ui.bootstrap', 'ngRoute', 'ngAnimate', 'ngMessages']);


		mApp.config(function($routeProvider){
			$routeProvider
				.when('/',{
					controller: "messageCtrl",
					templateUrl: "views/message.html"
				})
				.when('/status',{
					controller: "messageCtrl",
					templateUrl: "views/status.html"
				})
				.when('/history',{
					controller: "historyCtrl",
					templateUrl: "views/history.html"
				})
				.otherwise({ redirectTo: '/' });
		});
		
		
		
		
		

}())

	
	


