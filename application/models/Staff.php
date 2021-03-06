<?php

/**
 * Class StaffModel
 */
class StaffModel extends \BaseModel
{

    /**
     * Get staff list
     *
     * @param $paramList
     * @return array
     */
    public function getStaffList($paramList)
    {
        do {
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['name'] ? $params['name'] = $paramList['name'] : false;
            if ($paramList['limit']) {
                $this->setPageParam($params, $paramList['page'], $paramList['limit']);
            }
            $result = $this->rpcClient->getResultRaw('SF001', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * @param array $paramList
     * @return array
     */
    public function resetPin(array $paramList) : array {
        $params = array();
        !empty($paramList['token']) ? $params['token'] = $paramList['token'] : $this->throwException('请重新登录', 1);
        $paramList['user_id'] > 0 ? $params['userid'] = $paramList['user_id'] : false;
        $result = $this->rpcClient->getResultRaw('SF002', $params);
        return (array)$result;
    }

    public function updateStaffSchedule($paramList) {
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            if (intval($paramList['id']) <= 0) {
                break;
            }
            if (is_null($paramList['schedule']) && is_null($paramList['washing'])) {
                break;
            }
            $params = array();
            $params['id'] = intval($paramList['id']);
            !is_null($paramList['schedule']) ? $params['schedule'] = trim($paramList['schedule']) : false;
            !is_null($paramList['washing_push']) ? $params['washing_push'] = intval($paramList['washing_push']) : false;
            $result = $this->rpcClient->getResultRaw('SF003', $params);

        } while (false);
        return $result;
    }

    public function updateStaffPermission($paramList)
    {
        try {
            $params['permission'] = $paramList['permission'];
            $paramList['id'] ? $params['id'] = intval($paramList['id']) : $this->throwException("Lack param[id]", 1);
            $result = $this->rpcClient->getResultRaw('SF003', $params);
        } catch (Exception $e) {
            $result = array(
                'code' => $e->getCode(),
                'msg' => $e->getMessage()
            );
        }
        return $result;
    }


    public function getStaffAdministratorList($cacheTime = 0): array
    {
        do {
            $params = array();
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('SF004', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }
}
