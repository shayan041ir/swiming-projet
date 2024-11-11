
<head>
    <style>
        @font-face {
            font-family: "vazir";
            src: url(/font/vazir/vazir.eot) format("eot");
            src: url(/font/vazir/vazir.ttf) format("ttf");
            src: url(/font/vazir/vazir.woff) format("woff");
            src: url(/font/vazir/vazir.woff2) format("woff2");
        }

        /* ========================================================================= */
        header {
            background: #000036;
            padding-top: 0%;
            min-height: 70px;
            border-bottom: #77b5fe 3px solid;
        }

        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
            margin-bottom: 0%;
        }

        header ul {
            padding: 0;
            list-style: none;
        }

        header li {
            float: right;
            display: inline;
            padding: 0 20px 0 20px;
        }

        header .logo img {
            height: 100px;
            float: left;
            margin: 0%;
            padding: 0%;
        }

        header nav {
            float: right;
            margin-top: 10px;
        }
    </style>
</head>
<header>
    <div class="container"> 
        <div class="logo">
            <img src="../ap/upload/img/nemayedakheli/aquaParkLogo.png" alt="Aqua Park Logo">
        </div>
        <nav>
            <ul>
                <li><a href="http://localhost/swiming%20projet/ap/index.php">صفحه اصلی</a></li>
                <li><a href="#about">درباره استخر</a></li>
                <li><a href="http://localhost/swiming%20projet/ap/servises.php">خدمات و امکانات</a></li>
                <li><a href="http://localhost/swiming%20projet/ap/buy_ticket.php">رزرو بلیط</a></li>
                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $user_type = $_SESSION['user_type']; 

                    if ($user_type == 'admin') {
                        echo '<li><a href="http://localhost/swiming%20projet/ap/admin_dashboard.php">پنل ادمین</a></li>';
                    } else {
                        echo '<li><a href="http://localhost/swiming%20projet/ap/dashboard.php">داشبورد</a></li>';
                    }
                    echo '<li><a href="http://localhost/swiming%20projet/ap/logout.php">خروج</a></li>';
                } else {
                    echo '<li><a href="http://localhost/swiming%20projet/ap/login.php">ثبت نام / ورود</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</header>
