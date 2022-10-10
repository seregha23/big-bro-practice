<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Практическое задание <br> из телеграм-канала BigBro IT:</h1>
    <br>
</p>

<ul>
    <li>Необходимо написать парсер последних новостей о технологиях с сайта https://mashable.com/tech</li>
    <li>Должны сохраняться картинки в папку с каждой новости, описание и заголовок в базу данных.</li>
    <li>Обновление должно быть ежедневное и храниться в базе данных</li>
</ul>

<p>Для создания БД запустить из терминала : -- mysql -u root -p < create-db.sql</p>
<p>Для запуска парсера из терминала выполнить : php -f yii mashable/parser </p>