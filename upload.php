<?php
// Simple validation (max file size 2MB and only two allowed mime types)
$validator = new FileUpload\Validator\Simple('2M', ['image/png', 'image/jpg']);

// Simple path resolver, where uploads will be put
$pathresolver = new FileUpload\PathResolver\Simple('/my/uploads/dir');

// The machine's filesystem
$filesystem = new FileUpload\FileSystem\Simple();

// FileUploader itself
$fileupload = new FileUpload\FileUpload($_FILES['files'], $_SERVER);

// Adding it all together. Note that you can use multiple validators or none at all
$fileupload->setPathResolver($pathresolver);
$fileupload->setFileSystem($filesystem);
$fileupload->addValidator($validator);

// Doing the deed
list($files, $headers) = $fileupload->processAll();

// Outputting it, for example like this
foreach($headers as $header => $value) {
    header($header . ': ' . $value);
}

echo json_encode(['files' => $files]);

foreach($files as $file){
    //Remeber to check if the upload was completed
    if ($file->completed) {
        echo $file->getRealPath();

        // Call any method on an SplFileInfo instance
        var_dump($file->isFile());
    }

}

?>
