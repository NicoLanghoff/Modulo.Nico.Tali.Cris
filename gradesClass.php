<?php
class Grades {
    // Atributos
    private $asignature;
    private $instance;
    private $idGrade;
    private $idStudent;
    private $studentYear;
    private $studentClass;
    private $studentShift;
    private $studentDivision;
    private $yearDate;

    // Constructor
    public function __construct($asignature, $instance, $idGrade, $idStudent, $studentYear, $studentClass, $studentShift, $studentDivision, $yearDate) {
        $this->asignature = $asignature;
        $this->instance = $instance;
        $this->idGrade = $idGrade;
        $this->idStudent = $idStudent;
        $this->studentYear = $studentYear;
        $this->studentClass = $studentClass;
        $this->studentShift = $studentShift;
        $this->studentDivision = $studentDivision;
        $this->yearDate = $yearDate;
    }

    // Métodos
    public function getStudentData() {
        return [
            'asignature' => $this->asignature,
            'instance' => $this->instance,
            'idGrade' => $this->idGrade,
            'idStudent' => $this->idStudent,
            'studentYear' => $this->studentYear,
            'studentClass' => $this->studentClass,
            'studentShift' => $this->studentShift,
            'studentDivision' => $this->studentDivision,
            'yearDate' => $this->yearDate,
        ];
    }

    public function editNews($newData) {
        // Actualiza los atributos con los nuevos datos proporcionados
        $this->asignature = $newData['asignature'] ?? $this->asignature;
        $this->instance = $newData['instance'] ?? $this->instance;
        $this->idGrade = $newData['idGrade'] ?? $this->idGrade;
        $this->idStudent = $newData['idStudent'] ?? $this->idStudent;
        $this->studentYear = $newData['studentYear'] ?? $this->studentYear;
        $this->studentClass = $newData['studentClass'] ?? $this->studentClass;
        $this->studentShift = $newData['studentShift'] ?? $this->studentShift;
        $this->studentDivision = $newData['studentDivision'] ?? $this->studentDivision;
        $this->yearDate = $newData['yearDate'] ?? $this->yearDate;
    }

    public function deleteNews() {
        // Elimina o reinicia los datos de la clase
        $this->asignature = null;
        $this->instance = null;
        $this->idGrade = null;
        $this->idStudent = null;
        $this->studentYear = null;
        $this->studentClass = null;
        $this->studentShift = null;
        $this->studentDivision = null;
        $this->yearDate = null;
    }

    public function addNews($data) {
        // Añade o actualiza los atributos con los datos proporcionados
        $this->asignature = $data['asignature'] ?? $this->asignature;
        $this->instance = $data['instance'] ?? $this->instance;
        $this->idGrade = $data['idGrade'] ?? $this->idGrade;
        $this->idStudent = $data['idStudent'] ?? $this->idStudent;
        $this->studentYear = $data['studentYear'] ?? $this->studentYear;
        $this->studentClass = $data['studentClass'] ?? $this->studentClass;
        $this->studentShift = $data['studentShift'] ?? $this->studentShift;
        $this->studentDivision = $data['studentDivision'] ?? $this->studentDivision;
        $this->yearDate = $data['yearDate'] ?? $this->yearDate;
    }
}
?>
