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

            <!-- Current Tasks -->
            @if (count($tasks))
                <div class="panel panel-default">
                    <div class="panel panel-heading">Current Tasks</div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Tasks</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $task->name }}</td>
                                        <td>
                                            <!-- Delete Button -->
                                            <form action="{{ url("task/{$task->id}") }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection