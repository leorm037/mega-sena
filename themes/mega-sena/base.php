<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>MEGA SENA 2020</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/403477f2af.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="<?= theme("/assets/css/styles.css"); ?>" />
        <link rel="stylesheet" type="text/css" href="<?= theme("/assets/css/boot.css"); ?>" />
    </head>
    <body>
        <!-- HEADER -->
        <header class="header">
            <div class="header_content">
                <a href="<?= url(); ?>" class="logo">
                    <i class="fas fa-comment-dollar"></i>
                    <span>Mega da Virada</span>
                </a>

                <nav class="header_content_menu">
                    <ul>
                        <li><a href="<?= url(); ?>">Home</a></li>
                        <li><a href="<?= url("ano/2020"); ?>">2020</a></li>
                        <li><a href="<?= url("ano/2019"); ?>">2019</a></li>
                        <li><a href="<?= url("ano/2018"); ?>">2018</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main class="main">
            <div class="main_content">
                <div class="main_content_warp">
                    <?= $v->section("content"); ?>
                </div>
            </div>    
        </main>
        <footer></footer>
    </body>
</html>
