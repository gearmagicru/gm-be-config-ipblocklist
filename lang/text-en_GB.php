<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * Пакет английской (британской) локализации.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

return [
    '{name}'        => 'IP Blocklist',
    '{description}' => 'IP addresses of users who are being verified or were blocked during verification',
    '{permissions}' => [
        'any'  => ['Full access', 'Configuring IP Blocklist']
    ],

    // Grid: столбцы
    'IP address' => 'IP address',
    'Attempt' => 'Attempt',
    'The number of attempts left to block the IP address' => 'The number of attempts left to block the IP address',
    'Timeout' => 'Timeout',
    'Time until which the user\'s address will be blocked' => 'Time until which the user\'s address will be blocked',
    'Note' => 'Note',
    'Reason for adding an IP address to the list' => 'Reason for adding an IP address to the list',
    'IP address blocked' => 'IP address blocked',
    'left {attempt} of {attempts}' => 'left <b>{attempt}</b> of {attempts}',
    // Grid: сообщения
    'yes' => 'yes',
    'no' => 'no'
];
