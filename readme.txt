=== real.Kit ===

Contributors: Realist
Donate link:
Tags: kit, real, real., real.kit, image, images, thumb, thumbnail, thumbnails, category, categories, taxonomy, taxonomies, admin, id, ids, reveal, post, page, media, user, l10n, translit, transliteration, slugs, russian, rustolat, cyrtolat, cyrillic, javascript, js, add, набор, реалист, картинка, миниатюра, категории, рубрики, таксономии, метки, админ, пост, запись, страница, меди, пользователи, транслит, транслитерация, слаг, ярлык, русский, кириллица
Requires at least: 4.1.1
Tested up to: 4.1.1
Stable tag: 1.2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Набор дополнений и улучшений WordPress | Kit of additions and improvements for WordPress

== Description ==

*English read below*

= Возможности плагина: =

1) Добавляет колонку ID на страницах админ панели.

А именно: 'Все записи', 'Все страницы', 'Рубрики', 'Метки', 'Медиафайлы', 'Пользователи', 'Комментарии', 'Пользовательские рубрики/метки', 'Пользовательские типы записей'

2) Позволяет задавать миниатюры для рубрик и меток.

Используйте PHP функцию `realkit_taxonomy_thumb($cat_id, $thumb_size)` для того чтобы получить URL миниатюры текущей таксономии. Вы можете передать в эту функцию два аргумента: первый - `ID` желаемой таксономии (по умолчанию `ID` текущей таксономии), второй - необходимый размер миниатюры: `thumbnail`, `medium`, `large`, `full` (по умолчанию `full`).

3) Заменяет кириллические символы на латинские (транслит) в ярлыках заголовков и названиях файлов.

4) Позволяет вставлять JavaScript в текст записи или страницы, используя шорткод `[js]`.

Все HTML теги внутри этого шорткода будут вырезаны. Если Вам нужно написать HTML тег внутри JS - нужно к угловым скобки тега `<` и `>` добавить круглые скобки `<(` и `)>` соответственно.

Пример:
`[js]
console.log('<(div class="test")><(a href="#")>Лог<(/a)><(/div)>');
[/js]`

Для того что бы подключить JS файл, нужно шорткоду `[js]` передать параметр `src`.

Пример:
`[js src="/url/address/script.js"][/js]`

*Machine translation:*

= The plugin: =

1) Reveal IDs on admin pages.

IDs can be revealed on following pages: 'All Posts', 'All Pages', 'Categories', 'tags', 'Media', 'Users', 'Comments', 'Custom Taxonomies', 'Custom Post types'

2) Allows you to specify a thumbnails for Categories and Tags.

Use PHP function `realkit_taxonomy_thumb($cat_id, $thumb_size)` to get the URL of the current taxonomy thumbnail. You can pass this function two arguments: the first - `ID` desired taxonomy (default: current taxonomy ID), the second - the desired thumbnail size: `thumbnail`, `medium`, `large`, `full` (default: `full`).

3) Converts Cyrillic characters in slugs and filenames.

4) Allows the include of JavaScript inside posts and pages, using shortcode `[js]`.

All HTML tags inside this shortcode will be removed. If You need to use HTML tag inside JS You need add round brackets to angle bracket of the tag, like this: `<(` and `)>`.

Example:
`[js]
console.log('<(div class="test")><(a href="#")>Some Text<(/a)><(/div)>');
[/js]`

To include JS file, You need shortcode `[js]` to pass a parameter `src`.

Example:
`[js src="/url/address/script.js"][/js]`

== Installation ==

Как и любой другой плагин WordPress.

**Machine translation:**

Like any other WordPress plugin.

== Screenshots ==

1. ID записей | Posts ID
1. ID рубрик | Categories ID
1. Миниатюра рубрики | Categories Thumbnail
1. Миниатюра рубрики | Categories Thumbnail
1. Транслит записи | Posts Translit
1. Транслит медиафайла | Media files Translit

== Changelog ==

= 1.2.3 =

* Исправленна ошибка версии 1.2.2

*Machine translation:*

* Fixed bug from 1.2.2

= 1.2.2 =

* Исправленна ошибка при вызове функции `realkit_taxonomy_thumb()`
* Расширено описание данной функции

*Machine translation:*

* Fixed bug when calling the function `realkit_taxonomy_thumb()`
* Extended description this function

= 1.2.1 =

* В шорткод `[js]...[/js]` добавлен параметр `src`.
* Другие правки.

*Machine translation:*

* In the shortcode `[js]...[/js]` added parameter `src`.
* Other changes.

= 1.2 =

* Добавлена поддержка шорткода `[js]...[/js]`.

*Machine translation:*

* Added shortcode `[js]...[/js]`.

= 1.1 =

* Добавлен русский перевод интерфейса.
* Исправлена ошибка транслитерации.
* Другие правки.

*Machine translation:*

* Added Russian localization.
* Fixed Transliteration bug.
* Other changes.