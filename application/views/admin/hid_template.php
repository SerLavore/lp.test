<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8"/>
    <link href="/content/admin/css/style.css" rel="stylesheet" type = "text/css"/>
    <title>Home</title>
</head>
<body>
<div id = "wrapper">
    <content>
        <?php
        include('application/views/'.$content_view);
        ?>
    </content>
</div>
<script src="/content/plugins/jquery/jquery-2.2.0.min.js"></script>
<script src="/content/admin/js/auth.js"></script>
</body>
</html>
