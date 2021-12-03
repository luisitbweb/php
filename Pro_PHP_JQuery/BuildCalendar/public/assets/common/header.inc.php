<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $page_title; ?></title>
        <?php foreach ($css_files as $css) : ?>
        <link rel="stylesheet" type="text/css" media="screen,projection" href="assets/css/<?php echo $css; ?>" />
        <?php endforeach;?>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>