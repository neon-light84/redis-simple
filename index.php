<!doctype html>
<?php
require_once __DIR__ . '/main.php';
use \App\MainConfig;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список из REDIS</title>
</head>
<body>

<script type="text/javascript">var token = '<?php
        // Симуляция токена.
        echo MainConfig::$rest['token'];
        ?>'; // Эта переменная нужна глобальной, поэтому var
</script>

<h1>Данные из REDIS</h1>
<ul id="data-list"></ul>

<script type="text/javascript" src="public/rest.js"></script>
<script type="text/javascript" src="public/main.js"></script>
<script type="text/javascript" src="public/dom.js"></script>

<script type="text/javascript">
reloadDataList();
</script>

</body>
</html>
