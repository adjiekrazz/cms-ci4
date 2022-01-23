<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Files\Exceptions\FileNotFoundException;
use CodeIgniter\Files\File;

class ImageRender extends BaseController
{
	public function index($imageName)
    {
		try {
			$image = new File(WRITEPATH . 'uploads/' . $imageName, true);
		} catch (FileNotFoundException $notFound) {
			throw PageNotFoundException::forPageNotFound($imageName . " isn't found :(");
		}            

        // choose the right mime type
        $mimeType = 'image/jpg';

        $this->response
            ->setStatusCode(200)
            ->setContentType($image->getMimeType())
            ->setBody(file_get_contents($image->getRealPath()))
            ->send();

    }
}
