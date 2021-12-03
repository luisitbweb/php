<?php

namespace Source\Support;

use CoffeeCode\Uploader\File;
use CoffeeCode\Uploader\Image;
use CoffeeCode\Uploader\Media;
use Source\Core\Message;

/**
 * Description of Upload
 *
 * @author luiscarlosss
 */
class Upload {

    /**
     *
     * @var type Message
     */
    private $message;

    /**
     * Upload contructor
     */
    public function __construct() {
        $this->message = new Message();
    }

    /**
     *
     * @return Message
     */
    public function message(): Message {
        return $this->message;
    }

    /**
     *
     * @param array $image
     * @param string $name
     * @param int $width
     * @return string|null
     * @throws \Exception
     */
    public function image(array $image, string $name, int $width = CONF_IMAGE_SIZE): ?string {

        $upload = new Image(CONF_UPLOAD_DIR, CONF_UPLOAD_IMAGE_DIR);
        if (empty($image['type']) || !in_array($image['type'], $upload::isAllowed())) {
            $this->message->error("Você não selecionou uma imagem válida!!");
            return null;
        }
        return $upload->upload($image, $name, $width, CONF_IMAGE_QUALITY);
    }

    /**
     *
     * @param array $file
     * @param string $name
     * @return string|null
     * @throws \Exception
     */
    public function file(array $file, string $name): ?string {

        $upload = new File(CONF_UPLOAD_DIR, CONF_UPLOAD_FILE_DIR);
        if (empty($file['type']) || !in_array($file['type'], $upload::isAllowed())) {
            $this->message->error("Você não selecionou um arquivo válido!!");
            return null;
        }
        return $upload->upload($file, $name);
    }

    /**
     *
     * @param array $media
     * @param string $name
     * @return string|null
     * @throws \Exception
     */
    public function media(array $media, string $name): ?string {

        $upload = new Midia(CONF_UPLOAD_DIR, CONF_UPLOAD_IMAGE_DIR);
        if (empty($media['type']) || !in_array($media['type'], $upload::isAllowed())) {
            $this->message->error("Você não selecionou uma midia válida!!");
            return null;
        }
        return $upload->upload($media, $name);
    }

    /**
     *
     * @param string $filePath
     * @return void
     */
    public function remove(string $filePath): void {

        if(file_exists($filePath) && is_file($filePath)){
            unlink($filePath);
        }
    }

}
