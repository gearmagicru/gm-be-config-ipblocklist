<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Backend\Config\IpBlockList\Controller;

use Gm;
use Gm\Panel\Helper\ExtGrid;
use Gm\Panel\Helper\HtmlGrid;
use Gm\Mvc\Module\BaseModule;
use Gm\Panel\Widget\TabGrid;
use Gm\Panel\Controller\GridController;
use Gm\Panel\Helper\HtmlNavigator as HtmlNav;

/**
 * Контроллер списка заблокированных IP-адресов.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Backend\Config\IpBlockList\Controller
 * @since 1.0
 */
class Grid extends GridController
{
    /**
     * {@inheritdoc}
     * 
     * @var BaseModule|\Gm\Backend\Config\IpBlockList\Extension
     */
    public BaseModule $module;

    /**
     * {@inheritdoc}
     */
    public function createWidget(): TabGrid
    {
        /** @var TabGrid $tab Сетка данных (Gm.view.grid.Grid GmJS) */
        $tab = parent::createWidget();

        // столбцы (Gm.view.grid.Grid.columns GmJS)
        $formats = Gm::$app->formatter->formatsWithoutPrefix();
        $tab->grid->columns = [
            ExtGrid::columnNumberer(),
            [
                'text'      => ExtGrid::columnInfoIcon($this->t('IP address')),
                'dataIndex' => 'address',
                'cellTip'   => HtmlGrid::tags([
                    HtmlGrid::header('{address}'),
                    HtmlGrid::fieldLabel($this->t('Attempt'), $this->t('left {attempt} of {attempts}')),
                    HtmlGrid::tplIf(
                        'timeout',
                        HtmlGrid::fieldLabel($this->t('Timeout'), '{timeout:date("' . $formats['dateTimeFormat'] . '")}'),
                        ''
                    ),
                    HtmlGrid::tplIf(
                        'note',
                        HtmlGrid::fieldLabel($this->t('Note'), '{note}'),
                        ''
                    ),
                    HtmlGrid::fieldLabel(
                        $this->t('IP address blocked'),
                        HtmlGrid::tplChecked('lock')
                    )
                ]),
                'filter'    => ['type' => 'string'],
                'sortable'  => true,
                'width'     => 150
            ],
            [
                'xtype'     => 'templatecolumn',
                'text'      => '#Attempt',
                'tooltip'   => '#The number of attempts left to block the IP address',
                'dataIndex' => 'attempt',
                'cellTip'   => '{attempt}',
                'tpl'       => '#left {attempt} of {attempts}',
                'filter'    => ['type' => 'number'],
                'sortable'  => true,
                'width'     => 130
            ],
            [
                'xtype'     => 'datecolumn',
                'text'      => '#Timeout',
                'tooltip'   => '#Time until which the user\'s address will be blocked',
                'dataIndex' => 'timeout',
                'format'    => $formats['dateTimeFormat'],
                'filter'    => ['type' => 'date', 'dateFormat' => 'Y-m-d'],
                'width'     => 145
            ],
            [
                'text'      => '#Note',
                'tooltip'   => '#Reason for adding an IP address to the list',
                'dataIndex' => 'note',
                'cellTip'   => '{note}',
                'filter'    => ['type' => 'string'],
                'sortable'  => true,
                'width'     => 150
            ]
        ];

        // панель инструментов (Gm.view.grid.Grid.tbar GmJS)
        $tab->grid->tbar = [
            'padding' => 1,
            'items'   => ExtGrid::buttonGroups([
                'edit'    => ['items' => ['delete', 'cleanup', 'separator', 'select', 'separator', 'refresh']],
                'columns' => ['items' => ['profiling', 'columns']],
                'search'
            ], [
                'route' => $this->module->route()
            ])
        ];

        // контекстное меню записи (Gm.view.grid.Grid.popupMenu GmJS)
        $tab->grid->popupMenu = [];

        // 2-й клик по строке сетки
        $tab->grid->rowDblClickConfig = [
            'allow' => false
        ];
        // количество строк в сетке
        $tab->grid->store->pageSize = 50;
        // поле аудита записи
        $tab->grid->logField = 'address';
        // плагины сетки
        $tab->grid->plugins = 'gridfilters';
        // класс CSS применяемый к элементу body сетки
        $tab->grid->bodyCls = 'g-grid_background';

        // панель навигации (Gm.view.navigator.Info GmJS)
        $tab->navigator->info['tpl'] = HtmlNav::tags([
            HtmlNav::header('{address}'),
            HtmlNav::fieldLabel($this->t('Attempt'), $this->t('left {attempt} of {attempts}')),
            HtmlNav::tplIf(
                'timeout',
                HtmlNav::fieldLabel($this->t('Timeout'), '{timeout:date("' . $formats['dateTimeFormat'] . '")}'),
                ''
            ),
            HtmlNav::tplIf(
                'note',
                HtmlNav::fieldLabel($this->t('Note'), '{note}'),
                ''
            )
        ]);

        $tab->addCss('/grid.css');
        return $tab;
    }
}
