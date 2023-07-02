<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;

class Institutes
{
    public function make(Builder $menu)
    {
        $menu->add('Institutes', [
            'route' => 'boilerplate.institutes.index',
            'active' => 'boilerplate.institutes.*',
            'permission' => 'backend',
            'icon' => 'fas fa-university',
            'order' => 100,
        ]);
    }
}
