<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Menu;

class MenuService
{
    private $entity_manager;

    public function __construct($entity_manager)
    {
        $this->entity_manager = $entity_manager;
    }

    /**
     * Returns existing menus.
     */
    public function getMenus(): array
    {
        return $this->entity_manager->findAll(Menu::class);
    }

}
