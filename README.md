## Форум IT
### Технологии:
- PHP 8.0
- MySQL
- HTML5
- CSS3
### Реализовано:
- Форма авторизации
- Форма регистрации
- Форма восстановления пароля по контрольному вопросу
- Форма отправки комментариев
- Проверка заполненности всех форм
- Проверка правильности введенных данных
- Проверка существования логина и E-mail при регистрации в базе данных
- В контент части реализованы блоки с особенностями:
    - Каждый блок относится к отдельной категории
    - Отдельный общий блок со всеми статьями
    - В каждом блоке отображаются последние статьи соответствующей категории с ограничением в 6 статей на страницу
    - Пагинация, если статей категории более 6ти.
- Счётчик просмотров статей
- Два сайдбара:
    - Топ просматриваемых статей с выводом 5ти наиболее просматриваемых статей
    - Последние комментарии на форуме (отображение последних 5ти), собираются со всех статей
- Формирование каждой статьи путем получения данных о ней из БД, а так же комментариев к ней
- Индикация аккаунта администратора в виде (А) рядом с именем
- Возможность публикации статей
- Права администратора, позволяющие:
    - Удалять любые статьи
- Пользователь может удалить только свою статью
- Комментарии к статье удаляются одновременно с самой статьей
- Удаление картинки статьи с сервера при удалении статьи
- Личный кабинет с отображением:
    - Статистики профиля
    - Персональных статей и комментариев пользователя
- Возможность изменения аватарки в личном кабинете
- Валидация картинки аватарки и картинок статей на размер и формат файла
- Возможность удаления комментария пользователем (лишь свои)
- Возможность удаления комментария администратором (все комментарии)

### Планируемые доработки PHP:
- Защита от некорректного ввода(добавлена валидация email, подкорректировать валидацию по длине)
- Защита данных аккаунта (установлена кодировка пароля)
- Профиль администратора (админ добавлен в конфиг, реализовать админ страницу)
- Конфиг файл (добавлен, развивать функционал)// Общие настройки можно записывать в конфиг файл (размер файлов, форматы и тд)
- Личный кабинет
- Реализация модерации статей администратором
### Планируемые доработки JavaScript:
- Отправка форм по нажатию на Enter
- Alert при удалении статьи
- Оповещение при успешном удалении и публикации статьи
- Добавить кнопку, чтобы страница поднималась наверх (появляется только после того как спустишься вниз)
### Задачи по верстке
- Адаптив
- Кнопка удаления комментариев
