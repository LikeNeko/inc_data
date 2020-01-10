<?php
namespace app\service\inc_data;

use app\common\model\Config;

class Data implements DataInterface {
    /**
     * 获得基础值
     *
     * @return string
     */
    public function getData(): string
    {
        return  Config::getConfigValue('inc_data_base',0);
    }

    public function setTodayData($num)
    {
        Config::setConfig('inc_data',$num);
    }

    public function getTodayData():int
    {
        return (int)Config::getConfigValue('inc_data',100);
    }

    public function getLastUpTime():int
    {
        return Config::getConfigValue('last_up_time',0);
    }

    public function setLastUpTime()
    {
        Config::setConfig('last_up_time',time());
    }

    /**
     * 设置当前值
     *
     * @param $num
     *
     * @return mixed
     */
    public function setData($num)
    {
        Config::setConfig('inc_data_base',$num);
    }
}
