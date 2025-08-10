<div class="blog grid grid-view">
    <div class="row isotope gx-md-8 gy-8 mb-8">
        <?php
        foreach($posts as $post) {
            echo $this->element('Posts/post', ['post' => $post]);
        }
        ?>
    </div>
</div>