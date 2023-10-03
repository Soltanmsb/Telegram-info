<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Telegram User Info</title>
    <link rel="icon" href="https://dl.soltanmsb.xyz/picture/web-proxy/logo.png">
    <link rel="stylesheet" href="./style.css">
    <script src="./mine.js"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
<form method="post" id="searchForm">
    <div class="wrapper">
        <div class="search_box">
            <div class="dropdown">
                <div class="default_option">Telegram</div>
            </div>
            <div class="search_field">
                <input type="text" class="input" id="username" name="username" placeholder="Search...">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>
</form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $url = "http://api.soltanmsb.xyz/telegram-info/api.php?username=$username";
        $json_data = file_get_contents($url);
        $data = json_decode($json_data, true);

        if ($data['ok']) {
            $username = $data['result']['username'];
            $profile_pic = $data['result']['profile_pic'];
            $title = $data['result']['title'];
            $sub = $data['result']['subscribers'];
            $bio = $data['result']['bio'];
        ?>
            <div class="user-info">
                <img src="<?php echo $profile_pic; ?>" alt="Profile Picture" width="150"><br>
                <h1><?php echo "T.me/".$username; ?></h1>
                <p class="info-name"><?php echo htmlentities($title); ?></p>
                <p class="info-bio"><?php echo htmlentities($bio); ?></p>
                <p class="info-type"><?php echo $sub; ?></p><br><br>
            </div>
        <?php
        } else {
            echo "Error: Unable to retrieve data.";
        }
    }
    ?>
</body>
<script>
    document.getElementById("username").addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("searchForm").submit();
        }
    });
</script>
</html>
