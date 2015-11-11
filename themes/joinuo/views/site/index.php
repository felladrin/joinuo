<?php $this->pageTitle = Yii::app()->name; ?>

<div id="post-wrapper">
    <div class="post" style="text-align: center">
        <h3>&#9733;&nbsp; Shard of the Moment &nbsp;&#9733;</h3>
        <a href="<?php echo $this->createUrl('shard/view', array('id' => $shardOfTheMoment->id)) ?>" title="<?php echo CHtml::encode($shardOfTheMoment->name); ?> - Shard of the Moment" style="display: block; max-height: 78px; overflow: hidden;">
            <img src="<?php echo $shardOfTheMoment->banner_url; ?>" alt="" style="width: 100%;" />
        </a>
    </div>

    <div class="post" style="text-align: center">
        Shard Sorting: <a href="?Shard_sort=votes.desc">Votes</a> &middot; <a href="?Shard_sort=clients_now.desc">Players Online</a> &middot; <a href="?Shard_sort=clients_peak.desc">Players Peak</a> &middot; <a href="?Shard_sort=era">Era</a> &middot; <a href="?Shard_sort=name">Name</a> &middot; <a href="?Shard_sort=hits.desc">Hits</a> &middot; <a href="?Shard_sort=join_date.desc">Join Date</a>
    </div>

    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $shardList,
        'summaryText' => '',
        // 'sorterHeader' => 'Sort by:',
        // 'sortableAttributes' => array('votes', 'clients_now', 'clients_peak', 'era', 'name', 'hits', 'join_date'),
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
        'itemView' => '_index_shards',
    ));
    ?>
</div>
<div id="sidebar">
    <div class="sidebox">
        <h3>Welcome to <?php echo CHtml::encode(Yii::app()->name); ?>!</h3>
        <p>This is an Ultima Online Portal where you can list and find a good UO Freeshard to join. You can also share your thoughts and cast votes for the shards you like.</p>
        <table style="text-align: center;">
            <tr>
                <td>
                    <b>Shards Online</b><br/>
                    <?php echo $onlineShards; ?> / <?php echo $totalShards; ?>
                </td>
                <td>
                    <b>Last Update</b><br/>
                    <?php echo date('H:i', filemtime(Yii::app()->basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR. "poller.html")); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Total Players</b><br/>
                    <?php echo $totalPlayers; ?>
                </td>
                <td>
                    <b>Current Time</b><br/>
                    <?php echo date('H:i'); ?>
                </td>
            </tr>
        </table>
        <?php
        /* TODO: Create search system.
          <form id="searchform" method="get">
          <input type="text" id="s" name="s" value="What do you want from a shard?" onfocus="this.value = ''" onblur="this.value = 'What do you want from a shard?'"/>
          </form>
         */
        ?>
    </div>
    <div class="sidebox">
        <h3>Random Screenshots</h3>
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
                'dataProvider' => $randomScreenshots,
                'summaryText' => '',
                'emptyText' => 'No screenshots yet.',
                'itemView' => '_shard_screenshots',
            ));
            ?>
        </ul>
    </div>
    <?php
    $url = "http://joinuo.com/forum/search?searchJSON=%7B%22date%22%3A%7B%22from%22%3A%22lastWeek%22%7D%2C%22view%22%3A%22topic%22%2C%22sort%22%3A%7B%22lastcontent%22%3A%22desc%22%7D%2C%22exclude_type%22%3A%5B%22vBForum_PrivateMessage%22%5D%7D";
    $input = @file_get_contents($url);
    $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]* class=\"topic-title\">(.*)<\/a>"; // Regex code by Chirp Internet: www.chirp.com.au
    if (@preg_match_all("/$regexp/siU", $input, $matches)):
    ?>
        <div class="sidebox">
            <h3>Recent Forum Topics</h3>
            <ul class="post-list archive">
                <?php
                foreach ($matches[3] as $key => $linkTitle) // Removes deleted topics from recent topics box.
                {
                    if (empty($linkTitle))
                    {
                        unset($matches[2][$key]);
                        unset($matches[3][$key]);
                    }
                }

                array_filter($matches[2]);
                array_filter($matches[3]);

                $topicsCount = 0;

                foreach ($matches[2] as $i => $link)
                {
                    if ($topicsCount > 5)
                        break;

                    ?>
                        <li><a href="<?php echo $matches[2][$i]; ?>" title="<?php echo $matches[3][$i]; ?>" target="_blank"><?php echo $matches[3][$i]; ?></a></li>
                    <?php

                    $topicsCount++;
                }
                ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php echo Adsense::Sidebox(); ?>
    <div class="sidebox">
        <h3>Recent Comments</h3>
        <ul class="post-list">
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $recentComments,
                'summaryText' => '',
                'emptyText' => 'No comments yet.',
                'itemView' => '_index_recentcomments',
            ));
            ?>
        </ul>
    </div>
    <div class="sidebox">
        <h3>Random Shard Teaser</h3>
        <iframe style="width: 100%; height: 200px;" src="//www.youtube.com/embed/<?php echo $youtubeID ?>" frameborder="0" allowfullscreen></iframe>
        <div style="text-align: center"><?php echo CHtml::link(CHtml::encode($shardWithTeaser->name), array('shard', 'id' => $shardWithTeaser->id)) ?></div>
    </div>
    <div class="sidebox">
        <a class="twitter-timeline" href="https://twitter.com/DragonKyn" data-widget-id="434775291576082433">Tweets by @DragonKyn</a>
        <script>!function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = p + "://platform.twitter.com/widgets.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, "script", "twitter-wjs");</script>
    </div>
    <?php echo Adsense::Sidebox(); ?>
    <div class="sidebox">
        <h3>Latest Shards Added</h3>
        <ul class="post-list archive">
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $latestShards,
                'summaryText' => '',
                'itemView' => '_index_latestshards',
            ));
            ?>
        </ul>
    </div>
    <div class="sidebox">
        <script id="_wau70e">var _wau = _wau || [];
        _wau.push(["map", "vovc2vr1pdr0", "70e", "260", "130", "neosat", "triangle-green"]);
        (function() {var s=document.createElement("script"); s.async=true;
        s.src="http://widgets.amung.us/map.js";
        document.getElementsByTagName("head")[0].appendChild(s);
        })();</script>
    </div>
</div>