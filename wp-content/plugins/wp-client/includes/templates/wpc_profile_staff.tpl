<div style="width: 100%;float:left;margin:0;padding:0;" class="profile_staff" id="client_profile">
    <div id="message" class="wpc_notice {$message_class}" {if empty($message) } style="display: none;" {/if}>
        {if !empty( $message ) }
            {$message}
        {/if}
    </div>

    <form action="" method="post" class="wpc_form" id="wpc_profile_form" enctype="multipart/form-data">
        <input type="hidden" name="wpc_action" value="client_profile" />
        {$nonce}

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label for="avatar">{$label_avatar}</label>
            </div>
            <div class="wpc_form_field">{$avatar_field}</div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label for="wpc_staff_login">{$label_staff_login}</label>
            </div>
            <div class="wpc_form_field">
                <input type="text" id="wpc_staff_login" disabled="disabled" value="{$staff_login}" />
                <span class="wpc_description">{$login_cannot_changed}</span>
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label data-title="{$label_staff_email}" for="wpc_staff_email">{$label_staff_email}<span style="color: red;" title="{$title_star}">*</span></label>
            </div>
            <div class="wpc_form_field">
                <input type="email" id="wpc_staff_email" name="user_data[email]" class="required" data-required_field="1" value="{$staff_email}" />
                <div class="wpc_field_validation">
                    <span class="wpc_field_wrong">{$label_invalid_email}</span>
                    <span class="wpc_field_required">{$label_staff_email}{$label_is_required}</span>
                </div>
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label for="wpc_first_name">{$label_first_name}</label>
            </div>
            <div class="wpc_form_field">
                <input type="text" id="wpc_first_name" name="user_data[first_name]" value="{$first_name}" />
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label for="wpc_last_name">{$label_last_name}</label>
            </div>
            <div class="wpc_form_field">
                <input type="text" id="wpc_last_name" name="user_data[last_name]" value="{$last_name}" />
            </div>
        </div>

        {if isset($custom_fields) && 0 < $custom_fields|@count }
            {foreach $custom_fields as $key => $value }
                {if 'hidden' == $value.type}
                    {$value.field}
                {elseif 'checkbox' == $value.type || 'radio' == $value.type }
                    <div class="wpc_form_line">
                        <div class="wpc_form_label">
                            {if !empty($value.label) }
                                {$value.label}
                            {/if}
                        </div>
                        <div class="wpc_form_field">
                            {if !empty($value.field) }
                                {foreach $value.field as $field }
                                    {$field}
                                {/foreach}
                            {/if}
                            {if !empty($value.description) }
                                <span class="wpc_description">{$value.description}</span>
                            {/if}
                            {if !empty($value.required) }
                                <div class="wpc_field_validation">
                                    <span class="wpc_field_required">
                                        {$value.title}{$label_is_required}
                                    </span>
                                </div>
                            {/if}
                        </div>
                    </div>
                {else}
                    <div class="wpc_form_line">
                        <div class="wpc_form_label">
                            {if !empty($value.label) }
                                {$value.label}
                            {/if}
                        </div>
                        <div class="wpc_form_field">
                            {if !empty($value.field) }
                                {$value.field}
                            {/if}
                            {if !empty($value.description) }
                                <span class="wpc_description">{$value.description}</span>
                            {/if}
                            {if !empty($value.required) }
                                <div class="wpc_field_validation">
                                    <span class="wpc_field_required">
                                        {$value.title}{$label_is_required}
                                    </span>
                                </div>
                            {/if}
                        </div>
                    </div>
                {/if}
            {/foreach}
        {/if}

        {if !empty($custom_html)}
            {$custom_html}
        {/if}

        {if $modify_profile }
            {if $reset_password }
                <div class="wpc_form_line">
                    <div class="wpc_form_label">
                        <label for="wpc_contact_password">{$label_contact_password}</label>
                    </div>
                    <div class="wpc_form_field">
                        <input type="password" id="wpc_contact_password" name="contact_password" value="{$contact_password}" />
                    </div>
                </div>

                <div class="wpc_form_line">
                    <div class="wpc_form_label">
                        <label for="wpc_contact_password2">{$label_contact_password2}</label>
                    </div>
                    <div class="wpc_form_field">
                        <input type="password" id="wpc_contact_password2" name="contact_password2" value="{$contact_password2}" />
                        <div id="pass-strength-result" style="display: none;">{$label_strength_indicator}</div>
                        <div class="indicator-hint">{$label_indicator_hint}</div>
                    </div>
                </div>
            {/if}

            <div class="wpc_form_line">
                <div class="wpc_form_label">&nbsp;</div>
                <div class="wpc_form_field">
                    <input type="submit" name="wpc_submit_profile" id="wpc_submit_profile" class="button-primary wpc_submit" value="{$text_submit}" />
                </div>
            </div>
            <div class="wpc_form_line">
                <div class="wpc_form_label">&nbsp;</div>
                <div class="wpc_form_field">
                    <div class="wpc_submit_info" style="float: left;width: 100%;"></div>
                </div>
            </div>
        {/if}
    </form>
</div>