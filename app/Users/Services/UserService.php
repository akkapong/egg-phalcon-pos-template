<?php
namespace Users\Services;

use Users\Repositories\UserRepositories;

class UserService extends UserRepositories
{
    //==== Start: Define variable ====//
    
    //==== End: Define variable ====//


    //==== Start: Support method ====//

    //Method for create filter for check duplicate
    protected function createFilterForCheckDup($makroId, $contentType, $contentId)
    {
        return [
            'makro_id'     => $makroId,
            'content_type' => $contentType,
            'content_id'   => $contentId,
        ];
    }

    //==== End: Support method ====//


    //==== Stat: Main method ====//
    //Method for get data by filter
    public function getUser($params)
    {
        //Define output
        $outputs = [
            'success' => true,
            'message' => '',
        ];

        try {
            //create filter
            $users         = $this->getDataByParams($params);

            if (isset($params['limit'])) {
                //get total record
                $outputs['total'] = $coupons[1];
            }

            $outputs['data'] = $users[0];

        } catch (\Exception $e) {
            $outputs['success'] = false;
            $outputs['message'] = 'missionFail';
        }
        

        return $outputs;
    }

    //Method for get data by id
    public function getUserDetail($id)
    {
        //Define output
        $outputs = [
            'success' => true,
            'message' => '',
        ];

        try {
            //create filter
            $user  = $this->getDataById($id);

            if (empty($user)){
                $outputs['success'] = false;
                $outputs['message'] = 'dataNotFound';
                return $outputs;
            }

            $outputs['data'] = $user;

        } catch (\Exception $e) {
            $outputs['success'] = false;
            $outputs['message'] = 'missionFail';
        }
        

        return $outputs;
    }


    //Method for insert data
    public function manageUser($params)
    {
        //Define output
        $output = [
            'success' => true,
            'message' => '',
            'data'    => '',
        ];

        //Check Duplicate
        $filters = $this->createFilterForCheckDup($params['makro_id'], $params['content_type'], $params['content_id']);
        $isDups  = $this->checkDuplicate($filters);
        
        if (!$isDups[0])
        {
            //insert
            $res = $this->insertData($params);

            if (!$res)
            {
                //Cannot insert
                $output['success'] = false;
                $output['message'] = 'insertError';
                return $output;
            } 
        }
        else
        {
            //update
            $res = $this->updateData($isDups[1], $params);

            if (!$res)
            {
                //Cannot insert
                $output['success'] = false;
                $output['message'] = 'updateError';
                return $output;
            }
        }

        
        //add config data
        $output['data'] = $res;

        return $output;
    }


    //Method for delete data
    public function deleteUser($id)
    {
        //Define output
        $output = [
            'success' => true,
            'message' => '',
            'data'    => '',
        ];

        //get data by id
        $user  = $this->getDataById($id);

        if (empty($user))
        {
            //No Data
            $output['success'] = false;
            $output['message'] = 'dataNotFound';
            return $output;
        }

        //delete
        $res = $this->deleteData($user);

        if (!$res)
        {
            //Cannot insert
            $output['success'] = false;
            $output['message'] = 'deleteError';
            return $output;
        }

        //get insert id
        $output['data'] = $res;

        return $output;
    }
    //==== End: Main method ====//
}