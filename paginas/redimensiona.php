<?php

class Image {
    private $width = 320; //default 320
    private $height = 240; //default 240
    private $mimeType;
    private $image;
    private $imageResized;
    
    /* Array com tipos de imagens suportadas */
    private $mimeTypesSupported = array(
        'image/gif',
        'image/jpeg',
        'image/png'
    );
    
    /* Redimensiona uma imagem. */
    public function resize($filename = null, $new_width = '320', $new_height = '240'){
        if (!$filename)
            throw new Exception('<pre><b>Error [resize]:<b> Filename is required!</pre><br>');
        
        $this->_getMimeType($filename);
        $this->_openImage($filename);
        $this->_getImageSize();
        
        /* Cria uma imagem com os tamanhos informados */
        $this->imageResized = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
        return $this->image;
    }   
    /* Salva imagem que está na memória para arquivo */
    public function saveImage($filename, $quality = '100'){
        //echo $filename;
        $ext = strtolower(strchr($filename, '.'));
        $ext = substr($filename,-4,4);
        //echo $ext;die;
        
        switch ($ext){
            case '.png':
                if (imagetypes() & IMG_PNG)
                imagepng($this->imageResized, $filename);
            break;
            case '.jpg':
                if (imagetypes() & IMG_JPG)
                    imagejpeg($this->imageResized, $filename, $quality);
            break;
            case '.gif':
                if (imagetypes() & IMG_GIF)
                    imagegif($this->imageResized, $filename);
            break;
            default:
                throw new Exception('<pre><b>Error [saveImage]:</b> Extension not supported!</pre><br>');
            break;
        }     
        imagedestroy($this->image);
    }
    
    /* Cria uma nova imagem e adiciona em $this->image o identificador da imagem */
    private function _openImage($filename){
        $this->image = null;
        
        switch($this->mimeType){
            case 'image/png':
                $this->image = imagecreatefrompng($filename);
            break;
            case 'image/jpeg':
                $this->image = imagecreatefromjpeg($filename);
            break;
            case 'image/gif':
                $this->image = imagecreatefromgif($filename);
            break;
            default:
            break;
        }
        
        if (!$this->image)
            throw new Exception('<pre><b>Error [openImage]:<b> Failed to open '.$filename.'</pre><br>');
    }
    private function _getMimeType($filename){
        $this->mimeType = null;
        $img = getimagesize($filename);
        
        if (isset($img['mime']))
            $this->mimeType = $img['mime'];
        else
            throw new Exception('<pre><b>Error [_getMimeType]:<b> Failed to get image type.<pre><br>');
        
        if (!in_array($this->mimeType, $this->mimeTypesSupported)){
            $this->mimeType = null;
            throw new Exception('<pre><b>Error [_getImageSize]:<b> This file not supported!</pre><br>');
        }
    }
    private function _getImageSize(){
        $this->width    = imagesx($this->image);
        $this->height   = imagesy($this->image);
    }
    public function upload($savePath, $max = 1){
        
    }
}


/* Exemplo de uso: 
$Image = new Image();
$Image->resize('perfil.png', 150, 140);
$Image->saveImage('xd.png');
 * 
 */
?>