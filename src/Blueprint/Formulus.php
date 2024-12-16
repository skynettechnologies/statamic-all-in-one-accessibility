<?php

namespace Skynettechnologies\AllInOneAccessibility\Blueprint;

use Statamic\Facades\Blueprint;
use Statamic\Fields\Blueprint as FieldsBlueprint;

class Formulus
{
    public static function getBlueprint(): FieldsBlueprint
    {

        return Blueprint::makeFromTabs([
            'main' => [
                'display' => 'Main',
                'fields' => [
                    'title' => [
                        'type' => 'text',
                        'display' => 'All in One Accessibility®',
                    ],
                    'content' => [
                        'type' => 'textarea',
                        'display' => 'Content',
                    ],
                    'iframe_url' => [
                        'type' => 'text',
                        'display' => 'IFrame URL',
                    ],
                    
                ],
            ],
        ]);
    }
}
