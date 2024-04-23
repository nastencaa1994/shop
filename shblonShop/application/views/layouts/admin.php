<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <script src="/public/scripts/jquery.js"></script>
    <script src="/public/scripts/form.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="/public/css/style.css" rel="stylesheet">
</head>
<body>
<div class="content-admin">
    <div class="container">
        <h1> Админ панель</h1>
        <div class="content-admin-inner">
            <div class="side-bar-admin">
                <ul class="list-group">
                    <li class="list-group-item action"><a href="/admin/news">Новости</a></li>
                    <li class="list-group-item"><a href="/admin/catalog">Каталог</a></li>
                </ul>
            </div>
            <?php echo $content; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>