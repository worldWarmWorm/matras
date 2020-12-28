<?php
/**
 * Класс-помощник событий
 * 
 */
namespace common\components\helpers;

use common\components\helpers\HArray as A;
use common\components\Event;

class HEvent
{
    /**
     * Получить компонент события
     * @param \CComponent|null $component объект компонента.
     * По умолчанию (NULL) будет возвращен объект компонента 
     * \common\components\Event::i()
     * @return \CComponent|\common\components\Event
     */
    public static function getComponent($component=null)
    {
        if($component === null) {
            $component=Event::i();
        }
        return $component;
    }
    
    /**
     * Регистрация событий из конфигурации
     * @param array $config конфигурация событий, вида 
     * [eventName=>(array)eventHandlers] или [eventName=>callable]
     * @param \CComponent|null $component объект компонента, для которого 
     * будут зарегистрированы события. По умолчанию (NULL), будет использован
     * объект компонента \common\components\Event::i() 
     */
    public static function registerByConfig($config, $component=null)
    {
        foreach($config as $name=>$handlers) {
            $handlers=A::toa($handlers);
            foreach($handlers as $handler) {
                static::register($name, $handler, null, $component);
            }
        }
    }
    
    /**
     * Регистрация события
     * @param string $name имя события
     * @param callable $handler обработчик события
     * @param integer|null $index индекс порядка применения события.
     * По умолчанию (NULL) обработчик события будет добавлен в конец очереди.
     * Акутально только для компонента \common\components\Event. 
     * @param \CComponent|null $component объект компонента.
     * По умолчанию (NULL) будет возвращен объект компонента 
     * \common\components\Event::i()
     */
    public static function register($name, $handler, $index=null, $component=null)
    {
        static::getComponent($component)->attachEventHandler($name, $handler, $index);
    }
    
    /**
     * Запуск события
     * @param string $name имя события
     * @param array $params параметры для обработчиков события
     * @param \CComponent|null $component объект компонента для
     * которого будет инициализирован вызов событий. 
     * По умолчанию (NULL) будет возвращен объект компонента 
     * \common\components\Event::i()
     * @return \CEvent
     */
    public static function raise($name, $params=[], $component=null)
    {
        $event=new \CEvent;
        $event->params=$params;
        
        static::getComponent($component)->raiseEvent($name, $event);
        
        return $event;
    }
}
