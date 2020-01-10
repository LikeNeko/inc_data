<?php

namespace app\service\inc_data;

class NkIncData
{
    /**
     * @var DataInterface
     */
    private $data;
    private $base = 86400;// 1天的秒数

    /**
     * @var bool 是否逗号分隔 false 不分割
     */
    private $is_comma = false;
    private $func;

    public function __construct(DataInterface $data)
    {
        $this->data = $data;
    }

    /**
     * @param DataInterface $data
     *
     * @return NkIncData
     */
    public function setData(DataInterface $data): NkIncData
    {
        $this->data = $data;
        return $this;
    }

    /**
     * 是否逗号分隔
     *
     * @param bool $is
     *
     * @return $this
     */
    public function comma($is = true):NkIncData
    {
        $this->is_comma = $is;
        return $this;
    }

    /**
     * 自定义输出
     *
     * @param \Closure $win
     *
     * @return NkIncData
     */
    public function format(\Closure $win):NkIncData
    {
        $this->func['format'] = $win;
        return $this;
    }

    private function NumToStr($num){
        if (stripos($num,'e')===false) return $num;
        $num = trim(preg_replace('/[=\'"]/','',$num,1),'"');//出现科学计数法，还原成字符串
        $result = "";
        while ($num > 0){
            $v = $num - floor($num / 10)*10;
            $num = floor($num / 10);
            $result   =   $v . $result;
        }
        return $result;
    }

    public function get()
    {
        $num         = round($this->data->getTodayData() / $this->base);
        $base_num    = $this->data->getData();
        $last_time   = $this->data->getLastUpTime();
        $middle_time = time() - $last_time;

        $base_num += $middle_time * $num;

        $base_num = $this->NumToStr($base_num);

        if ($middle_time >= 30) {

            $this->data->setLastUpTime();
            $this->data->setData($base_num);
        }
        if ($this->is_comma){
            $base_num = number_format($base_num);
        }else{
            if ($this->func != null){
                $base_num = $this->func['format']($base_num);
                if ($base_num == null){
                    throw new \Error('回调未返回');
                }
            }
        }
        return $base_num;
    }

}
