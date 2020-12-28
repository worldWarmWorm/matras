<?php
namespace common\components;

/**
 * Компонент "Событие"
 * 
 */
class Event
{
    use \common\traits\Singleton;
   
    /**
     * Список зарегистированных событий
     * вида [eventName=>callable[]]
     * @var array
     */
    private $events=[];
    
    /**
     * Добавить обработчик события
     * @param string $name имя события
     * @param callable $handler обработчик события
     * @param integer|null $index индекс порядка вызова добавляемого 
     * обработчика события. По умолчанию (NULL) обработчик события 
     * будет добавлен в конец очереди. 
     */
    public function attachEventHandler($name, $handler, $index=null)
    {
        if(!isset($this->events[$name])) {
            $this->events[$name]=new \CList;
        }
        
        if($index === null) {
            $this->events[$name]->add($handler);
        }
        else {
            $this->events[$name]->insertAt($index, $handler);
        }
    }
    
    /**
     * Запуск события
     * Если обработчик события возвращает строгое false,
     * дальнейшие обработчики не запускаются.
     * @param string $name имя события
     * @param \CEvent &$event объект события
     */
    public function raiseEvent($name, \CEvent &$event)
    {
        if(isset($this->events[$name])) {
            foreach($this->events[$name] as $handler) {
				if(call_user_func_array($handler, [&$event]) === false) {
                    break;
                }
            }
        }
    }
}
