<?php
require_once 'Grades.php';

session_start();

// Array de grados (en una aplicación real, esto vendría de una base de datos)
if (!isset($_SESSION['gradesArray'])) {
    $_SESSION['gradesArray'] = [];
}

$gradesArray = &$_SESSION['gradesArray'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idGrade = $_POST['idGrade'] ?? null;

    if (isset($_POST['add'])) {
        $grade = new Grades(
            $_POST['asignature'],
            $_POST['instance'],
            uniqid(), // Genera un ID único para el grado
            $_POST['idStudent'],
            $_POST['studentYear'],
            $_POST['studentClass'],
            $_POST['studentShift'],
            $_POST['studentDivision'],
            $_POST['yearDate']
        );
        $grade->addGrade($gradesArray);
    }

    if (isset($_POST['edit'])) {
        $grade = Grades::selectGrade($idGrade, $gradesArray);
        if ($grade) {
            $grade->editGrade([
                'asignature' => $_POST['asignature'],
                'instance' => $_POST['instance'],
                'idStudent' => $_POST['idStudent'],
                'studentYear' => $_POST['studentYear'],
                'studentClass' => $_POST['studentClass'],
                'studentShift' => $_POST['studentShift'],
                'studentDivision' => $_POST['studentDivision'],
                'yearDate' => $_POST['yearDate']
            ]);
        }
    }

    if (isset($_POST['delete'])) {
        $grade = Grades::selectGrade($idGrade, $gradesArray);
        if ($grade) {
            $grade->deleteGrade($gradesArray);
        }
    }
}

// Cargar un grado para editar
$editGrade = null;
if (isset($_GET['edit'])) {
    $editGrade = Grades::selectGrade($_GET['edit'], $gradesArray);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Grados</title>
</head>
<body>
    <h1>Formulario de Grados</h1>

    <form method="post">
        <input type="hidden" name="idGrade" value="<?php echo htmlspecialchars($editGrade ? $editGrade->getIdGrade() : ''); ?>">

        <label for="asignature">Asignatura:</label>
        <input type="text" id="asignature" name="asignature" value="<?php echo htmlspecialchars($editGrade ? $editGrade->getAsignature() : ''); ?>" required>
        <br>

        <label for="instance">Instancia:</label>
        <input type="text" id="instance" name="instance" value="<?php echo htmlspecialchars($editGrade ? $editGrade->getInstance() : ''); ?>" required>
        <br>

        <label for="idStudent">ID del Estudiante:</label>
        <input type="text" id="idStudent" name="idStudent" value="<?php echo htmlspecialchars($editGrade ? $editGrade->getIdStudent() : ''); ?>" required>
        <br>

        <label for="studentYear">Año del Estudiante:</label>
        <input type="text" id="studentYear" name="studentYear" value="<?php echo htmlspecialchars($editGrade ? $editGrade->getStudentYear() : ''); ?>" required>
        <br>

        <label for="studentClass">Clase del Estudiante:</label>
        <input type="text" id="studentClass" name="studentClass" value="<?php echo htmlspecialchars($editGrade ? $editGrade->getStudentClass() : ''); ?>" required>
        <br>

        <label for="studentShift">Turno del Estudiante:</label>
        <input type="text" id="studentShift" name="studentShift" value="<?php echo htmlspecialchars($editGrade ? $editGrade->getStudentShift() : ''); ?>" required>
        <br>

        <label for="studentDivision">División del Estudiante:</label>
        <input type="text" id="studentDivision" name="studentDivision" value="<?php echo htmlspecialchars($editGrade ? $editGrade->getStudentDivision() : ''); ?>" required>
        <br>

        <label for="yearDate">Fecha del Año:</label>
        <input type="date" id="yearDate" name="yearDate" value="<?php echo htmlspecialchars($editGrade ? $editGrade->getYearDate() : ''); ?>" required>
        <br>

        <?php if ($editGrade): ?>
            <button type="submit" name="edit">Editar Grado</button>
            <button type="submit" name="delete">Eliminar Grado</button>
        <?php else: ?>
            <button type="submit" name="add">Añadir Grado</button>
        <?php endif; ?>
    </form>

    <h2>Lista de Grados</h2>
    <ul>
        <?php foreach ($gradesArray as $grade): ?>
            <li>
                <strong><?php echo htmlspecialchars($grade->getAsignature()); ?></strong> - 
                <a href="?edit=<?php echo htmlspecialchars($grade->getIdGrade()); ?>">Editar</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
