<?


require '../vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
$pmb=$_SESSION['pmbU'];
$visaUrl ='';
$ifeUrl='';
// Set Amazon s3 credentials
$client = S3Client::factory(
  array(
    'profile' => 'default',
    'region' => 'us-west-2',
    'version'=> 'latest'
  )
);


include('./helpers/imagevalidation.php'); // getExtension Method

if(strlen($name) != '') {
// // File format validation
    if(in_array($ext,$valid_formats)) {
    // // File size validation
          if($size<(1024*1024))
          {
          //Rename image name.
          $image_name_actual = "identificaciones/ife".time().".".$ext;

           try {
                  $client->putObject(array(
                       'Bucket'=>'maspost',
                       'Key' =>  $image_name_actual,
                       'SourceFile' => $tmp,
                       'StorageClass' => 'REDUCED_REDUNDANCY'
                  ));

          $ifeUrl='http://maspost.s3.amazonaws.com/'.$image_name_actual;
              $ifeUrl;
              } catch (S3Exception $e) {
                   // Catch an S3 specific exception.
                  // echo $e->getMessage();
                $message= $e->getMessage();
              }

          }else {
          return $message = "Image size Max 1 MB";

          }

    } else {
      return $message = "Please select image file.";

    }
} else {
return $message = "Invalid file, please upload image file.";
}

}

if($_FILES["visa"]["name"] !=''){
  $name = $_FILES['visa']['name'];
  $size = $_FILES['visa']['size'];
  $tmp = $_FILES['visa']['tmp_name'];
  $ext = getExtension($name);
if(strlen($name) != '') {
// // File format validation
    if(in_array($ext,$valid_formats)) {
    // // File size validation
          if($size<(1024*1024))
          {
          //Rename image name.
          $image_name_actual = "identificaciones/visa".time().".".$ext;

           try {
                  $client->putObject(array(
                       'Bucket'=>'maspost',
                       'Key' =>  $image_name_actual,
                       'SourceFile' => $tmp,
                       'StorageClass' => 'REDUCED_REDUNDANCY'
                  ));

          $visaUrl='http://maspost.s3.amazonaws.com/'.$image_name_actual;

              } catch (S3Exception $e) {
                   // Catch an S3 specific exception.
                  // echo $e->getMessage();
                $message= $e->getMessage();
              }

          } else {
          return $message = "Image size Max 1 MB";

          }

    } else {
     return $message = "Please select image file.";

    }
} else {
return $message = "Invalid file, please upload image file.";
}

}
} else {
  $message = "";

}


?>
