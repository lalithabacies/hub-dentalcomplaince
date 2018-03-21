<div class="wrap">
    <h2><i class="fa fa-check-square-o"></i>&nbsp;<?php _e('Integrations', 'talentlms'); ?></h2>


    <h3><?php _e('WooCommerce', 'talentlms'); ?></h3>

    <form id="talentlms-woocommerce-form" name="talentlms-woocommerce-form" method="post" action="<?php echo admin_url('admin.php?page=talentlms-integrations'); ?>">
        <input type="hidden" name="action" value="tl-woocommerce" />
        <input type="hidden" name="tl-integrate-woocommerce" value="1">
        <table class="form-table">
            <tr>
                <th scope="row" class="form-field">
                    <label><?php _e('TalentLMS Users & WooCommerce Customers', 'talentlms'); ?> </label>
                </th>
                <td class="form-field">
                    <?php if(get_option('tl-integrate-woocommerce-signup')) : ?>
                        <input id="tl-integrate-woocommerce-signup" type="checkbox" name="tl-integrate-woocommerce-signup" checked="checked" value="1">
                        <span class="description"><?php _e("Create a new TalentLMS user each time a new WooCommerece customer is created?", 'talentlms'); ?></span>

                    <?php else : ?>
                        <input id="tl-integrate-woocommerce-signup" type="checkbox" name="tl-integrate-woocommerce-signup" value="1">
                        <span class="description"><?php _e("Create a new TalentLMS user each time a new WooCommerece customer is created?", 'talentlms'); ?></span>
                    <?php endif; ?>

                    <div id="tl-integrate-woocommerce-signup-cf" style="<?php echo (get_option('tl-integrate-woocommerce-signup')) ? 'display: block;' : 'display: none;';  ?>">
                        <?php $custom_fields = tl_get_custom_fields(); ?>
                        <?php if (is_array($custom_fields)) : ?>
                            <br />
                            <p><?php _e('Match up your TalentLMS custom fields with customer information', 'talentlms	'); ?></p>
                            <br />

                            <?php $wcoptions = array(
                                "" => "",
                                "billing_first_name" => "Billing first name",
                                "billing_last_name" => "Billing last name",
                                "billing_company" => "Billing company",
                                "billing_email" => "Billing email",
                                "billing_phone" => "Billing phone",
                                "billing_country" => "Billing country",
                                "billing_address_1" => "Billing address 1",
                                "billing_address_2" => "Billing address 2",
                                "billing_city" => "Billing city",
                                "billing_state" => "Billing state",
                                "billing_postcode" => "Billing postcode"
                            ); ?>

                            <?php foreach($custom_fields as $custom_field) : ?>
                                <?php echo $custom_field['name']; ?> :
                                <select id="tl-woocom-<?php echo $custom_field['key']; ?>" name="tl-woocom-<?php echo $custom_field['key']; ?>">
                                    <?php foreach ($wcoptions as $key => $option) : ?>
                                        <option <?php echo (get_option('tl-woocom-'.$custom_field['key']) == $key) ? 'selected' : ''; ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br />
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>

            <tr>
                <th scope="row" class="form-field"><?php _e("TalentLMS courses/categories & WooCommerce products/categories ", 'talentlms'); ?></th>
                <td class="form-field">
<!--                    <input id="tl-integrate-woocommerce-sync" type="checkbox" name="tl-integrate-woocommerce-sync" value="1">-->
<!--                    <span class="description">--><?php //_e("Create WooCommerce product and categories from TalentLMS courses and categories", 'talentlms'); ?><!--</span>-->
                    <table class="widefat striped" width="80%">
                        <thead>
                        <tr>
                            <td><?php _e('TalentLMS Course', 'talentlms'); ?></td>
                            <td style="text-align: center"><a id="tl-integrate-all" href="javascript:void(0);"><?php _e('Select All', 'talentlms');?></a></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($courses as $course) : ?>
                            <tr>
                                <td><?php echo $course['name']; ?></td>
                                <td style="text-align: center">
                                    <?php if(in_array($course['id'], $integrated_courses)): ?>
                                        <input class="tl-course-to-integrate" type="checkbox" name="tl-integrate-courses[]" checked value="<?php echo $course['id']; ?>"/>
                                    <?php else: ?>
                                        <input class="tl-course-to-integrate" type="checkbox" name="tl-integrate-courses[]" value="<?php echo $course['id']; ?>"/>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <?php _e('Force integration', 'talentlms');?>
                                    <input type="checkbox" name="tl-force-integrate" value="1"/>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>

            <tr>
                <th scope="row" class="form-field"></th>
                <td class="form-field">
                    <p class="submit">
                        <input class="button-primary" type="submit" name="Submit" value="<?php _e('Integrate', 'talentlms') ?>" />
                    </p>
                </td>
            </tr>
        </table>

    </form>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#tl-integrate-woocommerce-signup').change(function(){
                if(jQuery('#tl-integrate-woocommerce-signup').is(':checked')) {
                    jQuery('#tl-integrate-woocommerce-signup-cf').show();
                } else {
                    jQuery('#tl-integrate-woocommerce-signup-cf').hide();
                }
            });

            
            jQuery('#tl-integrate-all').toggle(function () {
                jQuery('.tl-course-to-integrate').attr('checked','checked');
                jQuery(this).html('Unselect all');
            }, function () {
                jQuery('.tl-course-to-integrate').removeAttr('checked');
                jQuery(this).html('Select all');
            });
            
        });
    </script>



</div>
