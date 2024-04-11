<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <?php include('./headers.php'); ?>
    <link rel="stylesheet" href="./style/artistHub.css">
</head>
<body ng-app="ArtistHubModel" ng-controller="ArtistHubController" ng-cloak>
    <div class="row">
        <div class="col s3 sidebar">
            <div class="sidebarButton"><a href="home.php"><i class="tiny material-icons">home</i> Home</a></div>
            <div class="sidebarButton" class="clickable"><a href="./account.php"><i class="tiny material-icons">account_circle</i> Account</a></div>
            <div class="sidebarButton" ng-if="role == 'Artist' || role == 'Admin'"><a href="artistHub.php"><i class="tiny material-icons">music_video</i> Artist Hub</a></div>
            <div class="sidebarButton">My Albums</div>
            <div class="sidebarButton">My Songs</div>
        </div>
        <div class="col s9">
            <div class="row" ng-show="myAlbumsSection">
                <div class="col s1"></div>
                <div class="col s11 albumList">
                    <table>
                        <tr>
                            <th>Title</th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row" ng-show="mySongsSection"></div>
        </div>
    </div>
    <script type="text/javascript" src="./app/artistHub.js"></script>
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