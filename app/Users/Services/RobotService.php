<?php

namespace Users\Services;

class RobotService extends \Phalcon\Mvc\Micro
{
    // protected function getCollection()
    // {
    //     return new \Users\Collections\RobotCollection();
    // }

    public function create()
    {
        $robot = $this->collections->getCollections("RobotCollection");

        $robot->type = 'mechanical';
        $robot->name = 'Astro Boy';
        $robot->year = 1952;

        if ($robot->save() === false) {
            echo "Umh, We can't store robots right now: \n";

            $messages = $robot->getMessages();

            foreach ($messages as $message) {
                echo $message, "\n";
            }
        } else {
            echo 'Great, a new robot was saved successfully!';
        }
    }
}