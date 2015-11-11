<?php
/* @var $model Shard */

$this->pageTitle = Yii::app()->name . " - " . $model->name;
?>

<div id="post-wrapper">
    <div class="post">
        <h2 class="title"><?php echo CHtml::encode($model->name); ?></h2>
        <div class="meta">
            <div class="top-border"></div>
            <?php echo CHtml::encode($model->emulator); ?> shard running on <?php echo CHtml::encode($model->era); ?> Era with <?php echo CHtml::encode($model->clients_now); ?> players currently online.
        </div>

        <p><?php echo str_replace("\n", "<br/>", $model->description); ?></p>

        <p>
            <?php
            if (!empty($model->language))
            {
                echo "<b>Language:</b> " . CHtml::encode($model->language) . "<br/>";
            }

            echo '<span style="float:right">' . CHtml::link(CHtml::image(Yii::app()->request->baseUrl . "/images/Buttons/JoinUO88x51mondain.gif"), array('site/shardvoting', 'id' => $model->id)) . '</span>';

            if (!empty($model->website))
            {
                echo "<b>Site:</b> " . CHtml::link($model->website, $model->website, array('target' => '_blank')) . "<br/>";
            }

            if (!empty($model->host) && !empty($model->port))
            {
                echo "<b>Host:</b> " . CHtml::encode($model->host) . " &middot; <b>Port:</b> " . CHtml::encode($model->port) . "<br/>";
            }

            echo "<b>Join Date:</b> " . date("F j, Y", strtotime($model->join_date));
            ?>
        </p>

        <div class="top-border"></div>

        <?php if (!empty($model->banner_url)): ?>
            <div style="display: block; max-height: 78px; overflow: hidden;">
                <img src="<?php echo CHtml::encode($model->banner_url); ?>" alt="" style="width: 100%;" />
            </div>
        <?php endif; ?>

        <table style="margin-top: 10px;" cellspacing="0" cellpadding="0">
            <tr>
                <th class="center">Votes</th>
                <th class="center">Online</th>
                <th class="center">Peak</th>
                <th class="center">Hits</th>
                <th class="center">Uptime</th>
            </tr>
            <tr>
                <td class="center"><?php echo CHtml::encode($model->votes); ?></td>
                <td class="center"><?php echo ($model->online) ? $model->clients_now : "<span style='color:darkred'>OFF</span>"; ?></td>
                <td class="center"><?php echo CHtml::encode($model->clients_peak); ?></td>
                <td class="center"><?php echo CHtml::encode($model->hits); ?></td>
                <td class="center">
                    <?php
                    if ($model->times_polled != 0)
                    {
                        echo round(($model->times_online / $model->times_polled) * 100, 2) . "%";
                    }
                    else
                    {
                        echo "0%";
                    }
                    ?>
                </td>
            </tr>
        </table>
    </div>
    <div id="chart_clients" style="width: 100%; height: 200px;"></div>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages: ["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([['Datetime', 'Players Online'], <?php echo $historyClients; ?>]);

            var options = {
                title: 'Players Over Time',
                curveType: 'function',
                legend: {position: 'bottom'},
                hAxis: {textPosition: 'none'},
                enableInteractivity: true
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_clients'));
            chart.draw(data, options);
        }
    </script>

    <!-- Begin Comments -->

    <div id="comment-wrapper">
        <h3><?php echo $shardComments->totalItemCount ?> Comments about <?php echo CHtml::encode($model->name); ?></h3>

        <?php if ($shardComments->totalItemCount != 0): ?>
            <!-- Begin Comments -->
            <div id="comments">
                <ol id="singlecomments" class="commentlist">
                    <?php
                    $this->widget('zii.widgets.CListView', array(
                        'dataProvider' => $shardComments,
                        'summaryText' => '',
                        'pager' => array(
                            'htmlOptions' => array('class' => 'page-navi'),
                            'header' => '',
                            'selectedPageCssClass' => 'current',
                            'prevPageLabel' => '<',
                            'nextPageLabel' => '>',
                            'lastPageLabel' => '>>',
                            'firstPageLabel' => '<<',
                            'maxButtonCount' => 5
                        ),
                        // 'sorterHeader' => 'Sort by:',
                        // 'sortableAttributes' => array('name', 'clients_now'),
                        'itemView' => '_shard_comments',
                    ));
                    ?>
                </ol>
            </div>
            <!-- End Comments -->
        <?php endif; ?>

        <!--
        <ul class="page-navi">
            <li><a href="#" class="current">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
        -->

        <!-- Begin Form -->
        <div id="comment-form" class="comment-form">
            <h3>Leave a Comment</h3>
            <?php
            if (Yii::app()->user->isGuest)
            {
                echo '<p>You need to ' . CHtml::link('log in', array('site/login')) . ' or ' . CHtml::link('sign up', array('site/signup')) . ' before posting a comment.</p>';
                Yii::app()->user->returnUrl = Yii::app()->request->url; // Keep track of the most recently visited valid url.
            }
            else
            {
                echo CHtml::form(array('comment/create'));
                echo CHtml::textArea('Comment[message]', '', array('rows' => 5, 'style' => 'width: 580px'));
                echo CHtml::hiddenField('Comment[shard_id]', $model->id);
                echo CHtml::hiddenField('Comment[user_id]', Yii::app()->user->id);
                echo CHtml::submitButton('Post Comment', array('id' => 'submit-button', 'class' => 'button gray'));
                echo CHtml::endForm();
            }
            ?>
            <div class="clear"></div>
        </div>
        <!-- End Form --> 

    </div>

    <!-- End Comments --> 

</div>
<div id="sidebar">
    <?php if (!empty($youtubeID)): ?>
        <div class="sidebox">
            <h3>Shard Teaser</h3>
            <iframe style="width: 100%; height: 200px;" src="//www.youtube.com/embed/<?php echo $youtubeID ?>" frameborder="0" allowfullscreen></iframe>
        </div>
    <?php endif; ?>

    <?php if ($shardScreenshots->totalItemCount != 0): ?>
        <div class="sidebox">
            <h3>Shard Screenshots</h3>
            <ul class="flickr">
                <?php
                $this->widget('application.extensions.shadowbox.JShadowbox', array(
                    'options' => array(
                        'language' => 'en',
                        'players' => array('img'),
                        'handleOversize' => 'drag',
                    ),
                ));

                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $shardScreenshots,
                    'summaryText' => '',
                    // 'sorterHeader' => 'Sort by:',
                    // 'sortableAttributes' => array('name', 'clients_now'),
                    'itemView' => '_shard_screenshots',
                ));
                ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($news)): ?>
        <div class="sidebox">
            <h3>Shard News</h3>
            <ul class="post-list archive">
                <?php
                foreach ($news as $n)
                {
                    ?>
                    <li><a href="<?php echo CHtml::encode($n['link']); ?>" title="<?php echo date('F d, Y (H:i) - ', strtotime($n['date'])) . strip_tags($n['desc']); ?>" target="_blank"><?php echo CHtml::encode($n['title']); ?> (<?php echo date('d M', strtotime($n['date'])) ?>)</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php echo Adsense::Sidebox(); ?>

    <?php echo Adsense::Sidebox(); ?>
</div>