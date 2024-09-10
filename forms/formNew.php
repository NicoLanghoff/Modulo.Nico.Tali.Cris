<?php
require_once 'newsClass.php';

session_start();

// Array de noticias (en una aplicación real, esto vendría de una base de datos)
if (!isset($_SESSION['newsArray'])) {
    $_SESSION['newsArray'] = [];
}

$newsArray = &$_SESSION['newsArray'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNew = $_POST['idNew'] ?? null;

    if (isset($_POST['add'])) {
        $news = new News(
            $_POST['title'],
            uniqid(), // Genera un ID único para la noticia
            $_POST['date'],
            $_POST['body'],
            $_POST['image'],
            $_POST['link']
        );
        $news->addNews($newsArray);
    }

    if (isset($_POST['edit'])) {
        $news = News::selectNews($idNew, $newsArray);
        if ($news) {
            $news->editNews([
                'title' => $_POST['title'],
                'date' => $_POST['date'],
                'body' => $_POST['body'],
                'image' => $_POST['image'],
                'link' => $_POST['link']
            ]);
        }
    }

    if (isset($_POST['delete'])) {
        $news = News::selectNews($idNew, $newsArray);
        if ($news) {
            $news->deleteNews($newsArray);
        }
    }
}

// Cargar una noticia para editar
$editNews = null;
if (isset($_GET['edit'])) {
    $editNews = News::selectNews($_GET['edit'], $newsArray);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Noticias</title>
</head>
<body>
    <h1>Formulario de Noticias</h1>

    <form method="post">
        <input type="hidden" name="idNew" value="<?php echo htmlspecialchars($editNews ? $editNews->getIdNew() : ''); ?>">

        <label for="title">Título:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($editNews ? $editNews->getTitle() : ''); ?>" required>
        <br>

        <label for="date">Fecha:</label>
        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($editNews ? $editNews->getDate() : ''); ?>" required>
        <br>

        <label for="body">Cuerpo:</label>
        <textarea id="body" name="body" required><?php echo htmlspecialchars($editNews ? $editNews->getBody() : ''); ?></textarea>
        <br>

        <label for="image">Imagen:</label>
        <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($editNews ? $editNews->getImage() : ''); ?>">
        <br>

        <label for="link">Enlace:</label>
        <input type="text" id="link" name="link" value="<?php echo htmlspecialchars($editNews ? $editNews->getLink() : ''); ?>">
        <br>

        <?php if ($editNews): ?>
            <button type="submit" name="edit">Editar Noticia</button>
            <button type="submit" name="delete">Eliminar Noticia</button>
        <?php else: ?>
            <button type="submit" name="add">Añadir Noticia</button>
        <?php endif; ?>
    </form>

    <h2>Lista de Noticias</h2>
    <ul>
        <?php foreach ($newsArray as $news): ?>
            <li>
                <strong><?php echo htmlspecialchars($news->getTitle()); ?></strong> - 
                <a href="?edit=<?php echo htmlspecialchars($news->getIdNew()); ?>">Editar</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
