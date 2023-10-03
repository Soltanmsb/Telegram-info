<?php
if(isset($_GET['username'])){
    $username = $_GET['username'];
    
    $url = "https://t.me/{$username}";

    $html = file_get_contents($url);

    $pattern = '/<span dir="auto">([^<]+)<\/span>/';
    preg_match($pattern, $html, $matches);
    $usernameTitle = $matches[1] ?? "Title Not Found";

    $pattern = '/<div class="tgme_page_extra">([^<]+)<\/div>/';
    preg_match($pattern, $html, $matches);
    $sub = $matches[1] ?? "private";

    $pattern = '/<img class="tgme_page_photo_image"[^"]+src="([^"]+)"/';
    preg_match($pattern, $html, $matches);
    $profileImage = $matches[1] ?? "Image Not Found";

    $pattern = '/<div class="tgme_page_description[^"]+">\s*(.*?)\s*<\/div>/';
    preg_match($pattern, $html, $matches);
    $bio = $matches[1] ?? "Bio Not Found";

    $response = [
        "ok" => true,
        "Channel" => "T.me/S0ltanmsb",
        "Developer" => "T.me/Mr_D4rk",
        "result" => [
            "username" => $username,
            "profile_pic" => $profileImage,
            "title" => $usernameTitle,
            "bio" => $bio,
            "subscribers" => $sub
        ]
    ];

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
?>
