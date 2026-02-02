<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cls_Paginator
 *
 * @author Samer
 */
//include('../yii-1.1.16.bca042/framework/web/helpers/CHtml.php');
class cls_Paginator {
    //put your code here
    // private $_conn;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;
    public $_params;
    private $_url;
    private $_update;
    
    public function __construct(  $countQuery,$selectQuery,$params,$url,$update ) {
     
        $this->_url=$url;
        $this->_update=$update;
        $this->_query = $selectQuery;
        $this->_total = Yii::app()->getDB()->createCommand($countQuery)->queryScalar();
        $this->_params=$params;
    }
    
    public function getParams($page){
        $para=array();
        
        foreach($this->_params as $key=>$data) {
            if ($key != 'page') {
                
                   $para[$key]= $data; 
            }
        }
        $para['page']=$page;
        return $para;
        
    }
    
    public function summary(){
        if($this->_limit=='all')
            $to=$this->_total;
        else
            {
            $to=( $this->_page - 1 ) * $this->_limit + $this->_limit ;
            $to=($to>$this->_total)?$this->_total:$to;
        }
       
        $str='From ' . (( $this->_page - 1 ) * $this->_limit +1)
                . ' To ' .  $to
                .' Of ' . $this->_total;
        return $str;
        
    }
    
    public function getLink($page,$label){
        //$btn=CHtml::button($page, array('class' => 'list_small','Empty'=>''));
        $t=time();
        $btn=CHtml::button($label, array('class' => 'list_small',"style" => ($this->_page==$page)?"background: gray":"",'Empty'=>'','id'=>'__pg'.$t.$page,'name'=>'__pg'.$t.$page,
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => $this->_url,//CController::createAbsoluteUrl('Personstudent/OldStudent'),
                                    'data'=>$this->getParams($page),
                                    'cache'=>'true',
                                    //'update' => '#level2',
                                    'success'=>'function(data) {$("#'.$this->_update.'").html(data); }',
                                )));
        return $btn;
    }
    
    public function getData( $limit = 10, $page = 1 ) {
     
        $this->_limit   = $limit;
        $this->_page    = $page;

        if ( $this->_limit == 'all' ) {
            $query      = $this->_query;
        } else {
            $query      = $this->_query . " LIMIT ". $this->_limit. " OFFSET " . ( ( $this->_page - 1 ) * $this->_limit ) ;
        }
        //$rs             = $this->_conn->query( $query );
        //return $query;
        $rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        //return $rs;
/*
        while ( $row = $rs->fetch_assoc() ) {
            $results[]  = $row;
        }
*/
        $result         = new stdClass();
        $result->page   = $this->_page;
        $result->limit  = $this->_limit;
        $result->total  = $this->_total;
        $result->data   = $rs;

        return $result;
    }
    

    public function createLinks( $links, $list_class ) {
        
        //return $this->getLink(3);return;
        if ( $this->_limit == 'all' ) {
            return '';
        }

        $last       = ceil( $this->_total / $this->_limit );

       /* $start      = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
        $end        = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;*/
        
        $start      = ( ( $this->_page - 2 ) > 0 ) ? $this->_page - 2 : 1;
        $end        = ( ( $start + $links ) < $last ) ? $start + $links : $last;
        
        if(($end-$start+1)<$links)
            $start=$start-($links-($end-$start));
        if($start<=0)
            $start=1;

        $html       = '<ul class="' . $list_class . '">';

       // $class      = ( $this->_page == 1 ) ? "disabled" : "";
        //$html       .= '<li class="' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . ( $this->_page - 1 ) . '">&laquo;</a></li>';
      //  $html       .= '<li class="' . $class . '">' . $this->getLink($this->_page - 1,'>>')  . '</li>';

        /*if ( $start > 1 ) {
            //$html   .= '<li><a href="?limit=' . $this->_limit . '&page=1">1</a></li>';
            $html   .= '<li>' . $this->getLink(1,1)  . '</li>';
            $html   .= '<li class="disabled"><span>...</span></li>';
        }*/

        for ( $i = $start ; $i <= $end; $i++ ) {
            $class  = ( $this->_page == $i ) ? "active" : "";
            //$html   .= '<li class="' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . $i . '">' . $i . '</a></li>';
          // $this->getParams($i);
            $html   .= '<li class="' . $class . '">' . $this->getLink($i,$i)  . '</li>';
        }
/*
        if ( $end < $last ) {
            $html   .= '<li class="disabled"><span>...</span></li>';
            //$html   .= '<li><a href="?limit=' . $this->_limit . '&page=' . $last . '">' . $last . '</a></li>';
            $html   .= '<li>' . $this->getLink($end+1,'<<')  . '</li>';
        }*/

        //$class      = ( $this->_page == $last ) ? "disabled" : "";
        //$html       .= '<li class="' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . ( $this->_page + 1 ) . '">&raquo;</a></li>';
        //$html       .= '<li class="' . $class . '">' . $this->getLink($this->_page + 1,'<<')  . '</li>';
        $html       .= '</ul>';

        return $html;
    }
}
