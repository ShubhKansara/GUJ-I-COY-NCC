<?php

namespace Sebastienheyd\Boilerplate\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder as Builder;

class Users
{
    public function make(Builder $menu)
    {
        $item = $menu->add('boilerplate::users.menu_title', [
            'icon' => 'users',
            'permission' => 'users_crud',
            'order' => 1000,
            'active' => 'boilerplate.users.index,boilerplate.users.edit,boilerplate.users.create',
            'permission' => 'users_crud',
            'route' => 'boilerplate.users.index',
        ]);

        /* $item->add('boilerplate::users.menu_list_title', [
            'active' => 'boilerplate.users.index,boilerplate.users.edit',
            'permission' => 'users_crud',
            'route' => 'boilerplate.users.index',
        ]); */

        /* $item->add('boilerplate::users.create.title', [
            'permission' => 'users_crud',
            'route' => 'boilerplate.users.create',
        ]); */

        /* $item->add('boilerplate::layout.role_management', [
            'active' => 'boilerplate.roles.*',
            'permission' => 'roles_crud',
            'route' => 'boilerplate.roles.index',
        ]); */

        /* $item->add('boilerplate::users.profile.title', [
            'route' => 'boilerplate.user.profile',
        ]); */
    }
}
