<html>

<head>

    <style>
        /* Add some styling for the video container */
        .video-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            background-color: #111;
        }

        /* Add some styling for the video element */
        video {
            width: 65%;
            /* height: 7%; */
        }

        body {
            background-color: #111;
            margin: 0px;
        }
    </style>
</head>

<body>

<?php
$vuln_name = $_GET['v'];
if ($vuln_name=='brute'){
    $yt_url = "https://www.youtube.com/embed/Qe3GBnN3RiY";
} elseif ($vuln_name == 'captcha') {
    $yt_url = "https://www.youtube.com/embed/dQw4w9WgXcQ";
} elseif ($vuln_name == 'csp') {
    $yt_url = "https://www.youtube.com/embed/SYAkwP5Q-8U";
} elseif ($vuln_name == 'csrf') {
    $yt_url = "https://www.youtube.com/embed/zVziF4skGMk";
} elseif ($vuln_name == 'exec') {
    $yt_url = "https://www.youtube.com/embed/dQw4w9WgXcQ";
} elseif ($vuln_name == 'fi') {
    $yt_url = "https://www.youtube.com/embed/-w8-ezZj5ec";
} elseif ($vuln_name == 'html_r') {
    $yt_url = "https://www.youtube.com/embed/6gHKrpA_2nQ";
} elseif ($vuln_name == 'javascript') {
    $yt_url = "https://www.youtube.com/embed/pu3ECdNsHgo";
} elseif ($vuln_name == 'sqli') {
    $yt_url = "https://www.youtube.com/embed/YyXmw9lKgK0";
} elseif ($vuln_name == 'sqli_blind') {
    $yt_url = "https://www.youtube.com/embed/jSpxpk6LlEE";
} elseif ($vuln_name == 'upload') {
    $yt_url = "https://www.youtube.com/embed/hdn264YoHlc";
} elseif ($vuln_name == 'weak_id') {
    $yt_url = "https://www.youtube.com/embed/63UN4SYeC5M";
} elseif ($vuln_name == 'xss_d') {
    $yt_url = "https://www.youtube.com/embed/qrJKRVGtZ78";
} elseif ($vuln_name == 'xss_r') {
    $yt_url = "https://www.youtube.com/embed/h1_YivssV68";
} elseif ($vuln_name == 'xss_s') {
    $yt_url = "https://www.youtube.com/embed/hxaoc42V2kQ";
}


echo "

<h1 style=\"color: rgb(32, 135, 3); text-align:center; background-color:#222; padding: 20px; \">Solution Video</h1>
<div class=\"video-container\">
    <iframe width=\"924\" height=\"520\" src=\"{$yt_url}\" title=\"HackCytes video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>
</div>
<button style=\"width: 95px;float: right;margin: 10px 10%; padding: 10px 10px 10px 10px;\"><a href=\"javascript:history.go(-1)\" style=\"text-decoration: none; color: black; \">Go Back</a></button>

"; 
?>

</body>
</html>
