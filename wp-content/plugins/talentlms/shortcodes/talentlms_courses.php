<?php if ($tl_login_failed) :?>
    <div class="alert alert-error">
        <?php echo implode('<br />', $tl_login_fail_message); ?>
    </div>
<?php endif; ?>

<?php if(isset($_GET['tlcourse']) && $_GET['tlcourse'] != '') :?>
    <?php $course = tl_get_course($_GET['tlcourse']); ?>
    <?php if ($course instanceof TalentLMS_ApiError) :?>
        <div class="alert alert-error">
            <?php echo $course-> getMessage(); ?>
        </div>
    <?php else: ?>
        <?php include (_BASEPATH_ . '/templates/course.php'); ?>
    <?php endif; ?>
<?php else: ?>

    <?php $courses = tl_get_courses(); ?>
    <?php if ($courses instanceof TalentLMS_ApiError) :?>
        <div class="alert alert-error">
            <?php echo $courses-> getMessage(); ?>
        </div>
    <?php endif;?>


    <?php $categories = tl_get_categories(); ?>
    <?php if ($categories instanceof TalentLMS_ApiError) :?>
        <div class="alert alert-error">
            <?php echo $categories-> getMessage(); ?>
        </div>
    <?php endif;?>

    <?php if(get_option('tl-catalog-view-mode') == 'list') : ?>
        <div class="tl-catalog">
            <?php
            if(get_option('tl-catalog-categories') == 'left') {
                $categories_side = 'tl-left';
                $courses_side = 'tl-right';
            } else if (get_option('tl-catalog-categories') == 'right') {
                $categories_side = 'tl-right';
                $courses_side = 'tl-left';
            }

            if(get_option('tl-catalog-categories') == 'left') {
                include (_BASEPATH_ . '/templates/course_list_categories.php');
                include (_BASEPATH_ . '/templates/course_list_courses.php');
            } else if (get_option('tl-catalog-categories') == 'right') {
                include (_BASEPATH_ . '/templates/course_list_courses.php');
                include (_BASEPATH_ . '/templates/course_list_categories.php');
            }
            ?>

        </div>
    <?php endif; ?>
<?php endif;?>

<?php include (_BASEPATH_ . '/templates/talentlms-login-dialog.php'); ?>


