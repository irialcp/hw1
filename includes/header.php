<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$logged_in = isset($_SESSION['user_id']);
$username = $logged_in ? htmlspecialchars($_SESSION['username']) : '';
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Storror Clone</title>
    <link rel="stylesheet" href="css/header.css">
    <script src="main.js" defer></script>
</head>

<body>
    <header id="header">
        <div id="hidden_header">
            <div id="menu_button">
                <button class="button">
                    <svg xmlns="http://www.w3.org/2000/svg" role="presentation" stroke-width="1" focusable="false" width="22" height="22" class="icon icon-hamburger" viewBox="0 0 22 22 "color="white">
                    <path d="M1 5h20M1 11h20M1 17h20" stroke="currentColor" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
            <div class="overlay"></div>
            <div id="wrapper">
                <div id="menu-wrap">
                    <button id="close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" viewBox="0 0 24 24" color="black">
                            <path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/>
                            <path d="M0 0h24v24h-24z" fill="none"/>
                        </svg>
                    </button>
                    <ul class="list">
                        <li><a href="/shop.php">NEW</a></li>
                        <li><a href="/shop.php">CLOTHING</a></li>
                        <li><a href="/shop.php">ACCESSORIES</a></li>
                        <li><a href="/shop.php">GIFT CARD</a></li>
                        <li><a href="/shop.php">THE SAFE</a></li>
                    </ul>
                    <ul class="list">
                        <li><a href="/team.php">TEAM</a></li>
                        <li><a href="/team.php">VIDEO GAME</a></li>
                        <li><a href="/team.php">SUPPORT</a></li>
                    </ul>
                    <ul class="social-media">
                        <li><svg fill="#ffffff" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 512 512" xml:space="preserve" stroke="#ffffff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g id="7935ec95c421cee6d86eb22ecd11b7e3">
                                        <path style="display: inline;" d="M283.122,122.174c0,5.24,0,22.319,0,46.583h83.424l-9.045,74.367h-74.379 c0,114.688,0,268.375,0,268.375h-98.726c0,0,0-151.653,0-268.375h-51.443v-74.367h51.443c0-29.492,0-50.463,0-56.302 c0-27.82-2.096-41.02,9.725-62.578C205.948,28.32,239.308-0.174,297.007,0.512c57.713,0.711,82.04,6.263,82.04,6.263 l-12.501,79.257c0,0-36.853-9.731-54.942-6.263C293.539,83.238,283.122,94.366,283.122,122.174z"> </path>
                                    </g>
                                </g>
                            </svg></li>
                        <li><svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18ZM12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z" fill="#ffffff"></path>
                                    <path d="M18 5C17.4477 5 17 5.44772 17 6C17 6.55228 17.4477 7 18 7C18.5523 7 19 6.55228 19 6C19 5.44772 18.5523 5 18 5Z" fill="#ffffff"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65396 4.27606C1 5.55953 1 7.23969 1 10.6V13.4C1 16.7603 1 18.4405 1.65396 19.7239C2.2292 20.8529 3.14708 21.7708 4.27606 22.346C5.55953 23 7.23969 23 10.6 23H13.4C16.7603 23 18.4405 23 19.7239 22.346C20.8529 21.7708 21.7708 20.8529 22.346 19.7239C23 18.4405 23 16.7603 23 13.4V10.6C23 7.23969 23 5.55953 22.346 4.27606C21.7708 3.14708 20.8529 2.2292 19.7239 1.65396C18.4405 1 16.7603 1 13.4 1H10.6C7.23969 1 5.55953 1 4.27606 1.65396C3.14708 2.2292 2.2292 3.14708 1.65396 4.27606ZM13.4 3H10.6C8.88684 3 7.72225 3.00156 6.82208 3.0751C5.94524 3.14674 5.49684 3.27659 5.18404 3.43597C4.43139 3.81947 3.81947 4.43139 3.43597 5.18404C3.27659 5.49684 3.14674 5.94524 3.0751 6.82208C3.00156 7.72225 3 8.88684 3 10.6V13.4C3 15.1132 3.00156 16.2777 3.0751 17.1779C3.14674 18.0548 3.27659 18.5032 3.43597 18.816C3.81947 19.5686 4.43139 20.1805 5.18404 20.564C5.49684 20.7234 5.94524 20.8533 6.82208 20.9249C7.72225 20.9984 8.88684 21 10.6 21H13.4C15.1132 21 16.2777 20.9984 17.1779 20.9249C18.0548 20.8533 18.5032 20.7234 18.816 20.564C19.5686 20.1805 20.1805 19.5686 20.564 18.816C20.7234 18.5032 20.8533 18.0548 20.9249 17.1779C20.9984 16.2777 21 15.1132 21 13.4V10.6C21 8.88684 20.9984 7.72225 20.9249 6.82208C20.8533 5.94524 20.7234 5.49684 20.564 5.18404C20.1805 4.43139 19.5686 3.81947 18.816 3.43597C18.5032 3.27659 18.0548 3.14674 17.1779 3.0751C16.2777 3.00156 15.1132 3 13.4 3Z" fill="#ffffff"></path>
                                </g>
                            </svg></li>
                        <li></li>
                    </ul>
                </div>
            </div>
            <div id="hidden_img">
                <a href="index.php"><img src="public/logo.png" alt="storrorlogo" width="60"></a>
            </div>
            <nav id="hidden_nav">
                <a href="/storror_clone/cartPage.php">
                    <svg xmlns="http://www.w3.org/2000/svg" role="presentation" stroke-width="1" focusable="false" width="22" height="22" class="icon icon-cart" viewBox="0 0 22 22">
                        <path d="M9.182 18.454a.91.91 0 1 1-1.818 0 .91.91 0 0 1 1.818 0Zm7.272 0a.91.91 0 1 1-1.818 0 .91.91 0 0 1 1.819 0Z" fill="currentColor"/>
                        <path d="M5.336 6.636H21l-3.636 8.182H6.909L4.636 3H1m8.182 15.454a.91.91 0 1 1-1.818 0 .91.91 0 0 1 1.818 0Zm7.272 0a.91.91 0 1 1-1.818 0 .91.91 0 0 1 1.819 0Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <?php if ($logged_in): ?>
                    <button id="logout_button" title="Logout">
                         <svg xmlns="http://www.w3.org/2000/svg" role="presentation" stroke-width="1" focusable="false" width="22" height="22" class="icon icon-logout" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                </button>
                <?php else: ?>
                    <a href="/storror_clone/login.php" title="Login">
                        <svg xmlns="http://www.w3.org/2000/svg" role="presentation" stroke-width="1" focusable="false" width="22" height="22" class="icon icon-account" viewBox="0 0 22 22">
                            <circle cx="11" cy="7" r="4" fill="none" stroke="currentColor"/>
                            <path d="M3.5 19c1.421-2.974 4.247-5 7.5-5s6.079 2.026 7.5 5" fill="none" stroke="currentColor" stroke-linecap="round"/>
                        </svg>
                    </a>
                <?php endif; ?>
            </nav>
        </div>
        <div id="header_desktop">
            <nav class="nav">
                <a id="yellow" href="shop.php">NEW</a>
                <a href="shop.php">CLOTHING</a>
                <a href="shop.php">ACCESSORIES</a>
                <a href="https://storror.com/en-it/collections/new-releases">GIFT CARD</a>
                <a href="https://storror.com/en-it/collections/new-releases">THE SAFE</a>
            </nav>
            <div id="logo">
                <a id="logo" href="/storror_clone/index.php"><img src="/storror_clone/public/logo.png" alt="storrorlogo" width="60"></a>
            </div>
            <nav class="nav">
                <a href="/storror_clone/team.php">TEAM</a>
                <a href="team.php">VIDEO GAME</a>
                <a href="team.php">SUPPORT</a>
                <div id="icons_nav">
                    <a href="/storror_clone/cartPage.php"><svg xmlns="http://www.w3.org/2000/svg" role="presentation" stroke-width="1" focusable="false" width="22" height="22" class="icon icon-cart" viewBox="0 0 22 22">
                        <path d="M9.182 18.454a.91.91 0 1 1-1.818 0 .91.91 0 0 1 1.818 0Zm7.272 0a.91.91 0 1 1-1.818 0 .91.91 0 0 1 1.819 0Z" fill="currentColor"/>
                        <path d="M5.336 6.636H21l-3.636 8.182H6.909L4.636 3H1m8.182 15.454a.91.91 0 1 1-1.818 0 .91.91 0 0 1 1.818 0Zm7.272 0a.91.91 0 1 1-1.818 0 .91.91 0 0 1 1.819 0Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg></a>
                    <?php if ($logged_in): ?>
                        <button id="logout_button_desktop" title="Logout">
                        <svg xmlns="http://www.w3.org/2000/svg" role="presentation" stroke-width="1" focusable="false" width="22" height="22" class="icon icon-logout" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </button>
                    <?php else: ?>
                        <a href="/storror_clone/login.php" title="Login">
                            <svg xmlns="http://www.w3.org/2000/svg" role="presentation" stroke-width="1" focusable="false" width="22" height="22" class="icon icon-account" viewBox="0 0 22 22">
                                <circle cx="11" cy="7" r="4" fill="none" stroke="currentColor"/>
                                <path d="M3.5 19c1.421-2.974 4.247-5 7.5-5s6.079 2.026 7.5 5" fill="none" stroke="currentColor" stroke-linecap="round"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                    
                </div>
            </nav>
        </div>
    </header>
</body>
</html>