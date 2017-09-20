<?php
namespace Users\Repositories;

use Core\Repositories\CollectionRepositories;
use Users\Collections\UserCollection;

class UserRepositories extends CollectionRepositories {


    //==== Start: Define variable ====//
    public $module         = 'users';
    public $collectionName = 'UserCollection';
    public $allowFilter    = ['makro_id', 'content_type', 'content_id', 'firstname', 'lastname', 'type_id', 'type_detail', 'store_id'];
    public $model;
    //==== Start: Define variable ====//


    //==== Start: Support method ====//
    public function __construct()
    {
        $this->model = new UserCollection();
        parent::__construct();
    }
    //==== End: Support method ====//
}