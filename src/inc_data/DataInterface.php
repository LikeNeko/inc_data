<?php

namespace app\service\inc_data;
interface DataInterface {
    /**
     * 获得值
     *
     * @return string
     */
    public function getData():string ;

    /**
     * 设置当前值
     *
     * @param $num
     *
     * @return mixed
     */
    public function setData($num);

    /**
     * 获得日增长值
     *
     * @return int
     */
    public function getTodayData():int ;

    /**
     * 设置日增长值
     *
     * @param int $num
     *
     * @return mixed
     */
    public function setTodayData(int $num) ;

    /**
     * 获得最后更新时间
     *
     * @return int
     */
    public function getLastUpTime():int;

    /**
     * 设置最后更新时间
     *
     * @return mixed
     */
    public function setLastUpTime();
}
