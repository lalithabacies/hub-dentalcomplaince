<?php

$courseTitle  = $course['name'];
$courseTitle .= ($course['code']) ? "(". $course['code'] . ")" : '';
$price = (preg_replace("/\D+/", "", html_entity_decode($course['price'])) == 0) ? '-' : $course['price'];
if ($course['category_id']) {
    //$course_category = TalentLMS_Category::retrieve($course['category_id']);
    $courseCategory .= $course_category['name'];
}

if (isset($_SESSION['talentlms_user_id'])) {
    try {
        $login = TalentLMS_User::login(array('login' => $_SESSION['talentlms_user_login'], 'password' => $_SESSION['talentlms_user_pass'], 'logout_redirect' => (get_option('tl-logoutfromTL') == 'wordpress') ? get_bloginfo('wpurl') : 'http://'.get_option('talentlms-domain')));
    } catch(Exception $e) {
    }

    $user = TalentLMS_User::retrieve($_SESSION['talentlms_user_id']);
    $user_courses = array();
    foreach ($user['courses'] as $c) {
        $user_courses[] = $c['id'];
    }
}

?>

<div class="tl-single-course-container">
    <div class="tl-single-course-left-col">
        <img src="<?php echo $course['avatar']?>" title="<?php echo $courseTitle?>" alt="<?php echo $courseTitle?>" />

        <div id="tl-course-user-actions">
            <?php if ($course['shared']):?>
                <a class="btn" href="<?php echo $course['shared_url']?>"><?php _e('View course', 'talentlms');?></a>
            <?php else: ?>
                <?php if (isset($_SESSION['talentlms_user_id'])): ?>
                    <?php
                    $user = TalentLMS_User::retrieve($_SESSION['talentlms_user_id']);
                    $user_courses = array();
                    foreach ($user['courses'] as $c) {
                        $user_courses[] = $c['id'];
                    }
                    ?>
                    <?php if (!in_array($_GET['tlcourse'], $user_courses)):?>
                        <form method="post" action="<?php echo get_page_link(get_option('tl_courses_page_id'));?>">
                            <input type="hidden" name="talentlms-get-course" value="<?php echo $_GET['tlcourse'];?>"/>
                            <input type="hidden" name="talentlms-course-price" value="<?php echo $course['price'];?>"/>
                            <input type="submit" class="btn" value="<?php _e('Get this course', 'talentlms');?>"/>
                        </form>
                    <?php else: ?>
                        <?php
                        try {
                            $urltoCourse = TalentLMS_Course::gotoCourse(array('user_id' => $_SESSION['talentlms_user_id'], 'course_id' => $course['id']));
                        } catch(Exception $e) {
                        }
                        ?>
                        <a class="btn" href="<?php echo tl_talentlms_url($urltoCourse['goto_url']); ?>" target="_blank"><?php _e('View this course', 'talentlms'); ?></a>
                    <?php endif;?>
                <?php else:?>
                    <a class="btn" id="tl-login-dialog-opener" href="javascript:void(0);"><?php _e('Login to get this course', 'talentlms');?></a>
                <?php endif;?>
            <?php endif;?>

            <br />
            <?php _e('or', 'talentlms'); ?>
            <a href="javascript:history.go(-1);"><?php _e('Go back', 'talentlms');?></a>

        </div>

    </div>
    <div class="tl-single-course-right-col">
        <h2><span><?php echo $courseTitle; ?></span></h2>
        <h4><span><?php echo $courseCategory; ?></span></h4>

        <fieldset>
            <legend><?php _e('Description', 'talentlms'); ?></legend>
            <p><?php echo $course['description']; ?></p>
        </fieldset>

        <fieldset>
            <legend><?php _e('Content', 'talentlms');?></legend>
            <ul>
                <?php if(isset($_SESSION['talentlms_user_id'])):?>
                    <?php foreach ($course['units'] as $unit) :?>
                        <li>
                            <i class="<?php echo getUnitIconClass($unit['type']); ?>"></i>
                            <a href="<?php echo tl_talentlms_url($unit['url']) . tl_get_login_key($login['login_key']); ?>" target="_blank"><?php echo $unit['name'];?></a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php foreach ($course['units'] as $unit) :?>
                        <li>
                            <i class="<?php echo getUnitIconClass($unit['type']); ?>"></i>
                            <span><?php echo $unit['name'];?></span>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </fieldset>

        <fieldset>
            <legend><?php _e('Completion rules', 'talentlms');?></legend>
            <ul>
                <?php foreach ($course['rules'] as $rule) :?>
                    <i class="fa fa-flag"></i>
                    <span><?php echo $rule; ?></span>
                <?php endforeach; ?>
            </ul>
        </fieldset>
    </div>
</div>
