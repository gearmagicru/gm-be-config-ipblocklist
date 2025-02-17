<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * Файл конфигурации Карты SQL-запросов.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

return [
    'drop'   => ['{{ip_blocklist}}'],
    'create' => [
        '{{ip_blocklist}}' => function () {
            return "CREATE TABLE `{{ip_blocklist}}` (
                `id` int(11) unsigned NOT NULL DEFAULT '0',
                `module_id` int(11) unsigned DEFAULT NULL,
                `address` varchar(15) DEFAULT NULL,
                `attempt` smallint(5) unsigned DEFAULT '0',
                `attempts` smallint(5) unsigned DEFAULT '0',
                `timeout` int(11) unsigned DEFAULT NULL,
                `note` varchar(255) DEFAULT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE={engine} 
            DEFAULT CHARSET={charset} COLLATE {collate}";
        }
    ],

    'run' => [
        'install'   => ['drop', 'create'],
        'uninstall' => ['drop']
    ]
];