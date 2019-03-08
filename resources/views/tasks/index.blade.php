@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="taskCtrl">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">New task</div>

                <div class="panel-body">
                    <!-- Display validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form name="taskForm" ng-submit="taskForm.$valid && store()" class="form-horizontal" novalidate>
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-6">
                                <input type="text" ng-model="name" id="task-name" class="form-control" value="{{ old('name') }}">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-btn fa-plus"></i> Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6">
            <!-- Current Tasks -->
            <div class="panel panel-danger">
                <div class="panel-heading"><i class="fa fa-tasks"></i> Current Tasks</div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Tasks</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            <tr ng-repeat='task in tasks' class="cursor" ng-click="complete(task.id)" title="Marsk as completed">
                                <td>@{{ task.name }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-success">
                <div class="panel-heading"><i class="fa fa-check"></i> Task Completed</div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Tasks</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            <tr ng-repeat='task in completedTasks' class="cursor" ng-click="delete(task.id)" title="Marsk as completeted">
                                <td><del>@{{ task.name }}</del></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection