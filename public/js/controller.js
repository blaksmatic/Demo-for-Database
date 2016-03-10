/**
 * Created by admin on 3/8/16.
 */

app.controller('mainController', ['$scope', '$window', function ($scope, $window) {
    $scope.test = "Yes I AM";
    $scope.assignment1 = $window.assignment1;
    $scope.assignment1_1 = $window.assignment1_1;
    $scope.assignment1_2 = $window.assignment1_2;
    $scope.assignment0 = $window.assignment0;
    $scope.assignment2 = $window.assignment2;
    $scope.assignment2_2 = $window.assignment2_2;
    $scope.assignment3 = $window.assignment3;

}]);


app.controller('detailController', ['$scope', '$http', '$routeParams', '$window', function ($scope, $http, $routeParams, $window) {
    $scope.errorData = "YesYes";

}]);
