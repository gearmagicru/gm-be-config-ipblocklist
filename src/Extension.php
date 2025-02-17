<?php
/**
 * Расширение модуля веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Backend\Config\IpBlockList;

/**
 * Расширение "Список заблокированных IP-адресов".
 * 
 * IP-адреса пользователей, которые проходят проверку или во время проверки были 
 * заблокированы.
 * 
 * Расширение принадлежит модулю "Конфигурация".
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Backend\Config\IpBlockList
 * @since 1.0
 */
class Extension extends \Gm\Panel\Extension\Extension
{
    /**
     * {@inheritdoc}
     */
    public string $id = 'gm.be.config.ipblocklist';

    /**
     * {@inheritdoc}
     */
    public string $defaultController = 'grid';
}