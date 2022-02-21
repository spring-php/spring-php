<?php
/**
 * SpringPHP file.
 * @author linyushan  <1107012776@qq.com>
 * @link https://www.developzhe.com/
 * @package https://github.com/1107012776/spring-php
 * @license https://github.com/1107012776/spring-php/blob/main/LICENSE
 */
namespace SpringPHP\Core;
class SpringContext
{
    /**
     * @var SpringContext
     */
    public static $app;
    protected $config;

    public static function init($config)
    {
        if (empty(static::$app)) {
            static::$app = new static($config);
        }
        return static::$app;
    }

    public function merge($config)
    {
        $this->config = array_merge($this->config, $config);
    }

    public static function resetConfig()
    {
        $localConfigPath = SPRINGPHP_ROOT . "/App/Config/Config-Local.php";
        if (file_exists($localConfigPath)) {
            $config = include($localConfigPath);
        } else {
            $config = [];
        }
        \SpringPHP\Core\SpringContext::init($config);
        $configPath = SPRINGPHP_ROOT . "/App/Config/Config.php";
        $config = include($configPath);
        \SpringPHP\Core\SpringContext::$app->merge($config);
        //加载路由配置
        $localRouteConfigPath = SPRINGPHP_ROOT . "/App/Config/Route.php";
        if (file_exists($localRouteConfigPath)) {
            $routeConfig = include($localRouteConfigPath);
        } else {
            $routeConfig = [];
        }
        \SpringPHP\Core\SpringContext::$app->merge([
            'router' => $routeConfig
        ]);
    }

    protected function __construct($config)
    {
        $this->config = $config;
    }

    public function getConfig($key = '', $default = '')
    {
        if (strpos($key, '.') === false) {
            if (!empty($key)) {
                return isset($this->config[$key]) ? $this->config[$key] : $default;
            }
            return $this->config;
        }
        $keys = explode('.', $key);
        $config = $this->config;
        $count = count($keys);
        foreach ($keys as $i => $k) {
            if (!isset($config[$k])) {
                return $default;
            } else {
                if ($i == $count - 1) {
                    return $config[$k];
                }
                $config = $config[$k];
            }
        }
        return $default;
    }

    public static function config($key, $default = '')
    {
        return \SpringPHP\Core\SpringContext::$app->getConfig($key, $default);
    }
}