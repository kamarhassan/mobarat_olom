<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlaceCode
 *
 * @author Samer
 */
class PlaceCode extends CFormModel{
    //put your code here
    public $mohafaza;
    public $kadaa;
    public $place;
    
     public function rules() {
        return array(
            array('mohafaza, kadaa, place', 'safe'),
        );
    }
}
