<?php
$uri = service('uri');
$segment1 = $uri->getSegment(1);
$segment2 = $uri->getSegment(2);
$segment3 = $uri->getSegment(3);

if (empty($segment1)) {
    $segment1 = 'home';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('style.css');?>">
</head>
<body>
    <div class="container">
        <header>
            <h1>Admin Panel</h1>
        </header>
        <nav>
            <a href="<?= base_url('artikel');?>" class="<?= ($segment1 == 'admin' && empty($segment2)) ? 'active' : ''; ?>">Home</a>
            <a href="<?= base_url('admin/artikel');?>" class="<?= ($segment1 == 'admin' && $segment2 == 'artikel' && empty($segment3)) ? 'active' : ''; ?>">Artikel</a>
            <a href="<?= base_url('admin/artikel/add');?>" class="<?= ($segment1 == 'admin' && $segment2 == 'artikel' && $segment3 == 'add') ? 'active' : ''; ?>">Tambah Artikel</a>
        </nav>
        <section class="container">
            <section class="main">