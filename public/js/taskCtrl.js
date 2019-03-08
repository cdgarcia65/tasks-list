(function () {
    app.controller('taskCtrl', ['$scope', '$http', function ($scope, $http) {
        $scope.url = 'tasks';
        $scope.tasks = {};

        $scope.store = function () {
            $http.post('tasks', {
                name: $scope.name
            }).then(function (response) {
                $scope.getTasks();
            }, function (error) {
                console.log(error, $scope.name);
            });
        }

        $scope.getTasks = function () {
            $http.get($scope.url + '/get').then(function (response) {
                $scope.tasks = response.data.tasks;
            });
        }

        $scope.delete = function (task) {
            $http.delete();
        }

        $scope.getTasks();
    }])
})();