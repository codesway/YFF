<?php
namespace YFF\Framework\Core;

class Timer{

    private $_prefix = 'Timer_';
    private $_timers = [];
    private $_start = 0;
    
    public function __construct () {

    }
    /** 记录开始时间
     * @param String $key 标记
     */
    public function start($key){
        $flag = $this->getKey($key);
        $this->_timers[$flag]['start'] = $this->getNow();
    }

    /** 记录结束时间
     * @param String $key 标记
     */
    public function end($key){
        $flag = $this->getKey($key);
        $this->_timers[$flag]['end'] = $this->getNow();
    }

    public function getAllTimer($stop = false) {
        if ($stop) {
            foreach ($this->_timers as &$timer) {
                if (empty($timer['end'])) {
                    $timer['end'] = $this->getNow();
                }
            }
        }
        return $this->_timers;
    }

    private function getNow() {
        return microtime(true);
    }

    /** 计算运行时间
     * @param String $key 标记
     * @return float
     */
    public function getRunTime($key){
        $flag = $this->getKey($key);
        return number_format($this->_timers[$flag]['end'] - $this->_timers[$flag]['start'], 4);
    }

    /** 输出页面运行时间
     * @param String $key 标记
     * @return String
     */
    public function printTime($key=''){
        printf("%srun time %f ms\r\n", $key==''? $key : $key.' ', $this->getTime($key)*1000);
    }

    /** 获取key
     * @param String $key 标记
     * @return String
     */
    private function getKey($key){
        return $this->_prefix.$key;
    }

    public function getAllTimers() {
      return $this->_timers;
    }

    public function __destruct(){

    }
} // class end
?>
