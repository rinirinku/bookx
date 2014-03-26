<?php
namespace User\Model;
use User\Model\Entity\UserEntity;

use Zend\Db\TableGateway\AbstractTableGateway, Zend\Db\Adapter\Adapter;

use User\Model\IGenericModel;
use User\Model\Data\UserInfo;
use Zend\Db\Sql\Select;

/**
 * UserModel
 *
 * @author experion
 * @version
 *
 *
 */
class UserModel extends AbstractTableGateway implements IGenericModel
{

    private $tableName = 'user';

    private $columnList = array(
            'userid' => 'id',
            'empcode',
            'email',
            'name',
            'password'
    );

    private $userEntity;
    
    private $extension ="@experionglobal.com";
    
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        //$this->initialize();
       
    }
    /*
     * (non-PHPdoc) @see \User\Model\IGenericModel::setUp()
     */
    public function setUp ($id=NULL)
    {
        $this->userEntity = new UserEntity($id);
        $this->userEntity->setTable($this->tableName);
        $this->userEntity->setColumn($this->columnList);
        return $this->userEntity;
    }
    
       
    
    /*
     * (non-PHPdoc) @see \User\Model\IGenericModel::getById()
     */
    public function getById ($id)
    {
        $userInfo = $this->setUp($id);
        $select = new Select();
        $select->from(array(
                'usertable' => $userInfo->getTable()
        ))
            ->columns($userInfo->getColoumns())
            ->where("id=" . $userInfo->getId());
        $statement = $this->adapter->createStatement();
        // you can check your query by echo-ing :
        // echo $select->getSqlString();die;
        $select->prepareStatement($this->adapter, $statement);
        return $this->setUserObj($userInfo, $statement->execute()
            ->current());
    }
    
    /*
     * (non-PHPdoc) @see \User\Model\IGenericModel::getAll()
     */
    public function getAll ()
    {
        // TODO Auto-generated method stub
    }
    
    /*
     * (non-PHPdoc) @see \User\Model\IGenericModel::setAll()
     */
    public function setAll ($dataList)
    {
        // TODO Auto-generated method stub
    }
    
    public function setUserObj ($userInfo, $result)
    {
        $userInfo->setId($result['id'])
                   ->setUserName($result['username'])
                   ->setEmpCode[$result['empcode']]
                   ->setPassword[$result['password']];
        return $userInfo;
    }
    
   
    
    public function  isValidUser($userentity)
    {
        $userInfo= $this->setup();
        $select = new Select();
        $select->from(array(
                'usertable' => $userInfo->getTable()
        ))
        ->columns(array('id'))
        ->where('username="' . $userentity->getUserName().$this->extension.'"AND password ="'.$userentity->getPassword().'"');
        $statement = $this->adapter->createStatement();
        // you can check your query by echo-ing :
      /// echo $select->getSqlString();die;
        $select->prepareStatement($this->adapter, $statement);
        if($statement->execute()->current()){
            return true;
        }
        else{
            return false;
        }
        
        
        
    }
}