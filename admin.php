<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="./style/admin.css">
<head>
    <title>Admin</title>
    <?php include('./headers.php'); ?>
</head>
<body ng-app="AdminModel" ng-controller="AdminController" ng-cloak>
    <div class="row">
        <?php include('./sidebar.php');?>
        <div class="col s9 reportPanel">
            <div class="row">
                <div class="col s12">
                    <table class="table-border">
                        <tr>
                            <th ng-click="sortByNumericProperty('account_id')">Account Id</th>
                            <th ng-click="sortByProperty('user_role')">Role</th>
                            <th ng-click="sortByProperty('fname')">First Name</th>
                            <th ng-click="sortByProperty('lname')">Last Name</th>
                            <th ng-click="sortByProperty('username')">Username</th>
                            <th ng-click="sortByProperty('bio')">Bio</th>
                            <th ng-click="sortByProperty('gender')">Gender</th>
                            <th ng-click="sortByProperty('DOB')">DOB</th>
                            <th ng-click="sortByProperty('region')">Region</th>
                            <th ng-click="sortByProperty('email')">email</th>
                        </tr>
                        <tr ng-repeat="user in userList">
                            <td>{{user.account_id}}</td>
                            <td>{{user.user_role}}</td>
                            <td>{{user.fname}}</td>
                            <td>{{user.lname}}</td>
                            <td>{{user.username}}</td>
                            <td>{{user.bio}}</td>
                            <td>{{user.gender}}</td>
                            <td>{{user.DOB}}</td>
                            <td>{{user.region}}</td>
                            <td>{{user.email}}</td>
                        </tr>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="./app/admin.js"></script>
</body>
</html>