<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cls_toCSV
 *
 * @author Samerٍٍ
 */
class cls_toCSV {
    //put your code here
    
    private static function addFooter($objPHPExcel,$filename){
        $objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit();
    }
    
    private static function addTable($objPHPExcel,$lable,$records,&$r,&$c){
        foreach($lable as $l){
            $objPHPExcel->getActiveSheet()
                    ->setCellValueByColumnAndRow($c,$r, $l);
            $c+=1;
        }
        $r+=1;
        foreach($records as $rec){
            $c=0;
            foreach($rec as $l){
                $objPHPExcel->getActiveSheet()
                    ->setCellValueByColumnAndRow($c,$r, $l);
                $c+=1;
            }
            $r+=1;
        } 
    }
    
    public static function exportJudgeProjectToCSV($filename,$judge,$lable,$records,$grades){
        if(count($records)==0){
            echo 'لا يوجد نتيجة';
            return;
        }
     
        $objPHPExcel = new PHPExcel();
        $styleArray = array(
            'borders' => array(
                    'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => 'FF000000'),
                    ),
            ),
        );

        $objPHPExcel->getProperties()->setCreator("Sciencelb");
        $objPHPExcel->setActiveSheetIndex(0);
        $r=1;
        $c=0;
        
        foreach($judge as $rec){
            $c=0;
            foreach($rec as $l){
                $objPHPExcel->getActiveSheet()
                    ->setCellValueByColumnAndRow($c,$r, $l);
                $c+=1;
            }
            $r+=1;
        }
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.PHPExcel_Cell::stringFromColumnIndex($c-1).($r-1))->applyFromArray($styleArray);
        
        $r+=2;
        $c=0;
        cls_toCSV::addTable($objPHPExcel, $lable, $records, $r, $c);
         $objPHPExcel->getActiveSheet()->getStyle('A4:'.PHPExcel_Cell::stringFromColumnIndex($c+4).($r-1))->applyFromArray($styleArray);
 
        cls_toCSV::addFooter($objPHPExcel,$filename);
    }
    public static function exportToCSV($filename,$lable,$records){
      /*  header('Content-Encoding: Windows-1252');
        header('Content-Type: text/csv; charset=Windows-1252');
        header('Content-Description: File Transfer');
        //header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$filename);
        header('Content-Transfer-Encoding: binary');
        header('Connection: Keep-Alive');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        //header('Content-Length: ' . strlen('sdfsd'));
       
        $fp=fopen('php://output','w');
        fputs ($fp, "\xEF\xBB\xBF");
         fputcsv ($fp, $lable,';');
        foreach($records as $r)
            fputcsv ($fp, $r,';');
        fclose($fp);
        

        exit();*/
        
     //require_once dirname(__FILE__) . '\PHPExcel\Cell.php';
    // echo 'asdasd';return;
    if(count($records)==0){
        echo 'لا يوجد نتيجة';
        return;
    }
     
    $objPHPExcel = new PHPExcel();
    $styleArray = array(
        'borders' => array(
                'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => 'FF000000'),
                ),
        ),
    );
    

// Set document properties
$objPHPExcel->getProperties()->setCreator("Sciencelb");
							


       
        $objPHPExcel->setActiveSheetIndex(0);
       
        //$objPHPExcel->getActiveSheet()->setTitle(substr($row['dawra_name'],0,12));//substr($row['dawra_name'],0,12));
        
         
       
        
        $r=1;
        $c=0;
        cls_toCSV::addTable($objPHPExcel, $lable, $records, $r, $c);
//        foreach($lable as $l){
//            $objPHPExcel->getActiveSheet()
//                    ->setCellValueByColumnAndRow($c,$r, $l);
//            $c+=1;
//        }
//        $r+=1;
//        foreach($records as $rec){
//            $c=0;
//            foreach($rec as $l){
//                $objPHPExcel->getActiveSheet()
//                    ->setCellValueByColumnAndRow($c,$r, $l);
//                $c+=1;
//            }
//            $r+=1;
//        }
        
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.PHPExcel_Cell::stringFromColumnIndex($c-1).($r-1))->applyFromArray($styleArray);
 
        cls_toCSV::addFooter($objPHPExcel,$filename);
// Set active sheet index to the first sheet, so Excel opens this as the first sheet


//$objPHPExcel->setActiveSheetIndex(0);
//// Redirect output to a client’s web browser (Excel2007)
//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//header('Content-Disposition: attachment;filename="'.$filename.'"');
//header('Cache-Control: max-age=0');
//// If you're serving to IE 9, then the following may be needed
//header('Cache-Control: max-age=1');
//
//// If you're serving to IE over SSL, then the following may be needed
//header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
//header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
//header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
//header ('Pragma: public'); // HTTP/1.0
//
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save('php://output');
//exit();
    }
    
    
    
    public static function exportResultToCSV($filename,$year,$lable,$col,$records,$pr_type,$pr_stg){
      /*  header('Content-Encoding: Windows-1252');
        header('Content-Type: text/csv; charset=Windows-1252');
        header('Content-Description: File Transfer');
        //header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$filename);
        header('Content-Transfer-Encoding: binary');
        header('Connection: Keep-Alive');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        //header('Content-Length: ' . strlen('sdfsd'));
       
        $fp=fopen('php://output','w');
        fputs ($fp, "\xEF\xBB\xBF");
         fputcsv ($fp, $lable,';');
        foreach($records as $r)
            fputcsv ($fp, $r,';');
        fclose($fp);
        

        exit();*/
        
     //require_once dirname(__FILE__) . '\PHPExcel\Cell.php';
    // echo 'asdasd';return;
    if(count($records)==0){
        echo 'لا يوجد نتيجة';
        return;
    }
     
    $objPHPExcel = new PHPExcel();
    $styleArray = array(
        'borders' => array(
                'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => 'FF000000'),
                ),
        ),
    );
    
    $styleArray2 = array(
        'borders' => array(
                'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_DOUBLE,
                        'color' => array('argb' => 'FF000000'),
                ),
        ),
    );
    

// Set document properties
$objPHPExcel->getProperties()->setCreator("Sciencelb");
							


       
        $objPHPExcel->setActiveSheetIndex(0);
       
        //$objPHPExcel->getActiveSheet()->setTitle(substr($row['dawra_name'],0,12));//substr($row['dawra_name'],0,12));
        
        $type=0;
        $stage=0;
        $sht=0;
        $cold=array(12.13,8.13,28.13,26.13,26.13,26.13,16.5);
        
        $sheet=$objPHPExcel->getActiveSheet();
        
        for($type=0;$type<count($pr_type);$type++){
            for($stage=0;$stage<count($pr_stg);$stage++){
                $objWorkSheet=$objPHPExcel->createSheet($sht);
                $objWorkSheet->setRightToLeft(true);
                $r=1;
                $c=0;
                  foreach($cold as $w){
                    $objWorkSheet->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($c))->setWidth($w);
                    $c+=1;
                }
                $c=0;
                $objWorkSheet->mergeCells('A'.$r.':G'.$r);
                $objWorkSheet->setCellValueByColumnAndRow($c,$r, 'مباراة العلوم '.$year);
                $objWorkSheet->getStyle('A'.$r)->getFont()->setBold(true)->setName('andalus')->setUnderline(true)->setSize(25)->getColor()->setRGB('DE0000');
                
                $r+=1;
                $objWorkSheet->mergeCells('A'.$r.':G'.$r);
                $objWorkSheet->setCellValueByColumnAndRow($c,$r, 'بيروت - الاونيسكو');
                $objWorkSheet->getStyle('A'.$r)->getFont()->setBold(true)->setName('Times New Roman')->setSize(22)->getColor()->setRGB('6F0000');
                $r+=1;
                 $objWorkSheet->mergeCells('A'.$r.':G'.$r);
                $objWorkSheet->setCellValueByColumnAndRow($c,$r, 'فئة: '.$pr_type[$type]['code_name'].' - المرحلة: '.$pr_stg[$stage]['code_name']);
                $objWorkSheet->getStyle('A'.$r)->getFont()->setBold(true)->setName('Times New Roman')->setSize(18)->getColor()->setRGB('320000');
                $objWorkSheet->getStyle('A1:A3')->getAlignment()->applyFromArray(array('horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
                $r+=3;
               
                foreach($lable as $l){
                    $objWorkSheet->setCellValueByColumnAndRow($c,$r, $l);
                    $c+=1;
                }
                $objWorkSheet->getStyle('A'.$r.':'.PHPExcel_Cell::stringFromColumnIndex($c-1).($r))->getFont()->setBold(true)->setName('Times New Roman')->setSize(13)->getColor()->setRGB('000000');
                $objWorkSheet->getStyle('A'.$r.':'.PHPExcel_Cell::stringFromColumnIndex($c-1).($r))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F3E5EB');
                $r+=1;
                foreach($records as $rec){
                    if($rec['project_type']==$pr_type[$type]['code_no']  && $rec['project_stage']==$pr_stg[$stage]['code_no']){
                        $c=0;
                        foreach($col as $l){
                            $objWorkSheet->setCellValueByColumnAndRow($c,$r, $rec[$l]);
                            $c+=1;
                        }
                        $objWorkSheet->getStyle('A'.$r.':'.PHPExcel_Cell::stringFromColumnIndex($c-1).($r))->getFont()->setBold(true)->setName('Times New Roman')->setSize(11)->getColor()->setRGB('000000');
                        $objWorkSheet->getRowDimension($r)->setRowHeight(35);
                        $r+=1;   
                    }
                    
                }
               
                $strTitle=$pr_stg[$stage]['code_name'].'-'.$pr_type[$type]['code_name'];
                //$strTitle=$pr_stg[$stage]['code_no'].'-'.$pr_type[$type]['code_no'];
                //$strTitle="$sht";
                $objWorkSheet->setTitle("$strTitle");
                $sht+=1;
                
                $objWorkSheet->getStyle('A6:'.PHPExcel_Cell::stringFromColumnIndex($c-1).($r-1))->applyFromArray($styleArray);
                $objWorkSheet->getStyle('A6:'.PHPExcel_Cell::stringFromColumnIndex($c-1).($r-1))->getAlignment()->setWrapText(true);
                $objWorkSheet->getStyle('A6:'.PHPExcel_Cell::stringFromColumnIndex($c-1).($r-1))->getAlignment()->applyFromArray(array('vertical'=> PHPExcel_Style_Alignment::VERTICAL_CENTER));
                
                $r+=2;
                $c=0;
                $objWorkSheet->setCellValueByColumnAndRow($c,$r, ' ملاحظات خاصة بالادارة');
                $objWorkSheet->getStyle('A'.$r)->getFont()->setName('Times New Roman')->setSize(14)->getColor()->setRGB('320000');
                $r+=1;
                $objWorkSheet->mergeCells('A'.$r.':G'.($r+7));
                $objWorkSheet->getStyle('A'.$r.':G'.($r+7))->applyFromArray($styleArray2);
                $r+=8;
                $objWorkSheet->setCellValueByColumnAndRow($c,$r, 'امضاء المسؤول عن االمباراة ');
                $objWorkSheet->getStyle('A'.$r)->getFont()->setBold(true)->setName('Times New Roman')->setSize(14)->getColor()->setRGB('000000');
                
            }
        }
       
        /*
        $r=1;
        $c=0;
        foreach($lable as $l){
            $objPHPExcel->getActiveSheet()
                    ->setCellValueByColumnAndRow($c,$r, $l);
            $c+=1;
        }
        $r+=1;
        foreach($records as $rec){
            $c=0;
            foreach($rec as $l){
                $objPHPExcel->getActiveSheet()
                    ->setCellValueByColumnAndRow($c,$r, $l);
                $c+=1;
            }
            $r+=1;
        }*/
        
        //$objPHPExcel->getActiveSheet()->getStyle('A1:'.PHPExcel_Cell::stringFromColumnIndex($c-1).($r-1))->applyFromArray($styleArray);
 
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet


$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit();
    }
}
