//for tinymce v4
var wpc_shortcode = '';
var sb_target = '';
var temporary_data = {};
var input_name = '';
var temp_counters = {};

var wpc_shortcodes_menu = {
    files   : [],
    list    : [],
    pages   : [],
    clients : [],
    other   : []
};

for( key in wpc_shortcodes ) {
    if( typeof wpc_shortcodes[ key ].categories != 'undefined' && wpc_shortcodes[ key ].categories != '' ) {
        wpc_shortcodes_menu[ wpc_shortcodes[ key ].categories ].push({
            text: typeof wpc_shortcodes[ key ].title != 'undefined' ? wpc_shortcodes[ key ].title : '',
            value: key,
            onclick: function( e ) {
                e.stopPropagation();
                wpc_shortcode = this.value();
                if( jQuery(e.target).hasClass( 'mce-menu-item' ) ) {
                    sb_target = jQuery(e.target);
                } else {
                    sb_target = jQuery(e.target).parents('.mce-menu-item');
                }
                shortcode_item_click( wpc_shortcodes[ wpc_shortcode ], {'target': sb_target} );
            }
        });
    }
}

function shortcode_item_click( shortcode_item, temp_data ) {
    var attributes_array = new Array();
    if( !( typeof shortcode_item.attributes == 'undefined' || shortcode_item.attributes.length == 0 ) ) {
        for( var prop in shortcode_item.attributes ) {
            attributes_array.push( prop );
        }
    }

    if( attributes_array.length > 0 ) {
        jQuery( temp_data.target ).shutter_box({
            view_type       : 'lightbox',
            width           : '300px',
            type            : 'ajax',
            dataType        : 'json',
            href            : wpc_var.ajax_url,
            ajax_data       : 'action=wpc_get_shortcode_attributes_form&shortcode=' + wpc_shortcode,
            setAjaxResponse : function( data ) {
                jQuery( '.sb_lightbox_content_title' ).html( data.title );
                jQuery( '.sb_lightbox_content_body' ).html( data.content );

                init_popup_links();
            },
            self_init       : false,
            onClose         : function() {
                wpc_shortcode   = '';
                sb_target       = '';
            }
        });

        jQuery( temp_data.target ).shutter_box('show');
    } else {
        var close_tag = '';
        if( typeof wpc_shortcodes[ wpc_shortcode ].content != 'undefined' && wpc_shortcodes[ wpc_shortcode ].content != '' ) {
            close_tag = wpc_shortcodes[ wpc_shortcode ].content + '[/' + wpc_shortcode + ']';
        } else if( typeof wpc_shortcodes[ wpc_shortcode ].close_tag != 'undefined' && wpc_shortcodes[ wpc_shortcode ].close_tag ) {
            close_tag = '[/' + wpc_shortcode + ']';
        }
        tinyMCE.activeEditor.insertContent( '[' + wpc_shortcode + ( close_tag == '' ? ' /' : '' ) + ']' + close_tag );
        wpc_shortcode = '';
    }
}

jQuery(document).ready(function() {
    jQuery(document).on('click', '.add_shortcode_button', function() {
        var attr_array = jQuery(this).parents('form').values();
        var attr_string = '';
        var temp_obj = {};
        for( key in attr_array ) {
            if( jQuery('#wpc_shortcode_form *[name="' + key + '"]').parent().is(':visible') ) {
                var data_key = jQuery('#wpc_shortcode_form *[name="' + key +  '"]').data('key');
                if( data_key == '' ) continue;
                if( typeof temp_obj[ data_key ] == 'undefined' ) {
                    temp_obj[ data_key ] = [];
                }
                temp_obj[ data_key ].push( attr_array[ key ] );
            }
        }
        for( key in temp_obj ) {
            attr_string += key + '="' + temp_obj[ key ].join(',') + '" ';
        }
        var close_tag = '';
        if( typeof wpc_shortcodes[ wpc_shortcode ].content != 'undefined' && wpc_shortcodes[ wpc_shortcode ].content != '' ) {
            close_tag = wpc_shortcodes[ wpc_shortcode ].content + '[/' + wpc_shortcode + ']';
        } else if( typeof wpc_shortcodes[ wpc_shortcode ].close_tag != 'undefined' && wpc_shortcodes[ wpc_shortcode ].close_tag ) {
            close_tag = '[/' + wpc_shortcode + ']';
        }
        tinyMCE.activeEditor.insertContent( '[' + wpc_shortcode + ' ' + attr_string + ( close_tag == '' ? '/' : '' ) + ']' + close_tag );

        wpc_shortcode = '';
        jQuery(sb_target).shutter_box('close');
    });
    jQuery(document).on('click', '.cancel_shortcode_button', function() {
        wpc_shortcode = '';
        jQuery(sb_target).shutter_box('close');
    });
    jQuery(document).on('change', '.wpc_attr_field', function() {
        var name = jQuery(this).data('key');
        var value = jQuery(this).val();
        jQuery( '.wpc_has_parent_' + name ).parents('#wpc_shortcode_form tr').hide();
        jQuery( '.wpc_has_parent_' + name + '.' + name + ( typeof( value ) == 'string' && value.length > 0 ? '_' + md5( value ) : '' ) ).parents('#wpc_shortcode_form tr').show();
        //jQuery.wpcChangeSize();
    });
});

(function() {
        tinymce.PluginManager.add( 'WPC_Client_Shortcodes', function( editor, url ) {
            editor.addButton( 'wpc_client_button_shortcodes', {
                title : 'Insert Placeholders & Shortcode',
                type : 'menubutton',
                menu: [
                    {
                        text: 'Placeholders: General',
                        value: '',
                        onclick: function() {
                            editor.insertContent(this.value());
                        },
                        menu: [
                            {
                                text: '{site_title}',
                                value: '{site_title}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{contact_name}',
                                value: '{contact_name}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{client_business_name}',
                                value: '{client_business_name}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{client_name}',
                                value: '{client_name}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{client_phone}',
                                value: '{client_phone}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{client_email}',
                                value: '{client_email}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{client_registration_date}',
                                value: '{client_registration_date}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{user_name}',
                                value: '{user_name}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{login_url}',
                                value: '{login_url}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{logout_url}',
                                value: '{logout_url}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{manager_name}',
                                value: '{manager_name}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{staff_display_name}',
                                value: '{staff_display_name}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{staff_first_name}',
                                value: '{staff_first_name}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{staff_last_name}',
                                value: '{staff_last_name}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{staff_email}',
                                value: '{staff_email}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{staff_login}',
                                value: '{staff_login}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{user_display_name}',
                                value: '{user_display_name}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{user_first_name}',
                                value: '{user_first_name}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{user_last_name}',
                                value: '{user_last_name}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{user_email}',
                                value: '{user_email}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{user_login}',
                                value: '{user_login}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            }
                        ]

                    },
                    {
                        text: 'Placeholders: Business',
                        value: '',
                        onclick: function() {
                            editor.insertContent(this.value());
                        },
                        menu: [
                            {
                                text: '{business_logo_url}',
                                value: '{business_logo_url}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{business_name}',
                                value: '{business_name}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{business_address}',
                                value: '{business_address}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{business_mailing_address}',
                                value: '{business_mailing_address}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{business_website}',
                                value: '{business_website}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{business_email}',
                                value: '{business_email}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{business_phone}',
                                value: '{business_phone}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{business_fax}',
                                value: '{business_fax}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            }
                        ]
                    },
                    {
                        text: 'Placeholders: Specific',
                        value: '',
                        onclick: function() {
                            editor.insertContent(this.value());
                        },
                        menu: [
                            {
                                text: '{admin_url}',
                                value: '{admin_url}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{approve_url}',
                                value: '{approve_url}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{user_password}',
                                value: '{user_password}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{page_title}',
                                value: '{page_title}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{admin_file_url}',
                                value: '{admin_file_url}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{message}',
                                value: '{message}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{file_name}',
                                value: '{file_name}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{file_category}',
                                value: '{file_category}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{estimate_number}',
                                value: '{estimate_number}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            },
                            {
                                text: '{invoice_number}',
                                value: '{invoice_number}',
                                onclick: function(e) {
                                    e.stopPropagation();
                                    editor.insertContent(this.value());
                                }
                            }
                        ]
                    },
                    {
                        text: 'Shortcodes: Files',
                        value: '',
                        menu: wpc_shortcodes_menu.files
                    },
                    {
                        text: 'Shortcodes: Lists',
                        value: '',
                        menu: wpc_shortcodes_menu.list
                    },
                    {
                        text: 'Shortcodes: Pages',
                        value: '',
                        menu: wpc_shortcodes_menu.pages
                    },
                    {
                        text: 'Shortcodes: Users',
                        value: '',
                        menu: wpc_shortcodes_menu.clients
                    },
                    {
                        text: 'Shortcodes: Others',
                        value: '',
                        menu: wpc_shortcodes_menu.other
                    }
                ]

            });
        });
    }
)();