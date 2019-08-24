<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public $images = [];

	public function getGalleryDir()
	{
		$galleryDir = 'public/products/'.$this->id;

		return $galleryDir;
	}

	public function getPrimaryImage()
	{
		$image = $this->getGalleryImages();
		if(!count($image)) return '';
		return $image[0];
	}

	public function getGalleryImages()
	{
		$this->images = \Storage::files($this->getGalleryDir());
		return $this->images;
	}

	public function valut()
	{
		return $this->belongsTo('App\Valut');
	}
}
