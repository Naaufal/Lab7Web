<?php
$uri = service('uri');
$segment = $uri->getSegment(1);

if (empty($segment)) {
    $segment = 'home';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('style.css');?>">
</head>
<body>
    <div id="container">
        <header>
            <h1>Layout Sederhana</h1>
        </header>
        <nav>
            <a href="<?= base_url('/');?>" class="<?= ($segment == 'home') ? 'active' : ''; ?>">Home</a>
            <a href="<?= base_url('/artikel');?>" class="<?= ($segment == 'artikel') ? 'active' : ''; ?>">Artikel</a>
            <a href="<?= base_url('/about');?>" class="<?= ($segment == 'about') ? 'active' : ''; ?>">About</a>
            <a href="<?= base_url('/contact');?>" class="<?= ($segment == 'contact') ? 'active' : ''; ?>">Kontak</a>
            <a href="<?= base_url('/admin/artikel');?>" class="<?= ($segment == 'admin') ? 'active' : ''; ?>">Admin Dashboard</a>
        </nav>
        <section id="wrapper">
            <section id="main">