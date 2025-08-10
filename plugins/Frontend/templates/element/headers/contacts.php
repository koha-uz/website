<?php
use Cake\Core\Configure;
?>

<div class="bg-primary text-white fw-bold fs-13 mb-0 d-none d-lg-block">
    <div class="container py-1 d-md-flex flex-md-row">
        <div class="d-flex flex-row align-items-center">
            <div class="icon text-white fs-18 mt-1 me-2"> <i class="uil uil-location-pin-alt"></i></div>
            <address class="mb-0">
                <a href="<?= Configure::read('Settings.Contacts.address_google') ?>" target="_blank" class="link-white hover">
                    <?= Configure::read('Settings.Contacts.address') ?>
                </a>
            </address>
        </div>
        <div class="d-flex flex-row align-items-center me-6 ms-auto">
            <div class="icon text-white fs-18 mt-1 me-2"> <i class="uil uil-phone-volume"></i></div>
            <p class="mb-0">
                <a href="tel:<?= Configure::read('Settings.Contacts.telephone') ?>" class="link-white hover">
                    <?= Configure::read('Settings.Contacts.telephone') ?>
                </a>
            </p>
        </div>
        <div class="d-flex flex-row align-items-center">
            <div class="icon text-white fs-18 mt-1 me-2"> <i class="uil uil-message"></i></div>
            <p class="mb-0">
                <a href="mailto:<?= Configure::read('Settings.Contacts.email') ?>" class="link-white hover">
                    <?= Configure::read('Settings.Contacts.email') ?>
                </a>
            </p>
        </div>
    </div>
    <!-- /.container -->
</div>