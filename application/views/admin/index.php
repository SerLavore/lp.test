<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8"/>
    <link href="/content/admin/css/style.css" rel="stylesheet" type = "text/css"/>
    <link href="/content/admin/css/media.css" rel="stylesheet" type = "text/css"/>
    <title>Home</title>
    <script src="/content/plugins/jquery/jquery-2.2.0.min.js"></script>
</head>
<body>
<div id = "hid-container">

</div>
<div id = "wrapper">
    <header>
        <div class="admin-header-left-container">
            <div class = "nav-filled"><img src="/content/images/nav.png"/></div>
        </div>
        <div class = "admin-header-right-container">
            <div class = "admin-img-profile">
                <div class = "icon-block profile-ico">
                    <img src="/content/images/admin-avatar.png"/>
                </div>
                <div class = "icon-block">
                    <a href = "/admin/logout/"><img src="/content/images/exit.png" title = "Выйти"/></a>
                </div>
            </div>
        </div>
        <div class="admin-menu-container">
            <ul>
                <li>
                    <a href = "#">Профиль</a>
                </li>
                <li>
                    <a href = "#">Управление</a>
                </li>
                <li>
                    <a href = "/admin/logout/">Выйти</a>
                </li>
            </ul>
        </div>
    </header>
    <aside>
        <ul class="admin-menu">
            <li>
                <div class = "hovered-menu">
                    <img src="/content/images/checkmark.png" class = "hovered-img"/>
                </div>
            </li>
            <?php
                if($data)
                {
                    foreach($data["menu"] as $menu) {

                        ?>
                        <li>
                            <a href="<?=$menu["link"]?>" class = "menu-link">
                                <span class="menu-img-container">
                                    <img src="/content/images/<?=$menu["ico"];?>" class = "img-filled"/>
                                </span>
                                <?=$menu["name"];?>
                            </a>
                        </li>
                        <?php
                    }
                }
            ?>
        </ul>
    </aside>
    <div id="content">
        <?php
            include('application/views/'.$content_view);
        ?>
    </div>
</div>
<script src="/content/plugins/chartjs/Chart.min.js"></script>
<script src="/content/admin/js/charts.js"></script>
<script src = "/content/admin/js/main.js"></script>
</body>
</html>
