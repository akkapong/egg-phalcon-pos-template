<?php
namespace Users\Controllers;

use Core\Controllers\ControllerBase;

use Users\Schemas\UserSchema;
use Users\Collections\UserCollection;
use Users\Services\UserService;


/**
 * Display the default index page.
 */
class UserController extends ControllerBase
{
    //==== Start: Define variable ====//
    private $module = 'users';
    private $userService;
    private $modelName;
    private $schemaName;

    private $getDetailRule = [
        [
            'type'   => 'required',
            'fields' => ['id'],
        ]
    ];

    private $createRule = [
        [
            'type'   => 'required',
            'fields' => ['username', 'ref_type', 'ref_id'],
        ],
    ];

    private $deleteRule = [
        [
            'type'   => 'required',
            'fields' => ['id'],
        ],
    ];
    //==== End: Define variable ====//

    //==== Start: Support method ====//
    //Method for initial some variable
    public function initialize()
    {
        $this->userService = new UserService();
        $this->modelName   = UserCollection::class;
        $this->schemaName  = UserSchema::class;
    }

    //==== End: Support method ====//

    //==== Start: Main method ====//
    public function getUserAction()
    {
        //get input
        $params = $this->getUrlParams();

        $limit  = (isset($params['limit']))?$params['limit']:null;
        $offset = (isset($params['offset']))?$params['offset']:null;

        //validate input
        //TODO: add validate here

        //get data in service
        $result = $this->userService->getUser($params, $limit, $offset);

        if (!$result['success']) {
            //process error
            return $this->responseError($result['message'], '/users');
        }

        // print_r(count($result['data'])); exit;

        //return data
        $encoder = $this->createEncoder($this->modelName, $this->schemaName);

        //get total
        $total  = (isset($result['total']))?$result['total']:null;

        return $this->response($encoder, $result['data'], $limit, $offset, $total);

        
    }

    public function getUserdetailAction($id)
    {
        //get data in service
        $result = $this->userService->getUserDetail($id);

        if (!$result['success']) {
            //process error
            return $this->responseError($result['message'], '/users/'.$id);
        }

        //return data
        $encoder = $this->createEncoder($this->modelName, $this->schemaName);

        return $this->response($encoder, $result['data']);

        
    }

    public function postUserAction()
    {
        //get input
        $params = $this->getPostInput();

        //validate input
        //TODO: add validate here


        //define default
        $default = [];

        // Validate input
        $params = $this->myValidate->validateApi($this->createRule, $default, $params);

        if (isset($params['validate_error'])) {
            //Validate error
            return $this->responseError($params['validate_error'], '/users');
        }

        //add member data by input
        $result = $this->userService->manageUser($params);

        //Check response error
        if (!$result['success'])
        {
            //process error
            return $this->responseError($result['message'], '/users');
        }

        //return data
        $encoder = $this->createEncoder($this->modelName, $this->schemaName);

        return $this->response($encoder, $result['data']);
    }

    public function deleteUserAction($id)
    {
        //update member data
        $result  = $this->userService->deleteUser($id);

        //Check response error
        if (!$result['success'])
        {
            //process error
            return $this->responseError($result['message'], '/users');
        }

        //return data
        $encoder = $this->createEncoder($this->modelName, $this->schemaName);

        return $this->response($encoder, $result['data']);
    }
    //==== End: Main method ====//
}
