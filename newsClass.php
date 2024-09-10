<?php
class News {
    // Atributos
    private $title;
    private $idNew;
    private $date;
    private $body;
    private $image;
    private $link;

    // Constructor
    public function __construct($title, $idNew, $date, $body, $image, $link) {
        $this->title = $title;
        $this->idNew = $idNew;
        $this->date = $date;
        $this->body = $body;
        $this->image = $image;
        $this->link = $link;
    }

    // Métodos
    public static function getAllNews($newsArray) {
        // Devuelve una lista de todas las noticias
        return $newsArray;
    }

    public function addNews(&$newsArray) {
        // Añade la noticia actual al array de noticias
        $newsArray[] = $this;
    }

    public function deleteNews(&$newsArray) {
        // Elimina la noticia actual del array de noticias
        foreach ($newsArray as $key => $news) {
            if ($news->idNew === $this->idNew) {
                unset($newsArray[$key]);
                // Reindexar el array
                $newsArray = array_values($newsArray);
                return true;
            }
        }
        return false;
    }

    public function editNews($newData) {
        // Actualiza los atributos de la noticia con los nuevos datos proporcionados
        $this->title = $newData['title'] ?? $this->title;
        $this->date = $newData['date'] ?? $this->date;
        $this->body = $newData['body'] ?? $this->body;
        $this->image = $newData['image'] ?? $this->image;
        $this->link = $newData['link'] ?? $this->link;
    }

    public static function selectNews($idNew, $newsArray) {
        // Selecciona una noticia por su ID
        foreach ($newsArray as $news) {
            if ($news->idNew === $idNew) {
                return $news;
            }
        }
        return null;
    }
}
?>
