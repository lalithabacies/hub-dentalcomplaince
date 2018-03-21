<?php
if (isset($_SESSION['talentlms_user_id'])) {
    $user = TalentLMS_User::retrieve($_SESSION['talentlms_user_id']);
    $user_courses = array();
    foreach ($user['courses'] as $c) {
        $user_courses[] = $c['id'];
    }
}
?>

<div class="tl-catalog-courses <?php echo $courses_side;?>">
    <table id="tl-catalog-list" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th style="display: none"></th>
            <th style="display: none"></th> <!-- name -->
            <th style="display: none"></th>
            <th></th><!-- price -->
            <th></th><!-- category -->
            <th></th><!-- date -->
            <th></th><!-- name -->
        </tr>
        </thead>
        <tbody>
        <?php foreach ($courses as $course): ?>
            <?php if ($course['status'] == 'active' && !$course['hide_from_catalog']): ?>

                <?php
                $courseTitle  = "<span class='tl-course-name'>".$course['name'] ."</span>";
                $courseTitle .= ($course['code']) ? " <span class='tl-course-code'>(". $course['code'] . ")</span>" : '';
                $price = (preg_replace("/\D+/", "", html_entity_decode($course['price'])) == 0) ? '-' : $course['price'];
                ?>
                <tr>
                    <td class="tl-course-thumb">
                        <a href="?tlcourse=<?php echo $course['id'];?>">
                            <img src="<?php echo $course['avatar']; ?>" title="<?php echo $courseTitle; ?>" alt="<?php echo $courseTitle; ?>" />
                        </a>
                    </td>
                    <td>
                        <a class="tl-course-title" href="?tlcourse=<?php echo $course['id'];?>"><?php echo $course['name']; ?></a>
                        <br />
                        <span style="cursor: pointer" onclick="sortByCourseCategory(<?php echo $course['category_id']; ?>)"><?php echo $course['category_name']; ?></span>
                        <div>
                            <?php echo $course['description']; ?>
                        </div>
                    </td>
                    <td class="tl-course-price-btn">

                        <?php if($price != '-') : ?>

                            <a class="btn btn-small" href="?tlcourse=<?php echo $course['id'];?>"><?php _e('More info', 'talentlms'); echo " (".$course['price'].")"; ?></a>
                        <?php else :?>
                            <a class="btn btn-small" href="?tlcourse=<?php echo $course['id'];?>"><?php _e('More info', 'talentlms'); ?></a>
                        <?php endif; ?>


                        <?php if($_SESSION['talentlms_user_id'] && in_array($course['id'], $user_courses)) : ?>
                            <span class="tl-label-own"><?php _e('You have this course', 'talentlms'); ?></span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $course['price']; ?></td>
                    <td><?php echo $course['category_id']; ?></td>
                    <td><?php echo $course['creation_date']; ?></td>
                    <td><?php echo $course['name']; ?></td>
                </tr>
            <?php endif;?>
        <?php endforeach;?>
        </tbody>
    </table>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            var listTable = jQuery('#tl-catalog-list').DataTable({
                'bLengthChange': false,
                'oLanguage': { 'sSearch': '' },
                'pageLength': '<?php echo get_option('tl-catalog-per-page') ?>',
                'columnDefs':[{
                    'targets': [ 3 ],
                    'visible': false,
                    'searchable': true
                },{
                    'targets': [ 4 ],
                    'visible': false,
                    'searchable': true
                },{
                    'targets': [ 5 ],
                    'visible': false,
                    'searchable': false
                },{
                    'targets': [ 6 ],
                    'visible': false,
                    'searchable': true
                }]
            });

            jQuery('.dataTables_filter input').attr('placeholder', '<?php _e('Search', 'talentlms'); ?>');
            jQuery('#tl-sort-by').change(function(){
                var column_index = jQuery('#tl-sort-by').val();
                var oSettings = jQuery('#tl-catalog-list').dataTable().fnSettings();
                var direction = oSettings.aaSorting[0][1];

                if(column_index == '3') {
                    jQuery('#tl-catalog-list').dataTable().fnSort([[3, 'desc']]);
                    return;
                }

                if(column_index == '5' || column_index == '6') {
                    if(direction == 'desc') {
                        jQuery('#tl-catalog-list').dataTable().fnSort([[column_index, 'asc']]);
                    } else {
                        jQuery('#tl-catalog-list').dataTable().fnSort([[column_index, 'desc']]);
                    }
                }
            });

        });

        function sortByCourseCategory(category_id){
            var listTable = jQuery('#tl-catalog-list').DataTable();
            listTable.column(4).search(category_id, true, true).draw();
        }
    </script>
</div>