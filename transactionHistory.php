<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="./style/admin.css">
<head>
    <title>Admin</title>
    <?php include('./headers.php'); ?>
</head>
<body ng-app="TransactionModel" ng-controller="TransactionController" ng-cloak>
    <div class="row">
    <?php include('./sidebar.php');?>
    <div class="col s10">
        <div class="contentWrapper">
        <table class="table-border">
            <tr>
                <th ng-click="sortByNumericProperty('transaction_id','transactionInfo')">Transaction Id</th>
                <th ng-click="sortByNumericProperty('account_id','transactionInfo')">Account ID</th>
                <th ng-click="sortByProperty('payment_date','transactionInfo')">Payment Date</th>
                <th ng-click="sortByProperty('payment_source','transactionInfo')">Payment Method</th>
                <th ng-click="sortByNumericProperty('total','transactionInfo')">Total</th>
            </tr>
            <tr ng-repeat="user in transactionInfo">
                <td class="text_center">{{user.transaction_id}}</td>
                <td class="text_center">{{user.account_id}}</td>
                <td class="text_center">{{user.payment_date}}</td>
                <td class="text_center">{{user.payment_source}}</td>
                <td class="text_center">{{user.total}}</td>
            </tr>
        </table>
        </div>
    </div>










    <script type="text/javascript" src="./app/transactionHistory.js"></script>
    </div>
</body>
</html>