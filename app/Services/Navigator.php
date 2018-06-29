<?php namespace App\Services;

use App\Interfaces\Services\Navigation;

/**
 * Service to work with navigation items
 * @package App\Services
 */
class Navigator implements Navigation
{

    /**
     * @var array
     */
    private $items = [];

    /**
     * Register items
     *
     * @param string $group
     * @param string $item
     * @param string $link
     *
     * @return Navigation
     */
    public function register(string $group, string $item, string $link): Navigation
    {
        if (!isset($this->items[$group])) {
            $this->items[$group] = [];
        }
        $this->items[$group][] = [
            'label' => $item,
            'link'  => $link,
        ];

        return $this;
    }

    /**
     * Get all items
     *
     * @return array
     */
    public function get(): array
    {
        return $this->items;
    }
}