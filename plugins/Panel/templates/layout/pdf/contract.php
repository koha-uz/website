<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->Html->charset() ?>
        <title><?= $this->fetch('title') ?></title>

        <style type="text/css">
            html {
                font-family: 'Times New Roman', Times, serif;
                font-size: 13pt;
                text-align: justify;
            }
            h1, h2 {
                text-align: center;
            }
            h1 {
                font-size: 16pt;
            }
            h2 {
                font-size: 14pt;
                margin: 15pt;
            }

            small {
                font-size: 12pt;
                font-style: italic;
            }

            p {
                margin: 3pt;
            }

            ul {
                list-style: none;
                padding-left: 15pt;
                font-size: 12pt;
            }

            ul li {
                margin-bottom: 3pt;
            }

            ul li:before {
                content:  "- ";
                position: relative;
                right: 5pt;
            }

            hr {
                border: 0px;
                border-bottom: 1px dotted #ccc;
            }

            .new-page {
                page-break-before: always;
            }
            .text-center {
                text-align: center;
            }
            .text-left {
                text-align: left;
            }
            .text-right: {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <?= $this->fetch('content') ?>
    </body>
</html>
