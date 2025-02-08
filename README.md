# <img src="https://raw.githubusercontent.com/gearmagicru/gm-wd-tagcloud/refs/heads/master/assets/images/icon.svg" width="64px" height="64px" align="absmiddle"> Виджет "Облако меток"

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
