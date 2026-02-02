<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cls_PDF_Certification
 *
 * @author Samerٍٍ
 */
class cls_PDF_Certification {
    //put your code here
    static public function getCommon($bolShwBKG,$strBKG){
        //$pdf = new cls_PDF_background(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf = new cls_PDF_background('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->bolShowBackground=$bolShwBKG;
        $pdf->strBackgroundName=$strBKG;

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Samer Assaf');
        $pdf->SetTitle('Certification');
        $pdf->SetSubject('Certification');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        // remove default footer
        $pdf->setPrintFooter(false);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        

//        $pdf->AddPage();
        return $pdf;
    }
   /*
    static public function getCertStudent($prjs,$bolShwBKG, $strBKG){
        $pdf= cls_PDF_Certification::getCommon($bolShwBKG, $strBKG);
        foreach($prjs as $prj){
            
        $pdf->AddPage();
        $pdf->SetFont('aefurat', 'b', 28);
        $counter=60;
        $pas=12;
        $width=292;
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->Cell($width, 5, 'تمنحها', 0, 0, 'C');
        $pdf->SetXY(5,$counter);
         $counter+=$pas+8;
         $pas=15;
         $pdf->SetFont('aealarabiya','' , 28);
        $pdf->Cell($width, 5, 'الهيئة الوطنية للعلوم والبحوث', 0, 0, 'C');
         $pdf->SetFont('aefurat', 'b', 28);
        $pdf->SetXY(5,$counter);
         $counter+=$pas;
         $strLabel='للطالب';
         if($prj['Person_sex']=='02')
                 $strLabel.='ة';
                 
        $pdf->Cell($width, 5, $strLabel, 0, 0, 'C');
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->SetFont('aealarabiya','' , 32);
        $pdf->Cell($width, 5, $prj['Person_fname'].' '.$prj['Person_mname'].' '.$prj['Person_lname'], 0, 0, 'C');
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->SetFont('aefurat', 'b', 28);
        //$pdf->Cell($width, 5, 'للمشاركة في مشروع', 0, 0, 'C');
        $pdf->Cell($width, 5, 'عن مشروع', 0, 0, 'C');
        
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->Cell($width, 5, $prj['project_name'], 0, 0, 'C');
        if($prj['project_prize']=='01' || $prj['project_prize']=='02' || $prj['project_prize']=='03'){
            $label='الفائز';
            
            if($prj['Person_sex']=='02')
                 $label.='ة';
            $label.=' '. ' بالميدالية '. ' ';
            if($prj['project_prize']=='01')
                $label.='الذهبية';
            elseif($prj['project_prize']=='02')
                $label.='الفضية';
            elseif($prj['project_prize']=='03')
                $label.='البرونزية';
            
            $pdf->SetXY(5,$counter);
            $counter+=$pas;
            $pdf->SetFont('aefurat', 'b', 30);
            $pdf->Cell($width, 5, $label, 0, 0, 'C');
        }
        $pdf->SetFont('aefurat', 'b', 28);
        
         $pdf->SetXY(5,$counter);
         $counter+=$pas;
        $pdf->Cell($width, 5, 'في مباراة العلوم '.$prj['mobarat_year'], 0, 0, 'C');
        }
//        $pdf->SetXY(40,25);
//        $pdf->Cell(75, 5, $prj['project_type'].' \ '.$prj['project_stage'], 0, 0, 'C');
//        $pdf->SetXY(40,35);
//        $pdf->Cell(75, 5, $prj['school_name'], 0, 0, 'C');
        
        return $pdf;
    }
    
    static public function getCertTeacher($prjs,$bolShwBKG, $strBKG){
        $pdf= cls_PDF_Certification::getCommon($bolShwBKG, $strBKG);
        foreach($prjs as $prj){
            
        $pdf->AddPage();
        $pdf->SetFont('aefurat', 'b', 28);
        $counter=60;
        $pas=12;
        $width=292;
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->Cell($width, 5, 'تمنحها', 0, 0, 'C');
        $pdf->SetXY(5,$counter);
         $counter+=$pas+8;
         $pas=15;
         $pdf->SetFont('aealarabiya','' , 28);
        $pdf->Cell($width, 5, 'الهيئة الوطنية للعلوم والبحوث', 0, 0, 'C');
         $pdf->SetFont('aefurat', 'b', 28);
        $pdf->SetXY(5,$counter);
         $counter+=$pas;
         $strLabel='للأستاذ';
         if($prj['Person_sex']=='02')
                 $strLabel.='ة';
                 
        $pdf->Cell($width, 5, $strLabel, 0, 0, 'C');
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->SetFont('aealarabiya','' , 32);
        $pdf->Cell($width, 5, $prj['Person_fname'].' '.$prj['Person_mname'].' '.$prj['Person_lname'], 0, 0, 'C');
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->SetFont('aefurat', 'b', 28);
        //$pdf->Cell($width, 5, 'تقديراً للإشراف على المشروع', 0, 0, 'C');
        $pdf->Cell($width, 5, ' عن مشروع', 0, 0, 'C');
        
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->Cell($width, 5, $prj['project_name'], 0, 0, 'C');
        
        if($prj['project_prize']=='01' || $prj['project_prize']=='02' || $prj['project_prize']=='03'){
            $label='الفائز';
            
            if($prj['Person_sex']=='02')
                 $label.='ة';
            $label.=' '. ' بالميدالية '. ' ';
            if($prj['project_prize']=='01')
                $label.='الذهبية';
            elseif($prj['project_prize']=='02')
                $label.='الفضية';
            elseif($prj['project_prize']=='03')
                $label.='البرونزية';
            
            $pdf->SetXY(5,$counter);
            $counter+=$pas;
            $pdf->SetFont('aefurat', 'b', 30);
            $pdf->Cell($width, 5, $label, 0, 0, 'C');
        }
        $pdf->SetFont('aefurat', 'b', 28);

        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->Cell($width, 5, 'في مباراة العلوم '.$prj['mobarat_year'], 0, 0, 'C');
        
        }
        return $pdf;
    }
    
    static public function getCertSchool($prjs,$bolShwBKG, $strBKG){
        $pdf= cls_PDF_Certification::getCommon($bolShwBKG, $strBKG);
        foreach($prjs as $prj){
            
        $pdf->AddPage();
        $pdf->SetFont('aefurat', 'b', 28);
        $counter=60;
        $pas=12;
        $width=292;
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->Cell($width, 5, 'تمنحها', 0, 0, 'C');
        $pdf->SetXY(5,$counter);
        $counter+=$pas+8;
        $pas=15;
        $pdf->SetFont('aealarabiya','' , 28);
        $pdf->Cell($width, 5, 'الهيئة الوطنية للعلوم والبحوث', 0, 0, 'C');
        
        $pdf->SetXY(5,$counter);
        $counter+=$pas;//+10;
        $pdf->SetFont('aealarabiya','' , 32);
        $strLabel='لمدير';
        if($prj['Person_sex']=='02')
           $strLabel.='ة';
        $strLabel.=' ' .$prj['school_name']. ' '.'الأستاذ';
        if($prj['Person_sex']=='02')
           $strLabel.='ة';

        $pdf->Cell($width, 5, $strLabel, 0, 0, 'C');
        
        
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        
//         if($prj['Person_sex']=='02')
//            $strLabel=' الاستاذة ';
//         else
//            $strLabel=' الاستاذ ';
        
        $strLabel=$prj['Person_fname'].' '.$prj['Person_mname'].' '.$prj['Person_lname']; 
        $pdf->Cell($width, 5, $strLabel, 0, 0, 'C');
        $pdf->SetFont('aefurat', 'b', 28);
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->SetFont('aefurat', 'b', 28);
        $pdf->Cell($width, 5, 'عن المشروع', 0, 0, 'C');
        
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->Cell($width, 5, $prj['project_name'], 0, 0, 'C');
        
         if($prj['project_prize']=='01' || $prj['project_prize']=='02' || $prj['project_prize']=='03'){
            $label='الفائز';
            
            if($prj['Person_sex']=='02')
                 $label.='ة';
            $label.=' '. ' بالميدالية '. ' ';
            if($prj['project_prize']=='01')
                $label.='الذهبية';
            elseif($prj['project_prize']=='02')
                $label.='الفضية';
            elseif($prj['project_prize']=='03')
                $label.='البرونزية';
            
            $pdf->SetXY(5,$counter);
            $counter+=$pas;
            $pdf->SetFont('aefurat', 'b', 30);
            $pdf->Cell($width, 5, $label, 0, 0, 'C');
        }
        $pdf->SetFont('aefurat', 'b', 28);
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->Cell($width, 5, 'في مباراة العلوم '.$prj['mobarat_year'], 0, 0, 'C');
        }
       
        return $pdf;
    }
  */
    
    static public function getLabel($type,$lan,$prj,$name){
        $label='';
        if($lan=='en'){
            if($name=='h1')
                $label='Awarded by the';
            elseif($name=='h2')
                $label='National Association for Science & Research';
            elseif($name=='salutation'){
                if($type=='student')
                    $label='To the Student';
                elseif($type=='teacher')
                    $label='To the Teacher';
                elseif($type=='school'){
                    $label='To the Principal of ';
                    $label.=$prj['school_ename'];
                }
            }elseif($name=='name')
                $label=$prj['person_efname'].' '.$prj['person_emname'].' '.$prj['person_elname'];
            elseif($name=='project_lable')
                $label='For the Project';
            elseif($name=='project_name')
                $label=$prj['project_name_en'];
            elseif($name=='winner'){
                $label='Winner of the ';
                if($prj['project_prize']=='01')
                    $label.='gold';
                elseif($prj['project_prize']=='02')
                    $label.='silver';
                elseif($prj['project_prize']=='03')
                    $label.='bronze';
                $label.=' Medal';
            }
            elseif($name=='footer')
                $label='In the National Competition Mobarat El’Oloum '.$prj['mobarat_year'];
        }else{
            if($name=='h1')
                $label='تمنحها';
            elseif($name=='h2')
                $label='الهيئة الوطنية للعلوم والبحوث';
            elseif($name=='salutation'){
                if($type=='student'){
                    $label='للطالب';
                    if($prj['Person_sex']=='02')
                        $label.='ة';
                }
                    
                elseif($type=='teacher'){
                    $label='للأستاذ';
                    if($prj['Person_sex']=='02')
                        $label.='ة';
                }
                    
                elseif($type=='school'){
                    $label='لمدير';
                    if($prj['Person_sex']=='02')
                        $label.='ة';
                    $label.=' ' .$prj['school_name'];
                    $label.=' '.'الأستاذ';
                    if($prj['Person_sex']=='02')
                        $label.='ة';
                }
            }elseif($name=='name')
                $label=$prj['Person_fname'].' '.$prj['Person_mname'].' '.$prj['Person_lname'];
            elseif($name=='project_lable')
                $label='عن مشروع';
            elseif($name=='project_name')
                $label=$prj['project_name'];
            elseif($name=='winner'){
                $label='الفائز';
                if($prj['Person_sex']=='02')
                     $label.='ة';
                $label.=' '. ' بالميدالية '. ' ';
                if($prj['project_prize']=='01')
                    $label.='الذهبية';
                elseif($prj['project_prize']=='02')
                    $label.='الفضية';
                elseif($prj['project_prize']=='03')
                    $label.='البرونزية';
            }
            elseif($name=='footer')
                $label='في مباراة العلوم  '.$prj['mobarat_year'];
        }
        return $label;
    }
    static public function getCert($type,$lan,$prjs,$bolShwBKG, $strBKG){
        $pdf= cls_PDF_Certification::getCommon($bolShwBKG, $strBKG);
        foreach($prjs as $prj){
        $pdf->AddPage();
        $pdf->SetFont('aefurat', 'b', 28);
        $counter=60;
        $pas=12;
        $width=292;
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $label= cls_PDF_Certification::getLabel($type, $lan, $prj, 'h1');
        $pdf->Cell($width, 5, $label, 0, 0, 'C');
       //
        $pdf->SetXY(5,$counter);
        $counter+=$pas+8;
        $pas=15;
        $pdf->SetFont('aealarabiya','' , 28);
        $label= cls_PDF_Certification::getLabel($type, $lan, $prj, 'h2');
        $pdf->Cell($width, 5, $label, 0, 0, 'C');
        
        $pdf->SetXY(5,$counter);
        $counter+=$pas;//+10;
        //return $pdf; 
        $pdf->SetFont('aefurat', 'b', 28);
        $label= cls_PDF_Certification::getLabel($type, $lan, $prj, 'salutation');
        $pdf->Cell($width, 5, $label, 0, 0, 'C');
       
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->SetFont('aealarabiya','B' , 32);
        $label= cls_PDF_Certification::getLabel($type, $lan, $prj, 'name');
        $pdf->Cell($width, 5, $label, 0, 0, 'C');
        $pdf->SetFont('aefurat', 'b', 28);
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->SetFont('aefurat', 'b', 28);
        $label= cls_PDF_Certification::getLabel($type, $lan, $prj, 'project_lable');
        $pdf->Cell($width, 5, $label, 0, 0, 'C');
        
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $label= cls_PDF_Certification::getLabel($type, $lan, $prj, 'project_name');
        $pdf->Cell($width, 5, $label, 0, 0, 'C');
        
         if($prj['project_prize']=='01' || $prj['project_prize']=='02' || $prj['project_prize']=='03'){
            $label= cls_PDF_Certification::getLabel($type, $lan, $prj, 'winner');
            $pdf->SetXY(5,$counter);
            $counter+=$pas;
            $pdf->SetFont('aealarabiya','B' , 32);
            $pdf->Cell($width, 5, $label, 0, 0, 'C');
        }
        $pdf->SetFont('aefurat', 'b', 28);
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $label= cls_PDF_Certification::getLabel($type, $lan, $prj, 'footer');
        $pdf->Cell($width, 5,$label, 0, 0, 'C');
        }
       
        return $pdf;
    }
    static public function getCertJudge($prjs,$bolShwBKG, $strBKG){
        $pdf= cls_PDF_Certification::getCommon($bolShwBKG, $strBKG);
        foreach($prjs as $prj){
            
        $pdf->AddPage();
        $pdf->SetFont('aefurat', 'b', 28);
        $counter=60;
        $pas=12;
        $width=292;
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->Cell($width, 5, 'تمنحها', 0, 0, 'C');
        $pdf->SetXY(5,$counter);
        $counter+=$pas+8;
        $pas=15;
        $pdf->SetFont('aealarabiya','' , 28);
        $pdf->Cell($width, 5, 'الهيئة الوطنية للعلوم والبحوث', 0, 0, 'C');
        $pdf->SetFont('aefurat', 'b', 28);
        $pdf->SetXY(5,$counter);
         $counter+=$pas;
         $strLabel='';
          
        /* if(!is_null($prj['salutation']))// || strlen($prj['salutation'])=0){
            $strLabel=$prj['salutation']; 
         if(strlen($strLabel)=0)
              $strLabel='الأستاذ';*/

         $strLabel=$prj['salutation']; 
         if($prj['Person_sex']=='02')
                 $strLabel.='ة';
                
        $pdf->Cell($width, 5, $strLabel, 0, 0, 'C');
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->SetFont('aealarabiya','' , 32);
        $pdf->Cell($width, 5, $prj['Person_fname'].' '.$prj['Person_mname'].' '.$prj['Person_lname'], 0, 0, 'C');
        $pdf->SetXY(5,$counter);
        $counter+=$pas;
        $pdf->SetFont('aefurat', 'b', 28);
        if($prj['Person_sex']=='02')
                 $strLabel='تقديرا لمشاركتها في هيئة التحكيم';
             else {
                 $strLabel='تقديرا لمشاركته في هيئة التحكيم';
             }
        $pdf->Cell($width, 5, $strLabel, 0, 0, 'C');
        
                
         $pdf->SetXY(5,$counter);
         $counter+=$pas;
        $pdf->Cell($width, 5, 'في فعاليات مباراة العلوم '.$prj['mobarat_year'], 0, 0, 'C');
        
        }
        return $pdf;
    }
   static public function  getCertification1($prj){
        //$pdf = new cls_PDF_background(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
       $pdf = new cls_PDF_background('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
       $pdf->bolShowBackground='true';
       //$pdf->strBackgroundName='Participation.jpg';
       $pdf->strBackgroundName='Appreciation.jpg';

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Samer Assaf');
$pdf->SetTitle('Certification');
$pdf->SetSubject('Certification');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// remove default footer
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//        $lg = Array();
//        $lg['a_meta_charset'] = 'UTF-8';
//        $lg['a_meta_dir'] = 'rtl';
//        $lg['a_meta_language'] = 'ar';
//        $lg['w_page'] = 'page';
//
//
//        $pdf->setLanguageArray($lg);
//
//
        $pdf->SetFont('dejavusans', '', 16);

        $pdf->AddPage();
//        //$pdf->setJPEGQuality(75);
//
//        //$pdf->Image(Yii::app()->theme->baseUrl.'/assets/img/logo-login.jpg', 200, 5, 25, 20, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
        $pdf->SetXY(40,5);
        $pdf->Cell(75, 5, $prj['Person_fname'].' '.$prj['Person_mname'].' '.$prj['Person_lname'], 0, 0, 'C');
        $pdf->SetXY(40,15);
        $pdf->Cell(75, 5, $prj['project_name'], 0, 0, 'C');
        $pdf->SetXY(40,25);
        $pdf->Cell(75, 5, $prj['project_type'].' \ '.$prj['project_stage'], 0, 0, 'C');
        $pdf->SetXY(40,35);
        $pdf->Cell(75, 5, $prj['school_name'], 0, 0, 'C');
// set some language-dependent strings (optional)
//if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
//	require_once(dirname(__FILE__).'/lang/eng.php');
//	$pdf->setLanguageArray($l);
//}

// ---------------------------------------------------------

//// set font
//$pdf->SetFont('times', '', 48);
//
//// add a page
//$pdf->AddPage();

// Print a text
//$html = '<span style="background-color:yellow;color:blue;">&nbsp;PAGE 1&nbsp;</span>
//<p stroke="0.2" fill="true" strokecolor="yellow" color="blue" style="font-family:dejavusans;font-weight:bold;font-size:26pt;">تجربة طباعة خلفية لشهادة المشاركة</p>';
//$pdf->writeHTML($html, true, false, true, false, '');


//// add a page
//$pdf->AddPage();
//
//// Print a text
//$html = '<span style="background-color:yellow;color:blue;">&nbsp;PAGE 2&nbsp;</span>';
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// --- example with background set on page ---
//
//// remove default header
//$pdf->setPrintHeader(false);
//
//// add a page
//$pdf->AddPage();
//
//
//// -- set new background ---
//
//// get the current page break margin
//$bMargin = $pdf->getBreakMargin();
//// get current auto-page-break mode
//$auto_page_break = $pdf->getAutoPageBreak();
//// disable auto-page-break
//$pdf->SetAutoPageBreak(false, 0);
//// set bacground image
//$img_file = K_PATH_IMAGES.'image_demo.jpg';
//$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
//// restore auto-page-break status
//$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
//// set the starting point for the page content
//$pdf->setPageMark();
//
//
//// Print a text
//$html = '<span style="color:white;text-align:center;font-weight:bold;font-size:80pt;">PAGE 3</span>';
//$pdf->writeHTML($html, true, false, true, false, '');
return $pdf;
    }
}
