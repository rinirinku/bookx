<?php
namespace User\Model;


interface  IGenericModel 
{
    public function setUp ($id);
   
    public function getById ($id);
    
    public function getAll ();
    
    public function setAll ($dataList);
    
}

?>