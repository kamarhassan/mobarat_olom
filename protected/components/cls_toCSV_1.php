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
    public static function exportToCSV($filename,$lable,$records){
        header('Content-Encoding: Windows-1252');
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
        

        exit();

    }
}
