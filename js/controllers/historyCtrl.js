(function(){ 
	 var HistoryCtrl = function($scope, $http, $uibModal, $log, $uibModalInstance, msg) {
		$scope.msg = msg; // for showing the modal
		$scope.currentPage = 1; // default first page
		$scope.totalItems = 0; // default total records
		$scope.pageSize = 10; // default limit
		$scope.searchText = ''; // default search data
		$scope.searchStatus = '';
		getData(); 

		function getData() {
		 $http.get('php/msg-load.php?page=' + $scope.currentPage + '&size=' + $scope.pageSize + '&search=' + $scope.searchText + '&status=' + $scope.searchStatus)
			.success(function(data) {
				$scope.messages = [];
				$scope.totalItems = data.totalCount;
				$scope.startItem = ($scope.currentPage - 1) * $scope.pageSize + 1;
				$scope.endItem = $scope.currentPage * $scope.pageSize;
				if ($scope.endItem > $scope.totalCount) {$scope.endItem = $scope.totalCount;}
				angular.forEach(data.CurrentItems, function(temp){
					$scope.messages.push(temp);
				});
			});
		}

		$scope.pageChanged = function() {
			getData();
		}
		$scope.pageSizeChanged = function() {
			$scope.currentPage = 1;
			getData();
		}
		$scope.searchTextChanged = function() {
			$scope.currentPage = 1;
			console.log($scope.searchText);
			getData();
		}
		
		$scope.searchStatusChanged = function() {
			$scope.currentPage = 1;
			console.log($scope.searchStatus);
			getData();
		}
		
		

		$scope.askModal = function(_msg) {
			$scope.msg = msg;

			var uibModalInstance  = $uibModal.open({
				
			  templateUrl: 'myModalContent.html',
			  controller: ModalInstanceCtrl,
			  resolve: {
                msg: function()
                {
                    return _msg;
                }
            }
			});
			
			$scope.cancel = function() {
				$uibModalInstance .close();
			  };
		
		};
		
		
		
		
		var ModalInstanceCtrl = function($scope, $uibModalInstance, msg ) {
				$scope.msg = msg;
			  $scope.ok = function() {
				$uibModalInstance .close();
			  };

			  $scope.cancel = function() {
				$uibModalInstance .dismiss('cancel');
			  };
			};
	 }; 
	 
	 
	 HistoryCtrl.$inject = ['$scope', '$http', '$uibModal', '$log'];
	
	angular.module('myApp')
	.controller('historyCtrl', HistoryCtrl);
 
 }())