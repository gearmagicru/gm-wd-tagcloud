# <img src="https://raw.githubusercontent.com/gearmagicru/gm-wd-tagcloud/refs/heads/master/assets/images/icon.svg" width="64px" height="64px" align="absmiddle"> Виджет "Облако меток"

[![Latest Stable Version](https://img.shields.io/packagist/v/gearmagicru/gm-wd-tagcloud.svg)](https://packagist.org/packages/gearmagicru/gm-wd-tagcloud)
[![Total Downloads](https://img.shields.io/packagist/dt/gearmagicru/gm-wd-tagcloud.svg)](https://packagist.org/packages/gearmagicru/gm-wd-tagcloud)
[![Author](https://img.shields.io/badge/author-anton.tivonenko@gmail.com-blue.svg)](mailto:anton.tivonenko@gmail)
[![Source Code](https://img.shields.io/badge/source-gearmagicru/gm--wd--tagcloud-blue.svg)](https://github.com/gearmagicru/gm-wd-tagcloud)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/gearmagicru/gm-wd-tagcloud/blob/master/LICENSE)
![Component type: widget](https://img.shields.io/badge/component%20type-widget-green.svg)
![Component ID: gm-wd-tagcloud](https://img.shields.io/badge/component%20id-gm.wd.tagcloud-green.svg)
![php 8.2+](https://img.shields.io/badge/php-min%208.2-red.svg)

Виджет предназначен для отображения меток (тегов) в виде облака.

## Пример применения
### с менеджером виджетов:
```
$cloud = Gm::$app->widgets->get('gm.wd.tagcloud', ['showCounters' => true]);
$cloud->run();
```
### в шаблоне:
```
echo $this->widget('gm.wd.tagcloud', ['showCounters' => true]);
```
### с namespace:
```
use Gm\Widget\TagCloud\Widget as Cloud;
echo Cloud::widget(['showCounters' => true]);
```
если namespace ранее не добавлен в PSR, необходимо выполнить:
```
Gm::$loader->addPsr4('Gm\Widget\TagCloud\\', Gm::$app->modulePath . '/gm/gm.wd.tagcloud/src');
```

## Установка

Для добавления виджета в ваш проект, вы можете просто выполнить команду ниже:

```
$ composer require gearmagicru/gm-wd-tagcloud
```

или добавить в файл composer.json вашего проекта:
```
"require": {
    "gearmagicru/gm-wd-tagcloud": "*"
}
```

После добавления виджета в проект, воспользуйтесь Панелью управления GM Panel для установки его в редакцию вашего веб-приложения.
