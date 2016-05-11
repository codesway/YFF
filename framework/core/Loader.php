<?php
namespace YFF\Framework\Core;
class Loader {

    private static $loader;
    private $dirs = [];
    private $namespace = [];
    private $classMap = [];

    public static function init() {
        if (self::$loader == NULL) {
            self::$loader = new self ();
        }
        return self::$loader;
    }

    private function __construct() {
        // self::setPath(self::$_YYF_ROOT);
        // spl_autoload_register ( array ($this, 'register') );
    }

    /**
    * return array(
    *  'NoahBuscher\\Macaw\\' => array($vendorDir . '/noahbuscher/macaw'),
    * );
    */
    public function registerNamespaces(array $namespace) {
      $this->namespace = array_unique(array_merge($this->namespace, $namespace));
      return $this;
    }

    /**
    * return array(
    * 'className' => 'xxx/xxx.php',
    * );
    */
    public function registerClassMap(array $class) {
      $this->classMap = array_unique(array_merge($this->classMap, $namespace));
      return $this;
    }

    /**
    * return array(
    *  'Monolog' => array($vendorDir . '/monolog/monolog/src'),
    * );
    */
    public function registerDirs (array $dirs) {
      $this->dirs = array_unique(array_merge($this->dirs, $namespace));
      return $this;
    }

    public function register () {
      spl_autoload_register([$this, 'load']);
    }

    private function load($class){
        if ($file = $this->findFile($class)) {
            include $file;
            return true;
        }
    }

    private function findFile($class) {
      if ('\\' == $class[0]) {
        $class = substr($class, 1);
      }

      if (!empty($this->classMap[$class])){
        return $this->classMap[$class];
      }
      $file = '';

      if(!empty($this->namespace)) {
        if (strpos($class, '\\')) {
          $parse = $this->parseFileInfo($class);
          foreach ($this->namespace as $name=>$path) {
            if ($parse['namespace'] == $name && file_exists($path . $parse['class'] . EXT)) {
              $file = $path . $parse['class'] . EXT;
              break;
            }
          }
        } else {
          foreach ($this->namespace as $name=>$path) {
            if (file_exists($path . $class . EXT)) {
              $file = $path . $class . EXT;
              break;
            }
          }
        }
        // throw new \Exception('YFF.Loader:' . $class . ' not exist');
      }

      return $file;
    }

    private function parseFileInfo($namespace) {
      return [
        'namespace' => substr($namespace, 0, strrpos($namespace, '\\')),
        'class' => substr($namespace, strrpos($namespace, '\\') + 1),
      ];
    }

}
