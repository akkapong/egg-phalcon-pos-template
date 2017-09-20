<?php

namespace Users\Collections;

use Phalcon\Mvc\MongoCollection;

class UserCollection extends MongoCollection
{
    public $makro_id;
    public $content_type;
    public $content_id;
    public $firstname;
    public $lastname;
    public $type_id;
    public $type_detail;
    public $store_id;

    public function getSource()
    {
        return 'users';
    }
}