<?php 

class lastMod{
	
	
	
	private $rowArray = array();
	private $ageDB = '';
	private $sexDB = '';
	private $locationDB = '';
	private $aboutDB = '';
	
	private $imageResized = '';
	
	public function getRowArray()
    {
        return $this->rowArray();
    }
	
function showImage($imageString)
	{
		header('Content-Type: image/jpeg');
		readfile($imageString);
	}

function compressImage($source_url, $destination_url, $quality) 
	{
	
		$info = getimagesize($source_url);

		if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
		elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
		elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);

		//save file
		imagejpeg($image, $destination_url, $quality);

		//return destination file
		return $destination_url;
	}
	
function resizeImage($newWidth, $newHeight, $option="auto")
        {
            // *** Get optimal width and height - based on $option
            $optionArray = $this->getDimensions($newWidth, $newHeight, $option);

            $optimalWidth  = $optionArray['optimalWidth'];
            $optimalHeight = $optionArray['optimalHeight'];


            // *** Resample - create image canvas of x, y size
            $this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
            imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);


            // *** if option is 'crop', then crop too
            if ($option == 'crop') {
                $this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
            }
        }	

public function saveImage($savePath, $imageQuality)
        {
            // *** Get extension
            $extension = strrchr($savePath, '.');
            $extension = strtolower($extension);

            switch($extension)
            {
                case '.jpg':
                case '.jpeg':
                    if (imagetypes() & IMG_JPG) {
                        imagejpeg($this->imageResized, $savePath, $imageQuality);
                    }
                    break;

                case '.gif':
                    if (imagetypes() & IMG_GIF) {
                        imagegif($this->imageResized, $savePath);
                    }
                    break;

                case '.png':
                    // *** Scale quality from 0-100 to 0-9
                    $scaleQuality = round(($imageQuality/100) * 9);

                    // *** Invert quality setting as 0 is best, not 9
                    $invertScaleQuality = 9 - $scaleQuality;

                    if (imagetypes() & IMG_PNG) {
                         imagepng($this->imageResized, $savePath, $invertScaleQuality);
                    }
                    break;

                // ... etc

                default:
                    // *** No extension - No save.
                    break;
            }

            
        }
		


function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

}
?>
