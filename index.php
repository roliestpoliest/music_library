<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <?php include('./headers.php'); ?>
    <link rel="stylesheet" href="./style/index.css">
</head>
<body ng-app="LogInModel" ng-controller="LogInController" ng-cloak>
    <div>
        <div class="row">
            <div class="col s1"></div>
            <div class="col s3 loginPanel">
                <div>
                    <img src="./img/Designer.png" class="logo_min">
                </div>
                
                <form name="LoginForm" id="loginForm" ng-if="loginWindow">
                    <h3>Log in</h3>
                    <div>
                        <label for="login_username">Usermame</label>
                        <input autocomplete="off" type="text" ng-model="login.username">
                    </div>
                    <div>
                        <label for="login_password">Password</label>
                        <input autocomplete="off" type="password" ng-model="login.password">
                    </div>
                    <div>
                        <button class="btn blue" ng-click="loginFunction();">Log in</button>
                    </div>
                    <p class="clickable" ng-click="hideLogInWindow()">Not enrolled yet? <br> Create an account</p>
                </form>

                <form name="CreateNewAccount" id="newAccountForm" ng-show="!loginWindow">
                    <h3>Create an Account</h3>
                    <p class="clickable" ng-click="showLogInWindow();;">Already have an account? Log in</p>
                    <div>
                        <div>
                            <label for="newAccount_fname">First Name</label>
                            <input autocomplete="off" id="newAccount_fname" ng-model="newAccount.fname">
                        </div>
                        <div>
                            <label for="newAccount_lname">Last Name</label>
                            <input autocomplete="off" id="newAccount_lname" ng-model="newAccount.lname">
                        </div>
                        <div>
                            <label for="newAccount_user_role">Role</label>
                            <select id="newAccount_role" 
                                class="browser-default"
                                ng-model="newAccount.user_role"
                                ng-options='g.role as g.role for g in roles'
                                ng-init="newAccount.user_role = g.value">
                                <option value="">Select Role</option>
                            </select>
                        </div>
                        <div>
                            <label for="newAccount_username">username</label>
                            <input autocomplete="off" id="newAccount_username" ng-model="newAccount.username">
                        </div>
                        <div>
                            <label for="newAccount_bio">Bio</label>
                            <input autocomplete="off" id="newAccount_bio" ng-model="newAccount.bio">
                        </div>
                        <div class="input-field">
                            <select id="newAccount_gender" 
                                class="browser-default"
                                ng-model="newAccount.gender"
                                ng-options='g.value as g.name for g in genders'
                                ng-init="newAccount.gender = g.value">
                                <option value="">Select Gender</option>
                            </select>
                        </div>
                        <div>
                            <label for="newAccount_DOB">DOB</label>
                            <input autocomplete="off" type="text" class="datepicker" id="newAccount_DOB" ng-model="newAccount.DOB">
                        </div>
                        <div>
                            <label for="newAccount_region">Region</label>
                            <select id="newAccount_region" 
                                class="browser-default"
                                ng-model="newAccount.region"
                                ng-options='g.name as g.name for g in regions'
                                ng-init="newAccount.region = g.value">
                                <option value="">Select Region</option>
                            </select>
                            <!-- <input autocomplete="off" id="newAccount_region" ng-model="newAccount.region"> -->
                        </div>
                        <div>
                            <label for="newAccount_email">email</label>
                            <input autocomplete="off" id="newAccount_email" ng-model="newAccount.email">
                        </div>
                        <div>
                            <label for="newAccount_password">Password</label>
                            <input autocomplete="off" type="password"  id="newAccount_password" ng-model="newAccount.password">
                        </div>
                        <div>
                            <button class="btn blue" ng-click="newAccount_submit();">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col s8 welcomePage"></div>
        </div>
    </div>
    <script type="text/javascript" src="./app/index.js"></script>
    
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            format:'yyyy-mm-dd'
        }
    var elems = document.querySelectorAll('.datepicker', options);
    var instances = M.Datepicker.init(elems);
  });
</script>
</html>