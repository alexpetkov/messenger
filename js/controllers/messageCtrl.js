(function(){
	
	var MessageCtrl = function($scope, $http, $location, $watch) {
			
		 $scope.fileChanged = function() {

		  // define reader
		  var reader = new FileReader();

		  // A handler for the load event (just defining it, not executing it right now)
		  reader.onload = function(e) {
			  
				
				var theResult = reader.result;
				theResult = theResult.replace(/ |\(|\)|\-|\.|\+/g,'');
				theResult = theResult.replace(/(?:\r\n|\r|\n|\t)/g, ',');
				theResult = theResult.replace(/,,/g,',');
				theResult = theResult.replace(/,/g,'\n');

				
				document.messageForm.destinationNumbers.value = theResult;
				$scope.delivery.dest = theResult;
				//angular.element(document.messageForm.destinationNumbers).triggerHandler('click');
				var el = document.getElementById('destinationNumbers');
				angular.element(el).triggerHandler('click');
			 
		  };

		  // get <input> element and the selected file 
		  var csvFileInput = document.getElementById('fileInput');    
		  var csvFile = csvFileInput.files[0];
		  //csvFile = 'ddsvsdf';

		  // use reader to read the selected file
		  // when read operation is successfully finished the load event is triggered
		  // and handled by our reader.onload function
		  reader.readAsText(csvFile);
		};


		$scope.submitForm = function(isValid) {

			// check to make sure the form is completely valid
			if (isValid) {
			  //alert('our form is amazing');
			}
		};
		
		$scope.insertdata = function(){
			console.log($scope.delivery.whatsappcontent);
			$http({
			method: 'POST',
			url: 'php/msg-upload.php',
			data: {'destinationNumbers':$scope.delivery.dest, 'chooseMethod':$scope.delivery.methood, 'senderSms':$scope.delivery.sendersms, 'smsContent':$scope.delivery.smscontent, 'senderWhatsapp':$scope.delivery.senderwhatsapp, 'whatsappContent':$scope.delivery.whatsappcontent},
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).success(function(data,status,headers,config){
				//console.log('success');
				
				$scope.theStatus = "Success";
				
			});
			
		}
		
		
		$scope.go = function ( path ) {
		  $location.path( path );
		};

	};
	
	MessageCtrl.$inject = ['$scope', '$http', '$location'];
	
	angular.module('myApp')
	.controller('messageCtrl', MessageCtrl);
	
		

}())