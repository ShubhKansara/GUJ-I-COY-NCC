<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;

class Candidates
{
    public function make(Builder $menu)
    {
        $menu->add('candidates', [
            'route' => 'boilerplate.candidate.index',
            'active' => 'boilerplate.candidate.*',
            'permission' => 'backend',
            'icon' => 'fas fa-users',
            'order' => 100,
        ]);
    }
}
