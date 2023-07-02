<?php

//namespace Sebastienheyd\Boilerplate\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder as Builder;

class Test
{
    public function make(Builder $menu)
    {
        $item = $menu->add('boilerplate::chatbotquestions.title', [
            'icon' => 'question-circle',
            'order' => 1001,
        ]);

        $item->add('boilerplate::chatbotquestions.list.title', [
            'active' => 'boilerplate.chatbots-questions.index,boilerplate.chatbots-questions.edit',
            'route' => 'boilerplate.chatbots-questions.index',
        ]);

        $item->add('boilerplate::chatbotquestions.create.title', [
            'active' => 'boilerplate.chatbots-questions.create',
            'route' => 'boilerplate.chatbots-questions.create',
        ]);

    }
}
