<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * Пакет русской локализации.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

return [
    '{name}'        => 'Список заблокированных IP-адресов',
    '{description}' => 'IP-адреса пользователей которые проходят проверку или во время проверки были заблокированы',
    '{permissions}' => [
        'any'  => ['Полный доступ', 'Настройка списка заблокированных IP-адресов']
    ],

    // Grid: столбцы
    'IP address' => 'IP-адрес',
    'Attempt' => 'Попыток',
    'The number of attempts left to block the IP address' => 'Количество попыток оставшихся до блокировки IP-адреса',
    'Timeout' => 'Тайм-аут',
    'Time until which the user\'s address will be blocked' => 'Время до которого будет заблокирован IP-адрес пользователя',
    'Note' => 'Причина',
    'Reason for adding an IP address to the list' => 'Причина добавления IP-адреса в список',
    'IP address blocked' => 'IP-адрес заблокирован',
    'left {attempt} of {attempts}' => 'осталось <b>{attempt}</b> из {attempts}',
    // Grid: сообщения
    'yes' => 'да',
    'no' => 'нет'
];
