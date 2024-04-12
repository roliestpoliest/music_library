<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <?php include('./headers.php'); ?>
    <link rel="stylesheet" href="./style/account.css">
</head>
<body ng-app="AccountModel" ng-controller="AccountController" ng-cloak>
    <div class="row">
        <?php include('./sidebar.php');?>
        <div class="col s9">
            <div class="row">
                <div class="col s1"></div>
                <form class="col s5 inputForm">
                    <div>
                        <label for="userInfo_DOB">DOB</label>
                        <input class="datepicker" type="text" ng-model="userInfo.DOB" id="userInfo_DOB">
                    </div>
                    <div>
                        <label for="userInfo_bio">bio</label>
                        <input type="text" ng-model="userInfo.bio" id="userInfo_bio">
                    </div>
                    <div>
                        <label for="userInfo_email">email</label>
                        <input type="text" ng-model="userInfo.email" id="userInfo_email">
                    </div>
                    <div>
                        <label for="userInfo_fname">fname</label>
                        <input type="text" ng-model="userInfo.fname" id="userInfo_fname">
                    </div>
                    <div>
                        <label for="userInfo_gender">gender</label>
                        <select id="userInfo_gender" 
                            class="browser-default"
                            ng-model="userInfo.gender"
                            ng-options='g.value as g.name for g in genders'
                            ng-init="userInfo.gender = g.value">
                            <option value="">Select Gender</option>
                        </select>
                    </div>
                    <div>
                        <label for="userInfo_lname">lname</label>
                        <input type="text" ng-model="userInfo.lname" id="userInfo_lname">
                    </div>
                    <div>
                        <label for="userInfo_password">password</label>
                        <input type="text" ng-model="userInfo.password" id="userInfo_password">
                    </div>
                    <div>
                        <label for="userInfo_region">region</label>
                        <select id="userInfo_region" 
                                class="browser-default"
                                ng-model="userInfo.region"
                                ng-options='g.name as g.name for g in regions'
                                ng-init="userInfo.region = g.name">
                                <option value="">Select Region</option>
                            </select>
                    </div>
                    <div>
                        <label for="userInfo_user_role">user_role</label>
                        <select id="userInfo_user_role" 
                            class="browser-default"
                            ng-model="userInfo.user_role"
                            ng-options='g.role as g.role for g in roles'
                            ng-init="userInfo.user_role = g.value">
                            <option value="">Select Role</option>
                        </select>
                        <input type="text" ng-model="userInfo.user_role" id="userInfo_user_role">
                    </div>
                    <div>
                        <button class="btn blue" ng-click="updateUserInfo();">Update</button>
                    </div>
                </form>

                <div class="col s6">
                    <div class="userAvatar" style="background-image: url(./uploads/{{userInfo.image_path}});" ng-click="updateAvatarWindor = true"></div>
                    <div style="text-align: center;" ng-click="updateAvatarWindor = true" class="clickable">Change Avatar</div>

                    <form name="myForm" ng-if="updateAvatarWindor">
                        <fieldset>
                            <legend>Update Avatar</legend>
                            <input type="file" ngf-select ng-model="picFile" name="file"    
                                   accept="image/*" ngf-max-size="20MB" required
                                   ngf-model-invalid="errorFile">
                            <br>
                            <img class="imageUploadPreview" ng-show="myForm.file.$valid" ngf-thumbnail="picFile" class="thumb">
                            <br>
                            <button ng-disabled="!myForm.$valid" ng-click="uploadPic(picFile)">Submit</button>
                            
                            <span ng-show="picFile.result">Upload Successful</span>
                            <span class="err" ng-show="errorMsg">{{errorMsg}}</span>
                        </fieldset>
                    </form>
                </div>
            </div>
            




        <!-- <form name="myForm" ng-if="updateAvatarWindor">
            <fieldset>
                <legend>New Playlist</legend>
                Title:
                <input type="text" name="userName" ng-model="newPlaylistName" size="31" required>
                <i ng-show="myForm.userName.$error.required">*required</i>
                <br>Playlist Cover:
                <input type="file" ngf-select ng-model="picFile" name="file"    
                       accept="image/*" ngf-max-size="2MB" required
                       ngf-model-invalid="errorFile">
                <i ng-show="myForm.file.$error.required">*required</i>
                <br>
                <i ng-show="myForm.file.$error.maxSize">File too large {{errorFile.size / 1000000|number:1}}MB: max 2M</i>
                <img ng-show="myForm.file.$valid" ngf-thumbnail="picFile" class="thumb">
                <button ng-click="picFile = null" ng-show="picFile">Remove</button>
                <br>
                <button ng-disabled="!myForm.$valid" ng-click="uploadPic(picFile)">Submit</button>
                
                <span ng-show="picFile.result">Upload Successful</span>
                <span class="err" ng-show="errorMsg">{{errorMsg}}</span>
            </fieldset>
            <br>
        </form> -->



  
        </div>
    </div>
    <script type="text/javascript" src="./app/account.js"></script>
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