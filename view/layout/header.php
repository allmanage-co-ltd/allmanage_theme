<?php
$bodyClass  = esc_attr(implode(' ', get_body_class()));
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <?php wp_head(); ?>
</head>

<body class="<?= $bodyClass ?>">

    <?php if (file_exists(get_template_directory() . '/img/symbol-defs.svg')) {
        include_once(get_template_directory() . '/img/symbol-defs.svg');
    } ?>

    <header class="l-header <?php echo is_front_page() ? '-page' : ''; ?>" id="js-header">
        <div class="header-inner">
            <h1 class="header-logo">
                <a href="<?= home(); ?>">
                    <img src="<?= img_dir(); ?>/logo.png" alt="<?= get_bloginfo('name'); ?>">
                </a>
            </h1>

            <?php get_template_part('view/parts/header-navi'); ?>
        </div>
    </header>
    <div class="l-header__overlay slideout-panel slideout-panel-left" id="js-drawerPanel"></div>