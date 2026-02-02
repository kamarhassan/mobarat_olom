<?php


abstract class enm_Program{
    const TEACHER=0;
    const STUDENT=1;
    const PERSON=2;
    const PROJECT=3;
    const SCHOLARSHIP_ID=4;
    const SCHOLARSHIP_GRADE=5;
    
    static public function getName($enmProgram)
    {
        switch($enmProgram)
        {
            case enm_Program::TEACHER:
                    return 'TEACHER';
            case enm_Program::STUDENT:
                    return 'STUDENT';   
            case enm_Program::PERSON:
                    return 'PERSON';
            case enm_Program::PROJECT:
                    return 'PROJECT';
            case enm_Program::SCHOLARSHIP_ID:
                    return 'SCHOLARSHIP_ID';
            case enm_Program::SCHOLARSHIP_GRADE:
                    return 'SCHOLARSHIP_GRADE';
                
        }
        return '';
    }
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cls_attach
 *
 * @author Samer
 */
class cls_attach {
    const PICTURE_UNKNOWN = 'PERSON/Picture/null.jpg';
    const DATA_Directory='Data';
    const Picture_Size=1024;//524288;
    const MY_PATH_SEPARATOR='/';
    //put your code here
    
    public static function getPicturePath($enmProgram,$id,$ext)
    {
        //$strPath=getDirectory(enm_Program::getName($enmProgram).cls_attach::MY_PATH_SEPARATOR.'Picture'.cls_attach::MY_PATH_SEPARATOR.$id) ;
        /*$tempID=($id%100) +1;
        $strPath=enm_Program::getName($enmProgram).cls_attach::MY_PATH_SEPARATOR.'Picture'.cls_attach::MY_PATH_SEPARATOR.$tempID;
        $strPath=cls_attach::getDirectory($strPath);
        $strPath=$strPath.cls_attach::MY_PATH_SEPARATOR.$id.'.'.$ext;*/
        //$strPath=$strPath->getExtensionName();
        //return $strPath;
        
        return getPicturePathWithOutExt($enmProgram,$id).'.'.$ext;
    }
    
     public static function getPicturePathWithOutExt($enmProgram,$id)
    {
        //$strPath=getDirectory(enm_Program::getName($enmProgram).cls_attach::MY_PATH_SEPARATOR.'Picture'.cls_attach::MY_PATH_SEPARATOR.$id) ;
        $tempID=($id%100) +1;
        $strPath=enm_Program::getName($enmProgram).cls_attach::MY_PATH_SEPARATOR.'Picture'.cls_attach::MY_PATH_SEPARATOR.$tempID;
        $strPath=cls_attach::getDirectory($strPath);
        $strPath=$strPath.cls_attach::MY_PATH_SEPARATOR.$id;
        //$strPath=$strPath->getExtensionName();
        return $strPath;
    }
    
    public static function getRelatedFolder($enmProgram,$id)
    {
        //$strPath=getDirectory(enm_Program::getName($enmProgram).cls_attach::MY_PATH_SEPARATOR.'Picture'.cls_attach::MY_PATH_SEPARATOR.$id) ;
        $tempID=($id%100) +1;
        $strPath=enm_Program::getName($enmProgram).cls_attach::MY_PATH_SEPARATOR.$tempID.cls_attach::MY_PATH_SEPARATOR.$id.cls_attach::MY_PATH_SEPARATOR;
        $strPath=cls_attach::getDirectory($strPath);
        //$strPath=$strPath.cls_attach::MY_PATH_SEPARATOR.$id;
        //$strPath=$strPath->getExtensionName();
        return $strPath;
    }
    
    public static function getRelativeFolder($enmProgram,$id)
    {
        $tempID=($id%100) +1;
        $strPath=enm_Program::getName($enmProgram).cls_attach::MY_PATH_SEPARATOR.$tempID.cls_attach::MY_PATH_SEPARATOR.$id.cls_attach::MY_PATH_SEPARATOR;
        return $strPath;
    }
    public static function getRelatedFolderURL($enmProgram,$id)
    {
        //$strPath=getDirectory(enm_Program::getName($enmProgram).cls_attach::MY_PATH_SEPARATOR.'Picture'.cls_attach::MY_PATH_SEPARATOR.$id) ;
        //$tempID=($id%100) +1;
        //$strPath=enm_Program::getName($enmProgram).cls_attach::MY_PATH_SEPARATOR.$tempID.cls_attach::MY_PATH_SEPARATOR.$id.cls_attach::MY_PATH_SEPARATOR;
        $strPath=cls_attach::getRelativeFolder($enmProgram,$id);
        $strPath=Yii::app()->baseUrl.cls_attach::MY_PATH_SEPARATOR."Data".cls_attach::MY_PATH_SEPARATOR.$strPath;
        //$strPath=$strPath.cls_attach::MY_PATH_SEPARATOR.$id;
        //$strPath=$strPath->getExtensionName();
        return $strPath;
    }
    
    public static function getAbsoluteFolderPath($enmProgram,$id)
    {
        $strPath=cls_attach::getRelativeFolder($enmProgram,$id);
        $strPath=Yii::getPathOfAlias('webroot').cls_attach::MY_PATH_SEPARATOR."Data".cls_attach::MY_PATH_SEPARATOR.$strPath;
        return $strPath;
    }
    
    public static function getDirectory($strDir)
    {
        $dirs=explode(cls_attach::MY_PATH_SEPARATOR, $strDir);
        $dir=Yii::getPathOfAlias('webroot').cls_attach::MY_PATH_SEPARATOR.cls_attach::DATA_Directory;
        foreach( $dirs as $dircount)
        {
            $dir=$dir.cls_attach::MY_PATH_SEPARATOR.$dircount;
             if (!is_dir($dir))
                 mkdir($dir);  
        }
        return $dir;
       
    }
    
    public static function getEmptyPictureURL($enmProgram)
    {
        return Yii::app()->getBaseUrl(true).cls_attach::MY_PATH_SEPARATOR.cls_attach::DATA_Directory.cls_attach::MY_PATH_SEPARATOR.cls_attach::PICTURE_UNKNOWN;
    }
    public static function getPictureURL($enmProgram,$id,$fileName,&$bolExists)
    {
        //$strPath=getDirectory(enm_Program::getName($enmProgram).cls_attach::MY_PATH_SEPARATOR.'Picture'.cls_attach::MY_PATH_SEPARATOR.$id) ;
        $bolExists=true;
        $strPath='';
        if(!is_null($fileName))
        {
            $tempID=($id%100) +1;
            $strPath=enm_Program::getName($enmProgram).cls_attach::MY_PATH_SEPARATOR.'Picture'.cls_attach::MY_PATH_SEPARATOR.$tempID;
            
            $strFullPath=cls_attach::getDirectory($strPath);
            $strFullPath=$strFullPath.cls_attach::MY_PATH_SEPARATOR.$fileName;
            if(!is_file($strFullPath))
               $bolExists=false;
            else
               $strPath=$strPath.cls_attach::MY_PATH_SEPARATOR.$fileName;
        }
        else
            $bolExists=false;
        
        if(!$bolExists)
            $strPath=cls_attach::PICTURE_UNKNOWN;
        
        $strPath=Yii::app()->getBaseUrl(true).cls_attach::MY_PATH_SEPARATOR.cls_attach::DATA_Directory.cls_attach::MY_PATH_SEPARATOR.$strPath;
        
        //$strPath=$strPath->getExtensionName();
        return $strPath;
    }
    
    public static function validateAndUploadFiledUploadFile($model,$image,$FILES,$strCtrFileName,$strFieldName,$strSaveToPathWithoutExt,$strSaveToFileWithOutExt,$bolPictue=false,$bolRequired=false,$bolTestForSize=false,$intSizeKB=  cls_attach::Picture_Size)
    {
        $uploadOk = 1;
        
        //if (isset($image) && count($image) > 0) {
        if (isset($image) ) {
            //$clsAttch=new cls_attach();
            if($bolPictue==true)
            {
                $check = getimagesize($FILES[$strCtrFileName]["tmp_name"]);
                if($check == false) {
                    $model->addError($strFieldName, 'اللف المدرج ليس بصورة');
                    $uploadOk = 0;
                }
            }
            
            if ($uploadOk && $bolTestForSize && $_FILES[$strCtrFileName]["size"] > ($intSizeKB*1024)) {
                $model->addError($strFieldName, 'حجم الصورة يجب ان يكون أقل من '. $intSizeKB . ' kb');
                $uploadOk = 0;
            }

            if($uploadOk){
                $ext = pathinfo($image, PATHINFO_EXTENSION);
                $strImgPath=$strSaveToPathWithoutExt.'.'.$ext;//cls_attach::getPicturePath(enm_Program::TEACHER, $model->teacher_id, $ext);
                move_uploaded_file($image->tempName,$strImgPath); 
                $model[$strFieldName]=$strSaveToFileWithOutExt.'.'.$ext;
            }
        }
        else{
            if($bolRequired && is_null($model[$strFieldName])){
                $model->addError($strFieldName, 'يجب إدراج صورة');
                $uploadOk = 0;
            }
        }
        return $uploadOk;
    }
}
