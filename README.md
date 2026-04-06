# Lab 7 — PHP + MySQL

Простое веб-приложение с лентой постов.
Данные хранятся в MySQL, добавление постов реализовано через API.

---

## База данных

База: `blog`

Таблицы:

**user**

* id
* username
* avatar

**post**

* id
* user_id
* image
* text
* likes
* created_at

Связь: `post.user_id → user.id`

---

## Запуск

1. Создать базу данных `blog`
2. Выполнить SQL:

```
SOURCE data/sql/table.sql;
SOURCE data/sql/posts.sql;
```

3. Открыть:

```
http://localhost/home/index.php
```

---

## API

### Endpoint

```
POST /home/api.php
```

### Формат запроса

Тип: `multipart/form-data`

Поля:

* `data` — JSON
* `image` — файл

Пример `data`:

```json
{
  "user_id": 1,
  "text": "Новый пост"
}
```

---

### Пример запроса (Postman)

Body → form-data:

| key   | type | value                       |
| ----- | ---- | --------------------------- |
| data  | text | {"user_id":1,"text":"test"} |
| image | file | (выбрать файл)              |

---

### Ответ

Успех:

```json
{
  "status": "success",
  "message": "Пост успешно создан",
  "post_id": 3
}
```

Ошибки:

* 400 — некорректные данные
* 405 — неверный метод
* 500 — ошибка сервера

---

## Примечание

Папка `images` создаётся автоматически при загрузке файла.
