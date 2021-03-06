<?php
    /* @var $this \yii\web\View */
    /* @var $content string */

    use kartik\sidenav\SideNav;
    use yii\helpers\Html;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;
    use app\assets\AppAsset;

    AppAsset::register($this);
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Yii::t('app', 'My First Yii App'),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

            <div class='col-lg-2'>
                <?php
                echo SideNav::widget(
                    [
                        'type' => SideNav::TYPE_PRIMARY,
                        'items' => [
                            ['label' => Yii::t('app', 'Projects'), 'url' => ['/site/project']],
                            ['label' => Yii::t('app', 'Tasks'), 'url' => ['/site/task']],
                            ['label' => Yii::t('app', 'Reports'), 'url' => ['/site/report']],
                        ]
                    ]);
                ?>
            </div>

            <div class='col-lg-9'>
                <?= $content ?>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">Matic Kolenc Trplan</p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>