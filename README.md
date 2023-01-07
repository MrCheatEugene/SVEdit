# SVEdit
SVEdit(Simple Video Edit-or) - простой и лёгкий редактор с веб интерфейсом на Jquery и Bootstrap.

Это ридми к версии 2.х, старый ридми в ветке old-main.

# v2: Что изменилось?

- Программа переписана с нуля.
- FFMPeg запускается и работает в браузере(спасибо ffmpeg-wasm). 
- FFMPEG-wasm немного модифицирован для того, чтобы он работал. 
- Фронтенд на Bootstrap и Jquery. Некоторые вещи были сделаны мною на CSS ручками.
- Программа позволяет выбрать пресет FFMPEG для улучшения или ухудшения качества.
- Добавлен нормальный плеер.
- Перенесены все старые функции и добавлены новые.
- Функция добавления музыки
- Функция склейки видео
- Допилена функция накладывания текста
- Изменена внутренняя механика работы

# v2: Что с v1?
SVEDIT 1.x.x будет существовать и дальше, но не будет обновлятся.

# Требуется
## ЛЮБОЙ PHP ХОСТИНГ!
Можете поискать бесплатные.
И ВСЁ!

P.S Вебсервер не имеет значения.

# Установка
1. Скачайте последний релиз.
2. Распакуйте его на сервере в DocumentRoot сервера.
3. Готово. Перейдите на домен вебсервера/ffmpeg.php(например, http://127.0.0.1/ffmpeg.php), перед вами должен открытся интерфейс программы.

## Примеры

### Введение
* Все времена нужно указывать в формате "ЧЧ:ММ:СС" или часы:минуты:секунды.
<br>Неправильно: 0:0:1 <br>Неправильно: 0:10<br>Неправильно: 1<br>Правильно: 00:00:01
### Текст 
1. В меню сверху нажмите на "Видео", в появившемся подменю на "Текст".
2. Заполните форму: В поле текста - текст, в поле "Размер" размер шрифта, в поле "X-координата текста" - координату текста в пикселях по горизонтали, в поле "Y-координата текста" - координату текста в пикселях по вертикали, в поле "Цвет текста" укажите цвет из [этого](http://ffmpeg.org/ffmpeg-utils.html#color-syntax) списка, в поле "Начало текста" укажите время, с которого появится текст (По умолчанию - время берётся из проигрывателя), в поле "Конец текста" введите время, когда текст должен исчезнуть с экрана.
3. Нажмите "Готово"
4. Ожидайте. После успешной накладки текста, будет выведено сообщение, а также обновлён плеер.

### Сжатие 
1. В меню сверху нажмите на "Видео", в появившемся подменю на "Сжать видео".
2. Заполните форму: Укажите [CRF](https://trac.ffmpeg.org/wiki/Encode/H.264#crf). Перечень значений CRF и их результата: <br>0 - видео без потерь(loseless), 23 - значение по умолчанию, 23-30 - смотрибельно, 30-35 - неприятно для просмотра, 35-51 - ужасно.
3. Нажмите "Готово"
4. Ожидайте. После успешного сжатия, будет выведено сообщение, а также обновлён плеер. 

### Изменение разрешения 
1. В меню сверху нажмите на "Видео", в появившемся подменю на "Изменить размер".
2. Заполните форму: В поле "Размер" укажите размер в формате ШИРИНА**x**ВЫСОТА,например 1920**x**1080. Где "x" **обязательно** нужно указать латинскую X а не, например русскую "Х".
3. Нажмите "Готово"
4. Ожидайте. После успешного изменения размера, будет выведено сообщение, а также обновлён плеер. 

### Обрезка(По длинне)
1. В меню сверху нажмите на "Видео", в появившемся подменю на "Обрезка".
2. Заполните форму: В поле "Начало видео" укажите с какой точки начать обрезку(По умолчанию - время берётся из проигрывателя), в поле "Конец видео" укажите до какой точки надо завершить обрезку.
3. Нажмите "Готово"
4. Ожидайте. После успешного изменения размера, будет выведено сообщение, а также обновлён плеер. 

# Задонатьте.
Я потратил на этот проект около 8 часов, основное время было затрачено на фронтенд.
А также на вторую версию я потратил около 2 дней!
Киньте пару рублей сюда: https://donationalerts.com/r/mrcheatt
Спасибо.
