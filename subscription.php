<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <?php include('./headers.php'); ?>
    <link rel="stylesheet" href="./style/home.css">
</head>
<body ng-app="SubscriptionModel" ng-controller="SubscriptionController" ng-cloak>
    <div class="row">
    <?php include('./sidebar.php');?>
        <div class="col s9">
            <div class="col s10">
                <h4>Subscription Plan</h4>
                <div class = "subscription-card clickable" ng-click = "setSubscription" 
                    style = "display:inline-block; width: 500 px; height: 300px; margin: 30px; padding: 20px; border: 2px solid white;" > 
                    <p> Prenium </p>
                </div>

                <div class = "subscription-card clickable" ng-click = "setSubscription" 
                    style = "display:inline-block; width: 500 px; height: 300px; margin: 30px; padding: 20px; border: 2px solid white;" > 
                    <p> Student Prenium </p>
                </div>
                <div>
                <h4>Subscription Payment</h3>
                <form class="col s5 inputForm">
                <div>
                    <label for="subscription_type">Subscription Type</label>
                    <select id="subscription_type" 
                        class="browser-default"
                        ng-model="newSubscription.description"
                        ng-options='g.name as g.name for g in description'>
                        <option value="">Select Plan</option>
                    </select>
                </div>
                <div>
                    <label for="subscription_price">Subscription Price</label>
                    <span>{{ getSubscriptionPrice(newSubscription.description) }}</span>
                </div>
                <div>
                    <button class="btn blue" ng-click="submitSubscription();">Submit</button>
                </div>
                </form>
                </div>
            </div>
        </div>
<script type="text/javascript" src="./app/subscription.js"></script>
    </div>
</body>
</html>