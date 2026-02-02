<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cls_Desig
 *
 * @author Samerٍٍ
 */
class cls_Designer {
    //put your code here
    public static function FillParameter($url,$current,$clsPer){
        
            $url=str_replace('[@currentyear]', $current['mobarat_year'], $url );
            $url=str_replace('[@personID]', $clsPer->person_id, $url );
      
     
        $url=str_replace('[@nextYear]', ($current['mobarat_year']+1), $url );
        //$str=str_replace('[@currentyear]', $current['mobarat_year'], $url );
        //$str=str_replace('[@personID]', $clsPer['person_id'] , $str);
        return $url;
    }
    public static function getPageLink($contr,$pg,$current,$clsPer){
        $strLink='<div class="'.$pg['pg_color'].'">
            <div class="visual">
                <i class="'.$pg['pg_icon'].'"></i>
            </div>
            <div class="details">
                <div class="number">
                    '.cls_Designer::FillParameter($pg['pg_number'],$current,$clsPer).'
                </div>
                <div class="desc">
                    '.cls_Designer::FillParameter($pg['pg_desc'],$current,$clsPer).'
                </div>
            </div>

            <a class="more" href="'. $contr->createAbsoluteUrl(cls_Designer::FillParameter($pg['pg_url'],$current,$clsPer)).'">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>';
        return $strLink;
    }
    
    public static function getPagesLink($contr,$pgs,$current,$clsPer,$pagePerRow,$iterationNo=0,$prefix='',&$initial=0,&$row=''){
        //$counter=$initial;
        $strLinks='';
        //$row='';
        foreach($pgs as $pg){
            if(substr($pg['pg_code_no'],0, strlen($prefix))===$prefix  && strlen($pg['pg_code_no'])==(2 + strlen($prefix))){
                if($pg['pg_ispage']==1){
                    $row.='<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">'.cls_Designer::getPageLink($contr, $pg,$current,$clsPer).'</div>';
                    $initial+=1;
                    if($initial==$pagePerRow){
                        $strLinks.='<div class="row">'.$row.'</div>';
                        $row='';
                        $initial=0;
                    }
                }else{
                    
                    $strLinks.=cls_Designer::getPagesLink($contr, $pgs,$current,$clsPer, $pagePerRow,$iterationNo+1, $pg['pg_code_no'], $initial, $row);
                }    
            }
            
        }
        if($iterationNo==0){
            $strLinks.='<div class="row">'.$row.'</div>';
        }
        return $strLinks;
    }
}
