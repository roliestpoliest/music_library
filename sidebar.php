
    <div class="col s2 sidebar" ng-app="SidebarModel" ng-controller="SidebarController">
        <div class="sidebarGroup">
            <div class="sidebarButton"><a href="./home.php"><i class="tiny material-icons">home</i> Home</a></div>
            <div class="sidebarButton"><a href="./search.php"><i class="tiny material-icons">search</i> Search</a></div>
        </div>
        <div class="sidebarGroup">
            <div class="sidebarButton"><a href="./account.php"><i class="tiny material-icons">account_circle</i> Account</a></div>
            <div class="sidebarButton"><a href="./artist_page.php"><i class="tiny material-icons">music_note</i> Artist Page </a></div>
            <div class="sidebarButton" ng-if="user_role.description == 'Artist' || user_role.description == 'Admin'"><a href="artistHub.php"><i class="tiny material-icons">music_video</i> Artist Hub</a></div>
            <div class="sidebarButton" ng-if="user_role.description == 'Admin'"><a href="admin.php"><i class="tiny material-icons">settings</i> Admin</a></div>
            <div class="sidebarButton" ng-click="getNotifications();">
                <i class="tiny material-icons">playlist_play</i> 
                Notifications 
                <span class="indicatorBadge ng-if="user_role.indicator>{{user_role.indicator}}</span>
            </div>
            <div class="sidebarButton" ng-click="logOff();"><i class="tiny material-icons red-text">highlight_off</i> Log out</div>
        </div>
        <div class="notificationsPanel" ng-show="notificationView">
            Notifications
            <ul>
                <li ng-if="!notifications">There are no notifications at the moment</li>
                <li ng-repeat="notification in notifications" title="{{notification.date_created}}">{{notification.message}}</li>
            </ul>
            <span ng-click="notificationView = false;">close</span>
        </div>
        <script type="text/javascript" src="./app/sidebar.js"></script>
    </div>