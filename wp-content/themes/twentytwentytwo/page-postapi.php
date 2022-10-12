<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

</head>
<style>
<?php include('page-postapi.css') ?>
</style>

<body>
    <div class="nar_menu">
        <div class="menu_left">
            <img src="https://vov.vn/themes/custom/vovvn/images/logo_meta_home.jpg" alt="">
            <p>Hôm nay là ngày 05/10/2002</p>
        </div>

        <div class="menu_midle">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-tiktok"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
            <a href="#"><i class="fa-brands fa-skype"></i></a>
            <p>Nghe & xem <i class="fa-solid fa-circle-chevron-right"></i></p>

        </div>
        <div class="menu_right">
            <p>English</p>
            <p><input type="text"><i class="fa-solid fa-magnifying-glass"></i></p>
        </div>

    </div>
    <div class="navbar_menu">
        <p><i class="fa-solid fa-house"></i>Chính trị </p>
        <p>Xã hội</p>
        <p>Thế giới</p>
        <p>Kinh tế</p>
        <p>Thể thao</p>
        <p>Văn hóa</p>
        <p>Phát luật</p>
        <p>Du lịch</p>
        <p>Quân sự - Quốc phòng</p>
        <p>Sức khỏe</p>
        <p>Đời sống</p>
        <p>Postcast <i class="fa-solid fa-bars"></i></p>
    </div>
    <div class="container">
        <?php

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://62904135665ea71fe12f6eef.mockapi.io/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);


        $data = json_decode($response);

        // echo "<b>Total APIs: $data->count </b><br>";
        // $entries = $data->entries[0]->API;
        ?>
        <div class="post-container">
            <div class="hot-post">
                <?php
                foreach ($data as $value) {
                    if ($value->size == "large") { ?>
                <div class="large-post">
                    <img src="<?= $value->img ?>" class="large-img" alt="...">
                    <h2 class="large-title"><?= $value->title ?></h2>
                </div>
                <?php } ?>

                <?php } ?>
                <?php
                foreach ($data as $value) {
                ?>
                <div class="list-post">
                    <p class="list-title"><?= $value->title ?></p>
                </div>
                <?php } ?>

            </div>
            <div class="medium-post">
                <?php
                foreach ($data as $value) {
                    if ($value->size == "medium") { ?>
                <img class="medium-img" src="<?= $value->img ?>" alt="">
                <p class="medium-title"><?= $value->title ?></p>
                <?php } ?>
                <?php } ?>
            </div>
            <div class="new-post">
                <?php
                foreach ($data as $value) {
                    if ($value->size == "small") { ?>
                <div class="small-post">
                    <img class="small-img" src="<?= $value->img ?>" alt="">
                    <p class="small-title"><?= $value->title ?></p>
                </div>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>