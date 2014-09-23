var myApp = angular.module('myApp', []);

myApp.run(function($rootScope, $timeout) {
	$rootScope.preload = true;
	$timeout(function() {
		$rootScope.preload = false;
	}, 500);
});

myApp.directive('resize', function ($window) {
	return { 
		restrict: 'A',
		link: function (scope, element) {
			var w = angular.element($window);
			scope.getWindowDimensions = function () {
				return {
					'h': w.height(),
					'w': w.width()
				};
			};

			scope.$watch(scope.getWindowDimensions, function (newValue, oldValue) {
				scope.windowHeight = newValue.h;
				scope.windowWidth = newValue.w;
			}, true);

			w.bind('resize', function () {
				scope.$apply();
			});
		},
		controller: ['$scope', '$element',
			function ($scope, $element) {
				$scope.$watch('resize', function (value) {
					if (value) {
						scope.windowHeight = value.h;
						scope.windowWidth = value.w;
					}
				});
			}
		]
	}
})

myApp.controller('MasterController', ['$scope', function($scope) {
	var mobileView = 992;

	$scope.$watch('windowWidth', function (width) {
		if (width >= mobileView) {
			$scope.toggle = true;
		} else {
			$scope.toggle = false;
		}   
	});

	$scope.toggleSidebar = function() 
	{
		$scope.toggle = ! $scope.toggle;
	}

}]);
