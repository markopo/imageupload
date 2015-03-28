<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 27/03/2015
 * Time: 21:02
 */

/**
 * Class FileUpload
 * ImageUpload
 */
class FileUpload {

    public $allowedFileTypes = array("jpg", "png", "jpeg", "gif");
    public $maxImageSize = 500000;

    private $target_dir;
    private $fileuploadname;
    private $submitname;

    private $message = "";


    /**
     * @param string $target_dir
     * @param string $fileuploadname
     * @param string $submitname
     */
    public function __construct($target_dir = "uploads/", $fileuploadname = "fileToUpload", $submitname = "submit"){
        $this->target_dir = $target_dir;
        $this->fileuploadname = $fileuploadname;
        $this->submitname = $submitname;
    }

    /**
     * Do image upload, return image
     * @return string
     */
    public function Upload()
    {
        $uploadedImage = "";
        $target_file = $this->target_dir . basename($_FILES[$this->fileuploadname]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (isset($_POST[$this->submitname])) {
            $check = getimagesize($_FILES[$this->fileuploadname]["tmp_name"]);
            if ($check !== false) {
                $this->message .= "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $this->message .= "File is not an image.";
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            $this->message .= "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES[$this->fileuploadname]["size"] > $this->maxImageSize) {
            $this->message .= "Sorry, your file is too large.";
            $uploadOk = 0;
        }


        if (!in_array($imageFileType, $this->allowedFileTypes)) {
            $this->message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $this->message .= "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$this->fileuploadname]["tmp_name"], $target_file)) {
                $img = basename($_FILES[$this->fileuploadname]["name"]);
                $this->message .= "The file " . $img . " has been uploaded.";
                $uploadedImage = "<img src='$this->target_dir/$img' >";
            } else {
                $this->message .= "Sorry, there was an error uploading your file.";
            }
        }

        return $uploadedImage;
    }

    /**
     * @return string
     */
    public function GetMessage() {
        return $this->message;
    }



}