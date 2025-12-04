<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<?php
	require_once(get_template_directory() . '/lib/helpers/langCheck.php');

	// $locale = get_locale();
?>

<header class="header">
    <div class="header_space"></div>
    <div class="header_container">
        <div class="header_wrap">
            <h1 class="header_logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/logo.svg" alt="Site Logo">
                </a>
            </h1>
            <nav class="header_menu_wrap">
                <ul class="header_menuTop">
                    <li class="header_menuTop_list">
                        <a class="header_menuTop_link" href="<?php echo get_page_link( 33 ); ?>">NEWS</a>
                    </li>
                    <li class="header_menuTop_list">
                        <a class="header_menuTop_link" href="<?php echo get_page_link( 42 ); ?>">LOGIN</a>
                    </li>
                    <li class="header_menuTop_list">
                        <a class="header_menuTop_link" href="<?php echo get_page_link( 48 ); ?>">MEMBER</a>
                    </li>
                    <li class="header_menuTop_list">
                        <a class="header_menuTop_link">BUY</a>
                    </li>
                    <li class="header_menuTop_list">
                        <a class="header_menuTop_link">SELL</a>
                    </li>
                    <li class="header_menuTop_list">
                        <a class="header_menuTop_link">CONTACT</a>
                    </li>
                </ul>
                <ul class="header_menuBottom">
                    <li class="header_menuBottom_list">
                        <a class="header_menuBottom_link">SEMINAR</a>
                    </li>
                    <li class="header_menuBottom_list">
                        <a class="header_menuBottom_link" href="<?php echo get_page_link( 36 ); ?>">PHILOSOPHY</a>
                    </li>
                    <li class="header_menuBottom_list">
                        <a class="header_menuBottom_link" href="<?php echo get_page_link( 38 ); ?>">MESSAGE</a>
                    </li>
                    <li class="header_menuBottom_list">
                        <a class="header_menuBottom_link" href="<?php echo get_page_link( 40 ); ?>">REASON</a>
                    </li>
                    <li class="header_menuBottom_list">
                        <a class="header_menuBottom_link">LIMITED</a>
                    </li>
                    <li class="header_menuBottom_list">
                        <a class="header_menuBottom_link">ABOUT US</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<body>
