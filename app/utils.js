var validateResponse = function (responseData, showToast = false) {
    /**
     * Validate response from API. The API will send success or error messages along with its data.
     * If there is an error, it will be marked under data.Error.
     * If there is a success message, it will be marked under data.Success
     * data.LogInError means the authentication token isn't valid
     * 
     * - parameters:
     *  - responseData: The response received from the API
     *  - showToast: Denotes if the user wants to display the message. 
     * 
     * - returns:
     *      - Boolean. False if there is an error message; else returns true.
     */
    var data = {};
    if (!isEmptyOrNull(responseData)) {
        if(typeof responseData == "object"){
            data = responseData;
        }else{
            data = JSON && JSON.parse(responseData) || $.parseJSON(responseData);
        }
        
        if (data.title == "Error") { // An error message has been noted.
            if (showToast == true) {
                M.toast({
                    html: data.description,
                    classes: 'rounded red'
                });
            }
            return false;
        } else if (data.title == "LogInError") { // The token isn't valid and the user will be required to log in.
            location.assign('/index.php');
            return false;
        } else {
            if (data.Success != null && showToast == true) { // There is a success message 
                M.toast({
                    html: data.Success,
                    classes: 'rounded green'
                });
            }
            return true;
        }
    } else {
        return false;
    }
};

var displayErrorMessage = function(customMessage = "An error has ocurred."){
    /**
     * Create a toast shortcut
     * 
     * - parameters:
     *  - customMessage: Optional message to be displayed in the toast.
     */
    M.toast({
        html: customMessage,
        classes: 'rounded red'
    });
};

var displaySuccessMessage = function (customMessage = "Transaction successfully executed.") {
    /**
     * Create a toast shortcut
     * 
     * - parameters:
     *  - customMessage: Optional message to be displayed in the toast.
     */
    M.toast({
        html: customMessage,
        classes: 'rounded green'
    });
};

var validateStatusCode = function (response) {
    if (response.status != 200) {
        M.toast({
            html: "Server Error. Status: " + response.status,
            classes: 'rounded red'
        });
    }
};
var isEmptyOrNull = function(variable) {
    if (variable == null || typeof(variable) == null || typeof (variable) == undefined || variable == "") {
        return true;
    } else {
        return false;
    }
};
var getURLParameterValue = function(param){
    var url = window.location.href.split("?");
    if (url.length > 1){
        if(url[1].indexOf("&") > 0){
            url = url[1].split("&");
        }
        for(var i = 0; i < url.length; i++){
            var urlParams = url[i].split("=");
            if(urlParams[0]  == param){
                return urlParams[1];
            }
        }
    }
    return null;
};