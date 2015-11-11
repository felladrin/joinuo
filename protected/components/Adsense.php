<?php

class Adsense
{
    public static function Sidebox()
    {
        return '<div class="sidebox" style="text-align: center">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                     style="display:inline-block;width:250px;height:250px"
                     data-ad-client="ca-pub-6085748649825153"
                     data-ad-slot="9831852226"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                </div>';
    }

}
