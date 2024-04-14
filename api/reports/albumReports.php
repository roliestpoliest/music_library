<?php
include '../../model/albumReportsModel.php';
include '../../model/accountsModel.php';
$val = new validationModel();
$canGo = $val->ValidateToken($_SERVER);
if(!$canGo){
    $errMsg = new errorMessage('LogInError', 'Please log in before using this application');
    echo(json_encode($errMsg));
    return;
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $formData = array();
    if (!empty($data -> album_id) && trim($data -> album_id) !== '')
    {
        $formData['album_id'] = $data->album_id;
    } 
    if (!empty($data -> record_label) && trim($data -> record_label) !== '')
    {
        $formData['record_label'] = $data->record_label;
    } 
    if (!empty($data -> artist_id) && trim($data -> artist_id) !== '')
    {
        $formData['artist_id'] = $data->artist_id;
    } 
    if (!empty($data -> title) && trim($data -> title) !== '')
    {
        $formData['title'] = $data->title;
    } 
    if (!empty($data -> format) && trim($data -> format) !== '')
    {
        $formData['format'] = $data->format;
    } 
    if (!empty($data -> rating) && trim($data -> rating) !== '')
    {
        $formData['rating'] = $data->rating;
    } 
    //if(empty($formData))
    //$model = new reportsModel();
    if(!empty($formData))
    {  
        $model = new albumReportsModel();
        $result = $model->GetAlbumsByFormData($formData);   
    }
    else
    {
        //$model = new songsModel();
        //$result = $model->GetAllSongs();  
        $model = new albumReportsModel();
        $result = $model->GetAllAlbumsInfo();  
    } 
    echo(json_encode($result));
    return;
}


?>
