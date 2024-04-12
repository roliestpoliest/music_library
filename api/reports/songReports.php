<?php
include '../../model/songReportsModel.php';
include '../../model/songsModel.php';
include '../../model/accountsModel.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $formData = array();
    if (!empty($data -> artist_id) && trim($data -> artist_id) !== '')
    {
        $formData['artist_id'] = $data->artist_id;
    } 
    if (!empty($data -> title) && trim($data -> title) !== '')
    {
        $formData['title'] = $data->title;
    } 
    if (!empty($data -> genre_id) && trim($data -> genre_id) !== '')
    {
        $formData['genre_id'] = $data->genre_id;
    } 
    if (!empty($data -> listens) && trim($data -> listens) !== '')
    {
        $formData['listens'] = $data->listens;
    } 
    if (!empty($data -> rating) && trim($data -> rating) !== '')
    {
        $formData['rating'] = $data->rating;
    } 
    //if(empty($formData))
    //$model = new reportsModel();
    if(!empty($formData))
    {  
        $model = new songReportsModel();
        $result = $model->GetSongsByFormData($formData);   
    }
    else
    {
        $model = new songsModel();
        $result = $model->GetAllSongs();  
    } 
    echo(json_encode($result));
    return;
}


?>
