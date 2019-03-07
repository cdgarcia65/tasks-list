app.controller('userCtrl', ['$scope', '$http', function ($scope, $http) {
    $scope.getUsersUrl = 'get-users';
    $scope.users = {};
    $scope.titulo = "Laravel-Elixir";

    $scope.getUsers = function ()
    {
        $http.get($scope.getUsersUrl).then(function (response) {
            $scope.users = response.data.users;
        });
    }

    $scope.getUsers();
}]);


