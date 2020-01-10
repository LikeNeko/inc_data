<?php
namespace app\service\inc_data;

use app\common\model\Config;

class MoneyData implements DataInterface {
    /**
     * 获得基础值
     *
     * @return int
     */
    public function getData(): string
    {
        return Config::getConfigValue('money_inc_data_base',0);
    }

    public function setTodayData($num)
    {
        Config::setConfig('money_inc_data',$num);
    }

    public function getTodayData():int
    {
        return (int)Config::getConfigValue('money_inc_data',100);
    }

    public function getLastUpTime():int
    {
        return Config::getConfigValue('money_last_up_time',0);
    }

    public function setLastUpTime()
    {
        Config::setConfig('money_last_up_time',time());
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
        Config::setConfig('money_inc_data_base',$num);
    }
}
