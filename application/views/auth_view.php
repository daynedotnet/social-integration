<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>        
    <title><?php echo $title; ?></title>           
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
    <body>
    
    <div class="span6">


        Hi <?=$user_data->user_fname.' '.$user_data->user_lname?>
        
        <?=$profile_image?>
        <a href="<?=$news_feed?>">News Feed</a>
        <a href="<?=$publish?>">Publish</a>

        <form method="post" action="<?=base_url().'auth/fb_wall_post'?>" enctype="multipart/form-data">
            <p>Select the image: <input type="file" name="pic[]" multiple/></p>
            <p><input type="hidden" name="page_id" value="<?=$pages['id']?>"></p>
            <p><input class="post_but" type="submit" value="Upload to my album" /></p>
        </form>
        
        <a href="<?=base_url().'auth/fb_connect'?>">Login</a>
        <a href="<?=base_url().'auth/fb_logout'?>">Logout</a>
    </div>

    <!--
    /*! Designblue Manila - creative instinct
    //@ Web Developer: Ralph Dayne B. Banzon
    */
    -->
    <script type="text/javascript">
        if (window.location.hash && window.location.hash == '#_=_') {
            if (window.history && history.pushState) {
                window.history.pushState("", document.title, window.location.pathname);
            } else {
                var scroll = {
                    top: document.body.scrollTop,
                    left: document.body.scrollLeft
                };
                window.location.hash = '';
                document.body.scrollTop = scroll.top;
                document.body.scrollLeft = scroll.left;
            }
        }
    </script>
    </body>
</html>