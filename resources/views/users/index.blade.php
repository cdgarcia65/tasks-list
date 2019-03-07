@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div ng-controller="userCtrl" ng-cloak>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>
                    
                    <div class="panel-body">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="user in users">
                                    <td>@{{ user.name }}</td>
                                    <td>@{{ user.email }}</td>
                                    <td>@{{ user.created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection