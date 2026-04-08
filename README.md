# EOT Theme

WordPress-тема для сайта `coach-psycholog.com`.

## О проекте

Тема разработана для двуязычного сайта психолога и коуча с лендинговой структурой страниц, онлайн-записью и SEO-ориентированной языковой навигацией.

Сайт поддерживает:

- русскую версию
- словацкую версию
- отдельные языковые URL
- серверный вывод переводов и мета-данных

## Основные возможности

- двуязычная структура сайта на базе `Polylang`
- переключение между RU/SK версиями страниц
- SEO-мета на стороне сервера:
  - `title`
  - `description`
  - `canonical`
  - `hreflang`
  - Open Graph / Twitter meta
- шаблоны страниц под лендинговую структуру
- фронтенд онлайн-записи
- серверный вывод переводов интерфейса

## Стек

- WordPress
- PHP
- vanilla JavaScript
- CSS
- Polylang для языковых версий страниц и URL

## Структура темы

- [functions.php](/home/sergey/projects/themes/eot-theme/functions.php)  
  Основная логика темы, локализация, SEO, подключение ассетов
- [header.php](/home/sergey/projects/themes/eot-theme/header.php)  
  Шапка сайта, меню, переключатель языка, meta-теги
- [footer.php](/home/sergey/projects/themes/eot-theme/footer.php)  
  Подвал сайта
- [front-page.php](/home/sergey/projects/themes/eot-theme/front-page.php)  
  Шаблон главной страницы
- [page-about.php](/home/sergey/projects/themes/eot-theme/page-about.php)  
  Шаблон страницы «Обо мне»
- [page-services.php](/home/sergey/projects/themes/eot-theme/page-services.php)  
  Шаблон страницы услуг
- [page-contacts.php](/home/sergey/projects/themes/eot-theme/page-contacts.php)  
  Шаблон страницы контактов и записи
- [404.php](/home/sergey/projects/themes/eot-theme/404.php)  
  Шаблон 404
- [assets/js/main.js](/home/sergey/projects/themes/eot-theme/assets/js/main.js)  
  Основная фронтенд-логика
- [assets/js/contacts.js](/home/sergey/projects/themes/eot-theme/assets/js/contacts.js)  
  Логика интерфейса записи
- [languages](/home/sergey/projects/themes/eot-theme/languages)  
  Файлы переводов темы

## Локализация

В проекте разделены 2 слоя локализации:

- `Polylang` отвечает за:
  - языковые версии страниц
  - связи между переводами страниц
  - структуру URL
  - переключатель языка
- переводы интерфейса темы выполняются через стандартный WordPress `gettext`
  с `Text Domain: eot-theme`

## Особенности

- тема ориентирована на фиксированные шаблоны страниц, а не на универсальную контентную тему
- логика записи зависит от REST API, доступного в установленном WordPress
- проект рассчитан на серверный вывод контента и SEO-мета без зависимости от клиентской подмены текста через JavaScript
