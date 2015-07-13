<?php
/**
 * File Name: menu_head.php
 * Programmer : Saqib Sarwar
 * Date: 12/3/12
 * Time: 10:50 AM
 */
?>
<section class="page-head">
    <?php
    $theme_menu_title = stripslashes(get_option('theme_menu_title'));

    if(!empty($theme_menu_title))
    {
        ?>
        <h1>
            <span><?php echo $theme_menu_title; ?></span>
        </h1>
        <?php
    }
    ?>
</section>