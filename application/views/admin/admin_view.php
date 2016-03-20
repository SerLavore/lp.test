<div id = "entry-content">
    <h1>Статистика</h1>
    <div class = "site-statistics">
        <table cellpadding="0" cellspacing="0" class = "table-stats">
            <tr>
                <td></td>
                <td class = "td-main">Сегодня</td>
                <td class = "td-main">Вчера</td>
                <td class = "td-main">Месяц</td>
                <td class = "td-main">Всего</td>
            </tr>
            <?php
                if($data["visit"])
                {
                    foreach($data["visit"] as $visit)
                    {
            ?>
            <tr class="tr-table">
                <td class = "td-main"><?=$visit["name"]?></td>
                <td><?=$visit["today"]?></td>
                <td><?=$visit["yesterday"]?></td>
                <td><?=$visit["month"]?></td>
                <td><?=$visit["total"]?></td>
            </tr>

            <?php
                    }
                }
            ?>
        </table>
    </div>
    <div class="chart-canvas">
        <canvas id="myChart" width="925" height="400"></canvas>
    </div>
</div>
<script src = "/content/admin/js/interval.js"></script>
