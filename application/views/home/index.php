<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8"/>
    <link href="/content/home/css/style.css" rel="stylesheet" type = "text/css"/>
    <title>Home</title>
</head>
<body>
<div id = "wrapper">
    <sidebar>
        <ul>
            <?php
            if($data)
            {
                foreach ($data["link"] as $link) {
                    ?>
                    <li>
                        <a href="<?= $link["link"]; ?>"><?= $link["title"]; ?></a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </sidebar>

    <content>
        <?php
            include('application/views/'.$content_view);
        ?>
    </content>
</div>
<script src="/content/plugins/jquery/jquery-2.2.0.min.js"></script>
</body>
</html>
