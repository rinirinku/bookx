<?php
namespace User\Model\Entity;


/**
 *
 * @author experion
 *        
 */
abstract class Entity 
{

    protected  $id;

    protected $tableName;

    protected $dataList = array();

    protected $columnList = array();
    
    protected $isactive;

    public function __construct ($id = NULL)
    {
        if ($id) {
            $this->setId($id);
        }
    }

    /**
     * @return int
     \*/
    public function setId ($id)
    {
        
        $this->id = (!empty($id)) ? $id : null;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * 
     *
     */
    public function getId ()
    {
        
        return $this->id;
    }
    /**
     * (non-PHPdoc)
     *
     *
     *
     */
    public function setActive ($isactive)
    {
    
        $this->isactive = (!empty($isactive)) ? $isactive : 0;
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     *
     *
     *
     */
    public function getActive ()
    {
    
        return $this->isactive;
        
    }

    /**
     * (non-PHPdoc)
     *
     * 
     *
     */
    public function setTable ($tableName)
    {
        
        $this->tableName = (!empty($tableName)) ? $tableName : null;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * 
     *
     */
    public function getTable ()
    {
        
        return $this->tableName;
    }

    /**
     * (non-PHPdoc)
     *
     * 
     *
     */
    public function setColumn ($columnList)
    {
        
        $this->columnList = (!empty($columnList)) ? $columnList : null;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * 
     *
     */
    public function getColumn ()
    {
        
        return $this->columnList;
    }

    /**
     * (non-PHPdoc)
     *
     * 
     *
     */
    public function setValue ($index, $value)
    {
        
        $this->dataList[$index] = $value;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * 
     *
     */
    public function getValue ()
    {
        
        return $this->dataList;
    }
}

?>