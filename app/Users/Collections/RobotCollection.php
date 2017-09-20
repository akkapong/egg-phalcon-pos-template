<?php

namespace Users\Collections;

use Phalcon\Mvc\MongoCollection;

class RobotCollection extends MongoCollection
{
    public $type;
    public $name;
    public $year;

    public function getSource()
    {
        return 'robots';
    }
}