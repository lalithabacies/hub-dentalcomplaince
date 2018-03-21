<div class="tl-catalog-categories <?php echo $categories_side;?>">
    <?php $Catoption = 'roukou' ; ?>
    <?php if($Catoption == 'dropdown'): ?>

        <!-- @TODO make this work -->
        <select id="tl-category-filter" name="tl-category-filter">
            <option value="-1"><?php _e('All courses', 'talentlms');?></option>

            <?php foreach($categories as $category) : ?>
                <option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
            <?php endforeach; ?>
        </select>

        <script type="text/javascript">
            jQuery('#tl-category-filter').change(function () {
                var myTable = jQuery('#tl-catalog-list').DataTable();
                var categoryId = jQuery('#tl-category-filter').val();
                if(categoryId == -1) {
                    jQuery('#tl-catalog-list').dataTable().fnFilter('', 4);
                } else {
                    myTable.column(4).search(categoryId, true, true).draw();
                }
            })
        </script>

    <?php else: ?>

        <ul>
            <span><a id="tl-all-categories-filter" href="javascript:void(0);"><?php _e('All courses', 'talentlms'); ?></a></span>
            <?php foreach($categories as $category) : ?>
                <li>
                    <input class="tl-category-filter" type="checkbox" name="tl-category-filter" value="<?php echo $category['id']; ?>"/>
                    <?php echo $category['name'] . " (" . $category['courses_count'] . ")"; ?> <br />
                </li>
            <?php endforeach; ?>
        </ul>

        <script type="text/javascript">
            jQuery('.tl-category-filter').click(function(){
                var selected_filter = new Array();
                jQuery('.tl-category-filter').each(function() {
                    if(this.checked) {
                        selected_filter.push(jQuery(this).val());
                    }
                });
                if(selected_filter.length > 0) {
                    var myTable = jQuery('#tl-catalog-list').DataTable();
                    myTable.column(4).search(selected_filter.join('|'), true, true).draw();
                } else {
                    jQuery('#tl-catalog-list').dataTable().fnFilter('', 4)
                }
            });

            jQuery('#tl-all-categories-filter').click(function(){
                jQuery('.tl-category-filter').each(function() {
                    jQuery(this).attr('checked', false);
                });
                jQuery('#tl-catalog-list').dataTable().fnFilter('', 4);
            });
        </script>

        <hr />

        <div class="tl-order-by-filter">
            <span><?php _e('Sort by', 'talentlms'); ?></span>
            <select id="tl-sort-by" name="tl-sort-by">
                <option value="6"><?php _e('Name', 'talentlms')?></option>
                <option value="5"><?php _e('Date', 'talentlms')?></option>
                <option value="3"><?php _e('Price', 'talentlms')?></option>
            </select>
        </div>

    <?php endif; ?>
</div>