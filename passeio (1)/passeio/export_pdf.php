<?php
require('fpdf/fpdf.php');

$servername = "localhost";
$username = "root"; // seu usuário do banco de dados
$password = ""; // sua senha do banco de dados
$dbname = "test";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consultar participantes visíveis para o relatório PDF
$sql = "SELECT * FROM participantes WHERE visivel=1";
$result = $conn->query($sql);

// Criar PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Relatório de Participantes', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Nome Completo');
$pdf->Cell(40, 10, 'Categoria');
$pdf->Cell(40, 10, 'Subcategoria');
$pdf->Cell(40, 10, 'Telefone');
$pdf->Cell(40, 10, 'Email');
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);

while ($row = $result->fetch_assoc()) {
    $pdf->Cell(40, 10, $row['nome_completo']);
    $pdf->Cell(40, 10, $row['categoria']);
    $pdf->Cell(40, 10, $row['subcategoria']);
    $pdf->Cell(40, 10, $row['telefone']);
    $pdf->Cell(40, 10, $row['email']);
    $pdf->Ln();
}

$pdf->Output('D', 'relatorio_participantes.pdf');

$conn->close();
?>
