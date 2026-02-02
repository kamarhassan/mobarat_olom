<?php
//============================================================+
// File name   : example_018.php
// Begin       : 2008-03-06
// Last Update : 2013-05-14
//
// Description : Example 018 for TCPDF class
//               RTL document with Persian language
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: RTL document with Persian language
 * @author Nicola Asuni
 * @since 2008-03-06
 */

// Include the main TCPDF library (search for installation path).
require_once('TCPDF/tcpdf.php');
//require_once('TCPDF/examples/tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Samer Assaf');
$pdf->SetTitle('Judge');

/*
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'ar';
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);*/
/*$hf=array('dejavusans', '', 12);
$pdf->setHeaderFont($hf);*/
// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);
//$pdf->SetHeaderData('logo-login.jpg', PDF_HEADER_LOGO_WIDTH,'بطاقة تحكيم مشروع', 'xcvx xcvxc ');

// set header and footer fonts
//$pdf->setHeaderFont(Array('dejavusans', '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array('dejavusans', '', PDF_FONT_SIZE_DATA));

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(1.25);

// set some language dependent data:

$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'ar';
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);

// ---------------------------------------------------------
// set some language-dependent strings (optional)
/*if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/ara.php');
	$pdf->setLanguageArray($l);
}*/
// set font
$pdf->SetFont('dejavusans', '', 12);
//$pdf->SetFont('aefurat', '', 12);
//$pdf->SetFont('aealarabiya', '', 12);
/*if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}*/
// add a page
//echo 'asdasdasd567';return;
foreach($prjs as $prj){
    

$pdf->AddPage();
$pdf->setJPEGQuality(75);

//$imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');

// The '@' character is used to indicate that follows an image data stream and not an image file name
//$pdf->Image('@'.$imgdata);

//Yii::app()->theme->baseUrl.'/assets/img/logo.png';
//$pdf->WriteHTML(Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl.'/assets/img/logo-login.jpg', true, 0, true, 0);
//Yii::app()->request->hostInfo.
$pdf->Image(Yii::app()->theme->baseUrl.'/assets/img/logo-login.jpg', 200, 5, 25, 20, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
$pdf->SetXY(40,5);
$pdf->Cell(75, 5, 'بطاقة تحكيم مشروع', 0, 0, 'R');

//$pdf->Ln();
$pdf->SetXY(40,10);
$pdf->Cell(75, 5, 'الفئة:'.$prj['project_type'], 0, 0, 'R');
$pdf->SetXY(40,15);
$pdf->Cell(75, 5, 'المرحلة:'.$prj['project_stage'].'    '.'القاعة:'.$prj['halls'].'    '.'الجناح:'.$prj['suite'], 0, 0, 'R');
$pdf->SetXY(40,20);
$pdf->Cell(75, 5, 'رقم المشروع:'.$prj['project_id'], 0, 0, 'R');
//$pdf->WriteHTML('الفئة:'.$prj['project_type'], true, 0, true, 0);
$pdf->SetXY(10,26);
$pdf->Cell(190, 0, '', 'T', 0, 'C');

$pdf->SetFont('dejavusans', 'B', 12);
$pdf->SetXY(10,26);
$pdf->Cell(190, 0,'إسم الحكم:', 0, 0, 'R');
$pdf->SetXY(10,33);
$pdf->Cell(190, 0, $prj['project_name'], 0, 0, 'C');

$pdf->SetFont('dejavusans', '', 12);
$pdf->WriteHTML($prj['project_description'], true, 0, true, 0);
$pdf->Ln();
$width=180;
$pdf->Cell($width, 0, 'علامة التقييم تترواح بين 1 و20', 'TBLR', 0, 'C');
$pdf->Ln();

if(count($grades)>0){
   $w=$width/ (1+count($grades));
    $pdf->Cell($w, 6, 'معيار التقييم', 'TLRB', 0, 'C',false,'',1);
    $pdf->SetFont('dejavusans', '', 10);
   foreach($grades as $gr){
       $pdf->Cell($w, 6, $gr['code_name'], 'TLRB', 0, 'C',false,'',1);
       
   }
   $pdf->Ln();
    $pdf->SetFont('dejavusans', '', 12);
    $pdf->Cell($w, 6, 'العلامة', 'TLRB', 0, 'C',false,'',1);
   for($i=0;$i<count($grades);$i++)
    $pdf->Cell($w, 6, '', 'TLRB', 0, 'C');
}

    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('dejavusans', '', 10);
$strHtml="المعيار 1 المنهجية العلمية: مفيد للعلم، الانسان، حل مشكلة، تحديث العلوم، فهم جديد لمسائل معروفة
    <br>المعيار 2 المحتوى العلمي ودقتهه: ما مدى دقة المعلومات او النظريات العلمية المستخدمة، هل يواكب الحداثة في العلوم uptodate
    <br>المعيار 3 العرض الشفهي: دقة المعلومات/النظريات، جودة الانتاج/الصيغة النهائية، الثبات والمتانة عند العرض، منهجية التفكير العلمي المعتمد، مهارة ذاتية بدون تدخل ...
    <br>المعيار 4 البوستر والعرض: مهارة العرض، مهارة المنافسة والاقناع، اللغة، اللياقة والترتيب، التقيد بحجم البوستر ...
    <br>المعيار 5 الابتكار والابداع والهدف: الفكرة جديدة او قديمة، إمكان نيلها براءة اختراع، استنتاج ذاتي، هل حقق المشروع الهدف";

$pdf->WriteHTML($strHtml, true, 0, true, 0);
$pdf->Ln(2);
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->Cell(100, 6, 'إمضاء الحكم', '', 0, 'C');
$pdf->Cell(100, 6, 'التاريخ'.'   '. date('d/m/Y'), '', 0, 'C');
// Persian and English content
/*$htmlpersian = '<span color="#660000">Persian example:</span><br />سلام بالاخره مشکل PDF فارسی به طور کامل حل شد. اینم یک نمونش.<br />مشکل حرف \"ژ\" در بعضی کلمات مانند کلمه ویژه نیز بر طرف شد.<br />نگارش حروف لام و الف پشت سر هم نیز تصحیح شد.<br />با تشکر از  "Asuni Nicola" و محمد علی گل کار برای پشتیبانی زبان فارسی.';
$pdf->WriteHTML($htmlpersian, true, 0, true, 0);
*/
// set LTR direction for english translation
/*
$pdf->setRTL(false);

$pdf->SetFontSize(10);

// print newline
$pdf->Ln();

// Persian and English content
$htmlpersiantranslation = '<span color="#0000ff">Hi, At last Problem of Persian PDF Solved completely. This is a example for it.<br />Problem of "jeh" letter in some word like "ویژه" (=special) fix too.<br />The joining of laa and alf letter fix now.<br />Special thanks to "Nicola Asuni" and "Mohamad Ali Golkar" for Persian support.</span>';
$pdf->WriteHTML($htmlpersiantranslation, true, 0, true, 0);

// Restore RTL direction
$pdf->setRTL(true);

// set font
$pdf->SetFont('aefurat', '', 18);

// print newline
$pdf->Ln();

// Arabic and English content
$pdf->Cell(0, 12, 'بِسْمِ اللهِ الرَّحْمنِ الرَّحِيمِ',0,1,'C');
$htmlcontent = 'تمَّ بِحمد الله حلّ مشكلة الكتابة باللغة العربية في ملفات الـ<span color="#FF0000">PDF</span> مع دعم الكتابة <span color="#0000FF">من اليمين إلى اليسار</span> و<span color="#009900">الحركَات</span> .<br />تم الحل بواسطة <span color="#993399">صالح المطرفي و Asuni Nicola</span>  . ';
$pdf->WriteHTML($htmlcontent, true, 0, true, 0);

// set LTR direction for english translation
$pdf->setRTL(false);

// print newline
$pdf->Ln();

$pdf->SetFont('aealarabiya', '', 18);

// Arabic and English content
$htmlcontent2 = '<span color="#0000ff">This is Arabic "العربية" Example With TCPDF.</span>';
$pdf->WriteHTML($htmlcontent2, true, 0, true, 0);

// ---------------------------------------------------------
*/
//Close and output PDF document
}
$pdf->Output('/example_018.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

