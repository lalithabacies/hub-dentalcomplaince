function custom_datepicker_init() {
    jQuery('.custom_datepicker_field').datepicker({
        showAnim : 'slideDown',
        onSelect : function() {
            var d = jQuery(this).datepicker('getDate');
            d.setHours(0, -d.getTimezoneOffset(), 0, 0);
            jQuery(this).next('input[type="hidden"]').val( d.getTime() / 1000 );
            jQuery(this).trigger('datepicker_change_value');
        }
    });
    jQuery('.custom_datepicker_field').datepicker( "option", wpc_custom_fields.regional );
    jQuery('.custom_datepicker_field[readonly]').datepicker( "option", "disabled", true );
    jQuery('.custom_datepicker_field.change_month').datepicker( "option", "changeMonth", true );
    jQuery('.custom_datepicker_field.change_year').datepicker( "option", "changeYear", true );

    jQuery('.custom_datepicker_field').each(function() {
        var obj = jQuery(this);
        jQuery(this).next('input[type="hidden"]').change(function() {
            var time = jQuery(this).val();
            if( time != '' && time * 1 > 0 ) {
                var d = new Date();
                d.setTime( ( time * 1 + d.getTimezoneOffset()*60 ) * 1000 );
                obj.datepicker( "setDate", d );
            } else {
                obj.val('');
            }
        });
        jQuery(this).next('input[type="hidden"]').trigger('change');
    });
}

jQuery(document).ready(function() {

    custom_datepicker_init();

    jQuery(document).on('change', '.custom_datepicker_field', function() {
        var value = jQuery(this).val();
        if( value != '' ) {
            var d = jQuery(this).datepicker('getDate');
            d.setHours(0, -d.getTimezoneOffset(), 0, 0);
            value = d.getTime() / 1000;
        } else {
            value = '';
        }
        jQuery(this).next('input[type="hidden"]').val( value );
    });

    jQuery(document).on( 'keypress', '.custom_datepicker_field', function (event) {
        var key = event.which || event.keyCode;
        if (key <= 13) {
            return true;
        }
        return false;
    });

    jQuery(document).on('click', '.custom_datepicker_field', function (event) {
        jQuery(this).next().trigger('click');
    });
});