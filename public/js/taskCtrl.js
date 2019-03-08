(function () {
    app.controller('taskCtrl', ['$scope', '$http', function ($scope, $http) {
        $scope.url = 'tasks';
        $scope.tasks = {};
        $scope.completedTasks = {};

        $scope.store = function () {
            $http.post('tasks', {
                name: $scope.name
            }).then(function (response) {
                $scope.getTasks();
                $scope.getCompletedTasks();
                $scope.name = '';
            }, function (error) {
                console.log(error, $scope.name);
            });
        }

        $scope.getTasks = function () {
            $http.get($scope.url + '/get').then(function (response) {
                $scope.tasks = response.data.tasks;
            });
        }

        $scope.getCompletedTasks = function () {
            $http.get($scope.url + '/get-completed').then(function (response) {
                $scope.completedTasks = response.data.completed;
            });
        }

        $scope.complete = function (task) {
            $http.delete($scope.url + '/' + task).then(function () {
                $scope.getTasks();
                $scope.getCompletedTasks();
            });
        }

        $scope.uncomplete = function (task) {
            $http.get($scope.url + '/' + task + '/uncomplete').then(function () {
                $scope.getTasks();
                $scope.getCompletedTasks();
            });
        }

        $scope.getTasks();
        $scope.getCompletedTasks();
    }])
})();