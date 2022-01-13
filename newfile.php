<?php
require_once __DIR__ . '/vendor/autoload.php';
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars

$acceskey = getenv('AWS_ACCESS_KEY_ID'); $secret = getenv('AWS_SECRET_ACCESS_KEY');
$s3 = new Aws\S3\S3Client([
    'version'  => '2006-03-01',
    'region'   => 'eu-west-3',
    'credentials' => [
        'key'    => $acceskey,
        'secret' => $secret,
    ]
]);
$bucket = getenv('S3_BUCKET');

?>



<html>
    <head><meta charset="UTF-8"></head>
    <body>
        <h1>S3 upload example</h1>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    // FIXME: you should add more of your own validation here, e.g. using ext/fileinfo
    try {
        /*
        $key = 'test2000';
        $source = fopen($_FILES['userfile']['tmp_name'], 'rb');

        $uploader = new ObjectUploader(
            $s3,
            $bucket,
            $key,
            $source
            );

do {
    try {
        $result = $uploader->upload();
        if ($result["@metadata"]["statusCode"] == '200') {
            print('<p>File successfully uploaded to ' . $result["ObjectURL"] . '.</p>');
        }
        print($result);
    } catch (MultipartUploadException $e) {
        rewind($source);
        $uploader = new MultipartUploader($s3, $source, [
            'state' => $e->getState(),
        ]);
    }
} while (!isset($result));

fclose($source);


*/



        $result = $s3->putObject([
            'Bucket' => $bucket,
            'Key' => 'poza',
            
            'SourceFile' => fopen($_FILES['userfile']['tmp_name'], "rb"),
            'Body' => fopen($_FILES['userfile']['tmp_name'], "rb")
        ]);
        // FIXME: you should not use 'name' for the upload, since that's the original filename from the user's computer - generate a random filename that you then store in your database, or similar
        //$upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
?>
        <p>Upload successful> :)</p>
<?php } catch(Exception $e) { ?>
        <p>Upload error :(</p>
<?php } } ?>
        <h2>Upload a file</h2>
        <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input name="userfile" type="file"><input type="submit" value="Upload">
            
        </form>
    </body>
</html>
<?php
/*
$result = $s3->putObject([
    'Bucket' => $bucket,
    'Key' => 'poza',
    'Body' => 'this is the body!',
    'SourceFile' => $_FILES['userfile']['tmp_name'],
    'ContentType' => 'image/png'
]);
$result = $s3->getObject([
    'Bucket' => $bucket,
    'Key' => 'poza'
]);
<a href="<?=htmlspecialchars($result->get('ObjectURL'))?>">
echo $result['KE'];*/
?>