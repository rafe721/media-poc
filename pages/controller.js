// 7.4 products controller #STARTS
app.controller('displayCtrl', function($scope, $http) {
	
	$scope.getAll = function(){
		$http({
			method: 'GET',
			url: 'api/product/read.php'
		}).then(function successCallback(response) {
			$scope.displays = response.data.records;
		});
	}
	
});
// 7.5 products controller #ENDS