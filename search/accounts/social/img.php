 <form enctype="multipart/form-data" method="post" action="img.php">
    Choose your file here:
    <input name="uploaded_file" type="file"/>
    <input type="submit" value="Upload It"/>
    </form>
<?
include('../config.php');
if(isset($_FILES['uploaded_file'])){
$id="fd084ccb4478459f76916ce90d748af6";
    $filename = $_FILES['uploaded_file']['tmp_name'];
    $handle = fopen($filename, "r");
    $data = fread($handle, filesize($filename));

    // $data is file data
    $pvars   = array('image' => base64_encode($data), 'key' => $id);
    $timeout = 30;
    $curl    = curl_init();

    curl_setopt($curl, CURLOPT_URL, 'http://api.imgur.com/2/upload.json');
    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);

    $xml = curl_exec($curl);
    curl_close ($curl);
    $params = json_decode($xml,true);
print_r($params);
if ($params['upload']['links']['small_square']!=null){
save('imgo',$params['upload']['links']['original']);
save('imgs',$params['upload']['links']['small_square']);}
}
?>
