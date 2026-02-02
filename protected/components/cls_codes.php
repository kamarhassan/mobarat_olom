<?php
class cls_codes{
    
     public static function getCodeKind($strfilter)
     {
        $sql='SELECT * FROM code_kind';
        if(strlen($strfilter)>0)
          $sql .=' where Description like "%'. $strfilter .'%"';
            
        $codeKind=Yii::app()->db->createCommand($sql)->queryAll();
        $list1 = CHtml::listData($codeKind, 'codekind', 'Description');
            
        return $list1;
     }
     
     public static function getCodes_ByCodeKind($intCode_Kind,$onlyEnable='false')
     {
        $sql='SELECT * FROM codes where code_kind='.$intCode_Kind ;
        if($onlyEnable)
            $sql .=' and code_enable=1';
            
            
        $codes=Yii::app()->db->createCommand($sql)->queryAll();
       // $list1 = CHtml::listData($codeKind, 'code_no', 'code_name');
            
        return $codes;
     }
     
     public static function getCodes_ByCodeKindQuery($intCode_Kind,$query)
     {
        $sql="SELECT * FROM codes where code_kind=".$intCode_Kind ." and ".$query."; " ;
       
            
        $codes=Yii::app()->db->createCommand($sql)->queryAll();
       // $list1 = CHtml::listData($codeKind, 'code_no', 'code_name');
            
        return $codes;
     }
     
     public static function getChildCodes_ByCodeKind($intCode_Kind,$code_no,$codelen)
     {
        $sql="SELECT * FROM codes where code_kind=".$intCode_Kind ." and code_no like '". $code_no ."%' and length(code_no)=" .$codelen ."; " ;
       
            
        $codes=Yii::app()->db->createCommand($sql)->queryAll();
       // $list1 = CHtml::listData($codeKind, 'code_no', 'code_name');
            
        return $codes;
     }
     
      public static function getCode_Name($intCode_Kind,$code_no)
     {
        $sql="SELECT code_name  FROM codes where code_kind=".$intCode_Kind ." and code_no = '". $code_no ."' " ;
       
            
        $codes=Yii::app()->db->createCommand($sql)->queryAll();
        if(count($codes)>0)
            return $codes[0]['code_name'];//[0]('t');//$codes[0]['code_name'];
       // $list1 = CHtml::listData($codeKind, 'code_no', 'code_name');
            
        return $code_no;
     }
     
      public static function getFullCode_Name($intCode_Kind,$code_no,$code_len)
     {
          $codeLength=strlen($code_no);
          $codeCounter=$code_len;
          $codeName='';
          while($codeCounter<=$codeLength)
          {
              if(strlen($codeName)>0)
                  $codeName .='/';
             $codeName .=cls_codes::getCode_Name($intCode_Kind , substr($code_no,0,$codeCounter));
             $codeCounter+=$code_len;
          }
            
        return $codeName;
     }
     
     
}


?>