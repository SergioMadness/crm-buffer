<?php namespace App\Traits;

use App\Interfaces\EventData;

/**
 * Trait for objects can handle events
 * @package App\Traits
 */
trait HandleEvents
{
    /**
     * Callbacks
     *
     * @var array
     */
    private static $listeners = [];

    /**
     * Add callback
     *
     * @param string   $event
     * @param callable $callBack
     */
    public static function on(string $event, callable $callBack): void
    {
        self::$listeners[$event][] = $callBack;
    }

    /**
     * Fire event
     *
     * @param string    $event
     * @param EventData $eventObject
     */
    public function fire(string $event, EventData $eventObject): void
    {
        if (isset(self::$listeners[$event])) {
            foreach (self::$listeners[$event] as $callback) {
                $callback($eventObject, $this);
            }
        }
    }
}