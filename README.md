## Информация о сборке

    PHP: 8.1.4
    Laravel: 9.5.1


## Важно!
Если в проекте необходимо использование фреймворков фронтенда, например **React**, то сначала читаем [тут](frontend.md)

## Старт работы
При первом запуске проекта, выполнить команду

```bash
make build
```
Соберутся контейнеры, 

Установятся зависимости,

Выполнятся базовые миграции,

Сгенерируется ключ приложения

## Непосредственно разработка
Доступные порты и сервисы можно посмотреть в файле docker-compose.yml

Необходимое окружение можно поменять в файле `src/example.env` и `src/.env` (последний не заливается в git).

## Поднятие бэкенда
Для начала работы делаем `make up`, при завершении работы делаем `make down`.

Сайт доступен по адресу [http://localhost](http://localhost)

