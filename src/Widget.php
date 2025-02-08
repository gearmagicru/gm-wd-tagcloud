<?php
/**
 * Виджет веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Widget\TagCloud;

use Gm;
use Closure;
use Gm\View\WidgetResourceTrait;

/**
 * Виджет "Облако тегов" предназначен для отображения тегов в виде облака.
 * 
 * Пример использования с менеджером виджетов:
 * ```php
 * $cloud = Gm::$app->widgets->get('gm.wd.tagcloud', ['showCounters' => true]);
 * $cloud->run();
 * ```
 * 
 * Пример использования в шаблоне:
 * ```php
 * echo $this->widget('gm.wd.tagcloud', ['showCounters' => true]);
 * ```
 * 
 * Пример использования с namespace:
 * ```php
 * use Gm\Widget\TagCloud\Widget as Cloud;
 * 
 * echo Cloud::widget(['showCounters' => true]);
 * ```
 * если namespace ранее не добавлен в PSR, необходимо выполнить:
 * ```php
 * Gm::$loader->addPsr4('Gm\Widget\TagCloud\\', Gm::$app->modulePath . '/gm/gm.wd.tagcloud/src');
 * ```
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Widget\TagCloud
 * @since 1.0
 */
class Widget extends \Gm\View\Widget
{
    use WidgetResourceTrait;

    /**
     * Идентификатор языка.
     * 
     * Применяется для формирования условия вывода меток в облаке согласно указанному языку.
     * 
     * Например: '', '570643', 'ru-RU', `null`. Если значение '', то текущий 
     * идент. языка.
     * 
     * @var string|int|null
     */
    public string|int|null $language = '';

    /**
     * Показывать счётчики меток.
     * 
     * @var bool
     */
    public bool $showCounters = true;

    /**
     * Список меток, которые будут отображаться в облаке.
     * 
     * Если метки отсутствуют, визуализации (рендера) не будет.
     * Каждый элемент массива представляет собой одну метку со 
     * следующей структурой:
     * ```php
     * [
     *     'name'    => 'Метка', // обязательно
     *     'desc'    => 'Описание метки',
     *     'slug'    => 'primer-metki', // слаг добавляемый в URL-адрес метки
     *     'counter' => 17, // счётчик терминов, которые имеют метку
     *     'hits'    => 120, // счётчик просмотра метки
     *     'visible' => 1 // видимость метки
     * ]
     * ```
     * 
     * @var array
     */
    public array $items;

    /**
     * Имя или файл шаблона представления для вывода меток или обратный 
     * вызов (например, анонимная функция) для вывода каждой метки. 
     * 
     * Если указано имя файла представления, в представлении будут доступны следующие 
     * переменные:
     * - `$items`, список выводимых меток;
     * - `$showCounters`, показывать счетчики меток;
     * - `$widget`, экземпляр виджета.
     * 
     * Если это свойство указано как обратный вызов, оно должно иметь следующую сигнатуру:
     * ```php
     * function ($items, $widget)
     * ```
     * 
     * @var Closure|string
     */
    public Closure|string $itemsView = '';

    /**
     * {@inheritdoc}
     * 
     * [tagcloud show-counters="true" language=""...]
     * 
     * Следующие атрибуты шорткода, которые буду определяться:
     * - show-counters -> показывать счётчики меток, например: "true", "1";
     * - language      -> указывает какой язык использовать, например: "", "570643", "ru-RU".
     */
    protected function initAttributes(array $attr): void
    {
        if (isset($attr['showCounters'])) {
            $this->showCounters = $attr['showCounters'] === 'true' || $attr['showCounters'] == 1;
        }
        if (!empty($attr['language'])) {
            $this->language = $attr['language'];
        }
    }

    /**
     * Определяет список меток.
     * 
     * @see Widget::$items
     * 
     * @return $this
     */
    public function findItems(): static
    {
        /** @var int|null $language */
        if ($this->language === '')
            $language = Gm::$app->language->get('code');
        else
            $language = Gm::$app->language->available->getCodeBy($this->language);
        $this->items = Gm::$app->tagger->getTags($language);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function beforeRun(): bool
    {
        // определение списка элементов
        if (!isset($this->items)) {
            $this->findItems();
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function run(): mixed
    {
        if (is_string($this->itemsView)) {
            $options = [
                'showCounters' => $this->showCounters,
                'items'        => $this->items, 
                'widget'       => $this
            ];

            if (empty($this->itemsView)) {
                return $this->renderFile(
                    $this->getWidgetRenderFile('/default.phtml'), $options
                );
            } else
                return $this->render($this->itemsView, $options);
        } else
        if (is_callable($this->itemsView)) {
            return call_user_func($this->itemsView, $this->items, $this);
        }
        return '';
    }
}