# vmshop_1c
Обмен 1C УТ 8.x &lt;-> VirtueMart 2 (Joomla) по протоколу CommerceML, с выгрузкой свойств, скидок, габаритов и производителя


Данная публикация являет собой дальнейшее развитие заброшенной автором бесплатной компоненты обмена 1С с интернет-магазином на базе VirtueMart 2. Исправлены выявленные ошибки, реализована поддержка последних версий VirtueMart, добавлен новый и расширен прежний функционал.
Исходная версия компоненты (набор PHP-скриптов) доступна на форуме:

http://joomlaforum.ru/index.php/topic,175325.0.html

и имеет следующие возможности:

Из 1С:

1) Выгрузка номенклатуры
2) Выгрузка изображений с последующим созданием tumbsnail
3) Выгрузка дополнительных картинок
4) Выгрузка всех ценовых групп и назначение по дефолту группы, указанной в настройке!
5) Выгрузка остатков на складе
6) Выгрузка цен на товары в соответствии с ценовой группой

В 1С:

1) Загрузка заказов со статусов P
2) Добавление новых клиентов (в том числе и Юр. лица)

Скрипт работает как на полную выгрузку, так и на выгрузку изменений!

Внимание! Для некоторых возможностей скрипта необходимо, чтобы было установлено дополнение к 1С, скачать можно на офф сайте!

Для работы со стороны 1С используется стандартный механизм обмена с WEB-сайтом, использующий планы обмена для отслеживания изменений, что приятно :)



НОВЫЕ ВОЗМОЖНОСТИ И ИЗМЕНЕНИЯ В ВЕРСИИ 2.1.1.Amator



1) Исправлена проблема с дробным весом - изначально вес загружался как целое число, отсекалась дробная часть.

2) Добавлен перенос свойств - свойства должны иметь простой тип (строка, число), так как для хранения сложных типов в VM нет отдельной таблицы. Поддерживается выгрузка неограниченного количества доп. свойств!

3) Нормальная выгрузка производителя - производитель заводится так же как доп. свойство, и должен иметь тип Справочник! (Контрагенты, Значения свойств объектов и т. п.). Свойство должно называться "производитель", если хотите по-другому, нужно запустить на вашем сайте vmshop_1c.php и отредактировать параметр VM_MANUFACTURE.

4) Выгрузка двойных картинок поправлена - не правильно подставлялись пути к каталогу.

5) Выгрузка цен поправлена - менялись названия реквизитов в таблицах VM, начиная с версии 2.0.14.

6) Добавлен перенос габаритов товара - для загрузки габаритов (Длина,Ширина,Высота) в стандартные реквизиты товара VM, а не как доп. свойства, нужно добавить эти реквизиты аналогично весу в справочник Единицы измерения, и внести дополнения в код модуля обработки ОбменССайтом: (функция РИ_ЗаполнитьСписокЗначенийРеквизитовТовара):

Если ЗначениеЗаполнено(ВыборкаНоменклатуры.Вес) Тогда

ДобавитьЗначениеРеквизитаВСписок(СписокЗначенийCML, "Вес", мКоэффициентПересчетаВесаТоваровВГраммыДляОбменаССайтом * ВыборкаНоменклатуры.Вес);
КонецЕсли; 
//+Аматор
Если ЗначениеЗаполнено(ВыборкаНоменклатуры.ЕдиницаХраненияОстатков.Длина) Тогда 
ДобавитьЗначениеРеквизитаВСписок(СписокЗначенийCML, "Длина", ВыборкаНоменклатуры.ЕдиницаХраненияОстатков.Длина);
КонецЕсли;
Если ЗначениеЗаполнено(ВыборкаНоменклатуры.ЕдиницаХраненияОстатков.Ширина) Тогда 
ДобавитьЗначениеРеквизитаВСписок(СписокЗначенийCML, "Ширина", ВыборкаНоменклатуры.ЕдиницаХраненияОстатков.Ширина);
КонецЕсли;
Если ЗначениеЗаполнено(ВыборкаНоменклатуры.ЕдиницаХраненияОстатков.Высота) Тогда 
ДобавитьЗначениеРеквизитаВСписок(СписокЗначенийCML, "Высота", ВыборкаНоменклатуры.ЕдиницаХраненияОстатков.Высота);
КонецЕсли;
//-Аматор

 

7) Реализована выгрузка скидок номенклатуры (установленных документом "Установка скидок номенклатуры"). Сам процент скидки не хранится, Цена со скидкой расчитывается при загрузке и записывается в поле product_override_price.

8) При загрузке заказов в 1с в номер теперь подставляется Номер, а не Ид заказа, как было раньше.

9) Реализована выгрузка описаний для категорий (поле Комментарий, его необходимо сделать доступным не только для элементов, но и для групп номенклатуры в 1С). В процедуру ВыгрузитьОсновныеРеквизитыГруппыДляКлассификатора необходимо добавить:

//+Аматор
ДобавитьУзелCML(БуферCML, "Комментарий", ФорматНаименованияДляCML(Группа.НоменклатураСсылка.Комментарий));
//-Аматор



 

ИЗМЕНЕНИЯ В ВЕРСИИ 2.1.2.Amator

 

 

1) Исправлена ошибка с полем slug в товарах, не дающая корректно обновлять базу в магазине (когда VM_DB = нет).

2) Исправлена ошибка с загрузкой производителей (когда VM_DB = нет).



ИЗМЕНЕНИЯ В ВЕРСИИ 2.1.4.Amator

1) Исправлена проблема с авторизацией (альтернативным скриптом checkauth_2_5.php замените оригинальный checkauth.php, если у вас не проходит авторизация и ругается на 180 строку).

2) Исправлены мелкие ошибки синхронизации товаров

3) Расширенная информация о заказе в поле комментарий





Данная версия скрипта будет работать только с VM2, последних версий (думаю, начиная с 14й). VM1 - не поддерживается. VM3 - не проверял, и пока не планирую. Так же скорее всего не будет работать выгрузка характеристик номенклатуры. Тестировал обмен с УТ 10.3.24 - VM 2.0.24 (JM 2.5). Так же внедрял эту обработку для УНФ 1.4 и КА 1.1. Не исключено, что будет работать и с УПП, и УТ 11, но не проверял.

В разделе файлов вы можете скачать архив со скриптами, который нужно разместить на вашем сайте, и модифицированную обработку ОбменССайтом.
