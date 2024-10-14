<?php

require('../fpdf/fpdf.php');
require '../../includes/conn.php';

class PDF extends FPDF
{

    // Page header

}

$pdf = new PDF('P', 'mm', 'Legal');
//left top right
$pdf->SetMargins(25, 25, 25);
$pdf->AddPage();

// Logo(x axis, y axis, width, height)
$pdf->Image('../../docs/assets/img/logo2.jpg', 43, 20, 19, 19);
$pdf->Image('../../docs/assets/img/sfac.png', 62, 21, 105, 18);
// text color
//$pdf->SetTextColor(255, 0, 0);
// font(font type,style,font size)
$pdf->SetFont('Arial', 'B', 12);

$pdf->Ln(12);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 8, '96 Bayanan, City of Bacoor, Cavite, Philippines', 0, 1, 'C');

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Rect(162, 43, 20, 7); // Rectangle (x, y, w, h)
$pdf->Cell(155, 0, "FORM - 9", 0, 1, 'R');

$pdf->Ln(0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 0, 'College Department - Guidance Office', 0, 1, 'C');

$pdf->Ln(9);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, 'CONFERENCE LETTER', 0, 1, 'C');

$pdf->Ln(5);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, '', 0, 0); // SPACE
$pdf->Cell(75, 5, '[ ] First Notice', 0, 0, ''); 
$pdf->Cell(-36, 5, '', 0, 0); // SPACE

$pdf->Cell(10, 5, '[ ] Second Notice', 0, 0, ''); 
$pdf->Cell(33, 5, '', 0, 0); // SPACE

$pdf->Cell(-10, 5, '[ ] Third Notice', 0, 0, ''); 
$pdf->Cell(28, 5, '', 0, 0); // SPACE

//Cell(width , height , text , border , end line , {align} )
$pdf->Ln(11);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 5, 'Date: ', 0, 0);
$pdf->Cell(40, 4, '', 'B', 0); // FOR DATA 

$pdf->Ln(11);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(9, 5, 'Dear', 0, 0);
$pdf->Cell(40, 4, '', 'B', 0); // FOR DATA 
$pdf->Cell(5, 5, ',', 0, 0);

$pdf->Ln(11);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 5, 'Greetings!', 0, 0);

$pdf->Ln(11);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 5, 'We would like to have a conference with you regarding your child\'s: ', 0, 0);

$pdf->Ln(6);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, '', 0, 0); // SPACE
$pdf->Cell(75, 5, '[ ] Academics', 0, 0, ''); 
$pdf->Cell(-36, 5, '', 0, 0); // SPACE

$pdf->Cell(10, 5, '[ ] Discipline', 0, 0, ''); 
$pdf->Cell(33, 5, '', 0, 0); // SPACE

$pdf->Cell(-10, 5, '[ ] Other: ', 0, 0, ''); 
$pdf->Cell(28, 5, '', 0, 0); // SPACE
$pdf->Cell(36, 4, '', 'B', 0); // FOR DATA 

$pdf->Ln(6);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 5, 'Please see the following individual/s below on', 0, 0);
$pdf->Cell(63, 5, '', 0, 0); // SPACE
$pdf->Cell(40, 4, '', 'B', 0); // FOR DATA 
$pdf->Cell(10, 5, 'at', 0, 0);
$pdf->Cell(-5, 5, '', 0, 0); // SPACE
$pdf->Cell(40, 4, '', 'B', 0); // FOR DATA 

$pdf->Cell(63, 5, '', 0, 0); // SPACE
$pdf->Ln(9);
$pdf->Rect(16, 130, 61, 6); // box
$pdf->Rect(77, 130, 60.5, 6); // box

$pdf->Rect(16, 136, 61, 6); // box
$pdf->Rect(77, 136, 60.5, 6); // box

$pdf->Rect(16, 148, 61, 6); // box
$pdf->Rect(77, 148, 60.5, 6); // box

// END
$pdf->Output();


?>