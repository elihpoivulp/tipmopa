<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Notification extends BaseConfig
{
    public array $categories;
    public array $categories_style;

    public function __construct()
    {
        parent::__construct();
        $this->categories = ['reservation-new', 'reservation-created', 'reservation-accepted', 'reservation-fulfilled'];
        $this->categories_style = array_combine($this->categories, [
            [
                'text-info',
                'inbox'
            ],
            [
                'text-warning',
                'inbox'
            ],
            [
                'text-success',
                'hand-thumbs-up-fill'
            ],
            [
                'text-success',
                'patch-check-fill'
            ],
        ]);
    }
}
