<?php
use app\assets\AppAsset;
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<html>
<head>
    <title>
        yii2之布局测试
    </title>
</head>
<body>
<div class="app">
    <div class="header">
        头部
    </div>
    <div class="main">
        <?= $content ?>
    </div>
    <div class="footer">
        底部

    </div>
</div>
</body>
</html>
<?php $this->endPage() ?>