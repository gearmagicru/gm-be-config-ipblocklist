<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Backend\Config\IpBlockList\Model;

use Gm;
use Gm\Panel\Data\Model\GridModel;

/**
 * Модель данных списка заблокированных IP-адресов.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Backend\Config\IpBlockList\Model
 * @since 1.0
 */
class Grid extends GridModel
{
    /**
     * @var string
     */
    protected string $timeout = '';

    /**
     * {@inheritdoc}
     */
    public function getDataManagerConfig(): array
    {
        return [
            'tableName' => '{{ip_blocklist}}',
            'primaryKey' => 'id',
            'fields'     => [
                ['address'], // IPv4 или IPv6-адрес
                ['attempts'], // количество попыток
                ['attempt'], // количество оставшихся попыток
                ['timeout'], // время окончания блокировки
                ['note'], // причина добавления в список
            ],
            'order' => [
                'id' => 'ASC'
            ],
            'resetIncrements' => ['{{ip_blocklist}}']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        parent::init();

        $this
            ->on(self::EVENT_AFTER_DELETE, function ($someRecords, $result, $message) {
                // всплывающие сообщение
                $this->response()
                    ->meta
                        ->cmdPopupMsg($message['message'], $message['title'], $message['type']);
                /** @var \Gm\Panel\Controller\GridController $controller */
                $controller = $this->controller();
                // обновить список
                $controller->cmdReloadGrid();
            })
            ->on(self::EVENT_AFTER_SET_FILTER, function ($filter) {
                /** @var \Gm\Panel\Controller\GridController $controller */
                $controller = $this->controller();
                // обновить список
                $controller->cmdReloadGrid();
            });
    }

    /**
     * {@inheritdoc}
     */
    public function beforeFetchRows(): void
    {
        $this->timeout = gmdate('U');
    }

    /**
     * {@inheritdoc}
     */
    public function prepareRow(array &$row): void
    {
        if (!empty($row['timeout'])) {
            // IP-адрес заблокирован
            $row['lock'] = $this->timeout < $row['timeout'] ? 1 : 0;
            // тайм-аут
            $row['timeout'] = Gm::$app->formatter->toDateTime($row['timeout'], 'php:Y-m-d H:i:s');
        } else
            $row['lock'] = 0;
    }
}
