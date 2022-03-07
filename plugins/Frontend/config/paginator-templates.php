<?php
return [
    'nextActive' => '<li class="page-item"><a class="page-link" href="#" aria-label="' . __d('frontend', 'Next') . '"><span aria-hidden="true"><i class="uil uil-arrow-right"></i></span></a></li>',
    'nextDisabled' => '<li class="page-item disabled"><a class="page-link" href="#" aria-label="' . __d('frontend', 'Next') . '"><span aria-hidden="true"><i class="uil uil-arrow-right"></i></span></a></li>',
    'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}" aria-label="' . __d('frontend', 'Previous') . '"><span aria-hidden="true"><i class="uil uil-arrow-left"></i></span></a></li>',
    'prevDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}" aria-label="' . __d('frontend', 'Previous') . '"><span aria-hidden="true"><i class="uil uil-arrow-left"></i></span></a></li>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a class="page-link" href="{{url}}">{{text}}</a></li>'
];