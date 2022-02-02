<div class="row mb-3 js-subject-container" data-subject-key="<?= $subjectKey ?>">
    <div class="col-md-10 mb-2 mb-md-0">
        <?php
        if (isset($studyCourseSubject) && !empty($studyCourseSubject)) {
            echo $this->Form->control("study_course_subjects.{$subjectKey}.id", [
                'type' => 'hidden',
                'value' => $studyCourseSubject->id
            ]);
        } elseif (isset($semester) && !empty($semester)) {
            echo $this->Form->control("study_course_subjects.{$subjectKey}.semester", [
                'type' => 'hidden',
                'value' => $semester
            ]);
        }
        echo $this->Form->control("study_course_subjects.{$subjectKey}.study_subject_id", [
            'label' => ['class' => 'sr-only'],
            'class' => 'form-control select2'
        ]);
        ?>
    </div>
    <div class="col-md-2 mb-2 mb-md-0">
        <?php
        echo $this->Form->control("study_course_subjects.{$subjectKey}.credit", [
            'label' => ['class' => 'sr-only'],
            'placeholder' => __d('panel', 'Credit')
        ]);
        ?>
    </div>
</div>
