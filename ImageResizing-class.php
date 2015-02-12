<?php

Class ImageResize
{
	///***variables
	private $image;
	private $width;
	private $height;
	private $imageResized;
	
	public function __construct($fileName)
	{
		//***Open the file
		$this->image = $this->openImage($fileName);
		
		//***Get width and height
		$this->width = imagesx($this->image);
		$this->height = imagesy($this->image);
	}
	
	public function resizeImage($newWidth, $newHeight, $option = "auto")
	{
		//***Get best width and height - based on $option
		$optionArray = $this->getDimensions($newWidth, $newHeight, strtolower($option));
		
		$bestWidth = $optionArray['bestWidth'];
		$bestHeight = $optionArray['bestHeight'];
		
		//***Create image canvas of x,y size
		$this->imageResized = imagecreatetruecolor($bestWidth, $bestHeight);
		imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $bestWidth, $bestHeight, $this->width, $this->height);
		
		//***If option is 'crop', also crop image
		if($option == 'crop')
		{
			$this->crop($bestWidth, $bestHeight, $newWidth, $newHeight);
		}
	}
	
	private function openImage($file)
	{
		//***Get image extension
		$extension = strtolower(strrchr($file, '.'));
		
		switch($extension)
		{
			case '.jpg':
			case '.jpeg':
				$img = @imagecreatefromjpeg($file);
				break;
			case '.gif':
				$img = @imagecreatefromgif($file);
				break;
			case '.png':
				$img = @imagecreatefrompng($file);
				break;
			default:
				$img = false;
				break;
		}
		return $img;
	}
	
	private function getDimensions($newWidth, $newHeight, $option)
	{
		switch($option)
		{
			case 'exact':
				$bestWidth = $newWidth;
				$bestHeight = $newHeight;
				break;
			case 'portrait':
				$bestWidth = $this->getSizeByFixedHeight($newHeight);
				$bestHeight = $newHeight;
				break;
			case 'landscape':
				$bestWidth = $newWidth;
				$bestHeight = $this->getSizeByFixedWidth($newWidth);
				break;
			case 'auto':
				$optionArray = $this->getSizeByAuto($newWidth, $newHeight);
				$bestWidth = $optionArray['bestWidth'];
				$bestHeight = $optionArray['bestHeight'];
				break;
			case 'crop':
				$optionArray = $this->getBestCrop($newWidth, $newHeight);
				$bestWidth = $optionArray['bestWidth'];
				$bestHeight = $optionArray['bestHeight'];
				break;
		}
		return array('bestWidth' => $bestWidth, 'bestHeight' => $bestHeight);
	}
	
	private function getSizeByFixedHeight($newHeight)
	{
		$ratio = $this->width / $this->height;
		$newWidth = $newHeight * $ratio;
		return $newWidth;
	}
	
	private function getSizeByFixedWidth($newWidth)
	{
		$ratio = $this->height / $this->width;
		$newHeight = $newWidth * $ratio;
		return $newHeight;
	}
	
	private function getSizeByAuto($newWidth, $newHeight)
	{
		if($this->height < $this->width)
		{
			//***Image to be resized is wider (landscape)
			$bestWidth = $newWidth;
			$bestHeight = $this->getSizeByFixedWidth($newWidth);
		}
		elseif($this->height > $this->width)
		{
			//***Image to be resized is taller (portrait)
			$bestWidth = $this->getSizeByFixedHeight($newHeight);
			$bestHeight = $newHeight;
		}
		else
		{
			//***Image to be resized is square
			if($newHeight < $newWidth)
			{
				$bestWidth = $newWidth;
				$bestHeight = $this->getSizeByFixedWidth($newWidth);
			}
			elseif ($newHeight > $newWidth)
			{
				$bestWidth = $this->getSizeByFixedHeight($newHeight);
				$bestHeight = $newHeight;
			}
			else
			{
				//***Square being resized to a square
				$bestWidth = $newWidth;
				$bestHeight = $newHeight;
			}
		}
		return array('bestWidth' => $bestWidth, 'bestHeight' => $bestHeight);
	}
	
	private function getBestCrop($newWidth, $newHeight)
	{
		$heightRatio = $this->height / $newHeight;
		$widthRatio = $this->width / $newWidth;
		
		if($heightRatio < $widthRatio)
		{
			$bestRatio = $heightRatio;
		}
		else
		{
			$bestRatio = $widthRatio;
		}
		
		$bestHeight = $this->height / $bestRatio;
		$bestWidth = $this->width / $bestRatio;
		
		return array('bestWidth' => $bestWidth, 'bestHeight' => $bestHeight);
	}
	
	private function crop($bestWidth, $bestHeight, $newWidth, $newHeight)
	{
		//***first find the center of the image
		$cropStartX = ($bestWidth/2) - ($newWidth/2);
		$cropStartY = ($bestHeight/2) - ($newHeight/2);
		
		$crop = $this->imageResized;
		
		//*** Crop from center to determined size
		$this->imageResized = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($this->imageResized, $crop, 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight, $newWidth, $newHeight);
	}
	
	//***Saving the newly made image
	public function saveImage($savePath, $imageQuality = "100")
	{
		//***first, get the image extension
		$extension = strrchr($savePath, '.');
		$extension = strtolower($extension);
		
		switch($extension)
		{
			case '.jpg':
			case '.jpeg':
				if (imagetypes() & IMG_JPG)
				{
					imagejpeg($this->imageResized, $savePath, $imageQuality);
				}
				break;
			case '.gif':
				if(imagetypes() & IMG_GIF)
				{
					imagegif($this->imageResized, $savePath);
				}
				break;
			case '.png':
				//***Scale quality from 0-100 to 0-9
				$scaleQuality = round(($imageQuality/100)*9);
				
				//***Now invert the quality setting as 0 = best, 9 = worst
				$invertScaleQual = 9 - $scaleQuality;
				
				if(imagetypes() & IMG_PNG)
				{
					imagepng($this->imageResized, $savePath, $invertScaleQual);
				}
				break;
			default:
				//***If there is no extension, there is no save
				break;
		}
		imagedestroy($this->imageResized);
	}
}
?>