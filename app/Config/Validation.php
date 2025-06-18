<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    public array $aliases = [
        'required'    => 'Поле обязательно для заполнения',
        'min_length'  => 'Минимальная длина поля: {param} символов',
        'valid_email' => 'Некорректный формат email',
        'is_unique'   => 'Это значение уже используется',
        'matches'     => 'Поля не совпадают',
    ];
}