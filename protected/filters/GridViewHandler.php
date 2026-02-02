<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GridViewHandler
 *
 * @author Samer
 */
class GridViewHandler extends CFilter {
 
    protected function preFilter($filterChain){
        if (Yii::app()->request->getIsAjaxRequest() && isset($_GET["ajax"])) {
            $selectedTable = $_GET["ajax"];
            $method='_getGridView'.$selectedTable;
            if(method_exists($filterChain->controller,$method)){
                $filterChain->controller->$method();
                Yii::app()->end();
            }else{
                throw new CHttpException(400,"CGridView handler function {$method} not defined in controller ".get_class($filterChain->controller));
            }
        }
        return true;
    }
}
