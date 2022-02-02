<?php $this->append('script-code'); ?>
<script>
$(document).ready(function() {
    function createFields(key, template)
    {
        var container = $('#' + key + '-container');
        var rows      = $('#' + key + '-rows');
        var quantity  = rows.children('div.row').length;
        var template  = template.replace(/&#039;/g, "'");

        container.on('click', 'button', function(e) {
            e.preventDefault();
            if (rows.children('div.row').length >= 5) {
                return true;
            }

            quantity++;
            rows.append(
                template.replace(/%id%/g, quantity)
            );
            rows.find(':input').inputmask();
        });

        rows.on('click', 'a.remove', function(e) {
            e.preventDefault();
            $(this).closest('div.row').remove();
        });
    }

    createFields('phone-numbers', '<?= $this->PhoneNumbers->createFields('%id%') ?>');
    createFields('email-addresses', '<?= $this->EmailAddresses->createFields('%id%') ?>');
});
</script>
<?php $this->end(); ?>

<div class="row">
    <div class="col-12 col-md-6">
        <div id="panel-5" class="panel shadow-0" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Phone numbers') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content" id="phone-numbers-container">
                    <div id="phone-numbers-rows">
                        <?php
                        if ($entity->has('phone_numbers')) {
                            foreach($entity->phone_numbers as $key => $phoneNumber) {
                                echo $this->PhoneNumbers->createFields($key, $phoneNumber);
                            }
                        }
                        ?>
                    </div>
                    <button type="button" class="btn btn-secondary btn-block btn-sm waves-effect waves-themed">
                        <?= __d('panel', 'Add more') ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div id="panel-6" class="panel shadow-0" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Email addresses') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content" id="email-addresses-container">
                    <div id="email-addresses-rows">
                        <?php
                        if ($entity->has('email_addresses')) {
                            foreach($entity->email_addresses as $key => $emailAddress) {
                                echo $this->EmailAddresses->createFields($key, $emailAddress);
                            }
                        }
                        ?>
                    </div>
                    <button type="button" class="btn btn-secondary btn-block btn-sm waves-effect waves-themed">
                        <?= __d('panel', 'Add more') ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
