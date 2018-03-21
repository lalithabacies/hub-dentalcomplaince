<div style="width: 100%;float:left;margin:0;padding:0;">
    <div id="wpc_registration_message" class="wpc_notice wpc_error" {if empty($error) } style="display: none;" {/if}>
        {if !empty($error)}
            {$error}
        {/if}
    </div>

    <form action="" method="post" id="wpc_registration_form" class="wpc_form" enctype="multipart/form-data">
        <input name="wpc_self_registered" type="hidden" value="1" />

        {if $show_avatar}
            <div class="wpc_form_line">
                <div class="wpc_form_label"><label for="avatar">{$labels.avatar}</label></div>
                <div class="wpc_form_field">{$avatar}</div>
            </div>
        {/if}

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label data-title="{$labels.business_name}" for="wpc_business_name">{$labels.business_name}{$required_text}</label>
            </div>
            <div class="wpc_form_field">
                <input type="text" id="wpc_business_name" name="business_name" data-required_field="1" value="{if $error}{$vals.business_name}{/if}" />
                <div class="wpc_field_validation">
                    <span class="wpc_field_required">{$labels.business_name}{$labels.is_required}</span>
                </div>
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label data-title="{$labels.contact_name}" for="wpc_contact_name">{$labels.contact_name}{$required_text}</label>
            </div>
            <div class="wpc_form_field">
                <input type="text" id="wpc_contact_name" name="contact_name" data-required_field="1" value="{if $error}{$vals.contact_name}{/if}" />
                <div class="wpc_field_validation">
                    <span class="wpc_field_required">{$labels.contact_name}{$labels.is_required}</span>
                </div>
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label data-title="{$labels.contact_email}" for="wpc_contact_email">{$labels.contact_email}{$required_text}</label>
            </div>
            <div class="wpc_form_field">
                <input type="email" id="wpc_contact_email" name="contact_email" data-required_field="1" value="{if $error}{$vals.contact_email}{/if}" />
                <div class="wpc_field_validation">
                    <span class="wpc_field_wrong">{$labels.invalid_email}</span>
                    <span class="wpc_field_required">{$labels.contact_email}{$labels.is_required}</span>
                </div>
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label for="wpc_contact_phone">{$labels.contact_phone}</label>
            </div>
            <div class="wpc_form_field">
                <input type="text" id="wpc_contact_phone" name="contact_phone" value="{if $error}{$vals.contact_phone}{/if}" />
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
                                        {$value.title}{$labels.is_required}
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
                                        {$value.title}{$labels.is_required}
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

        <hr class="wpc_delimiter" />

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label data-title="{$labels.contact_username}" for="wpc_contact_username">{$labels.contact_username}{$required_text}</label>
            </div>
            <div class="wpc_form_field">
                <input type="text" id="wpc_contact_username" name="contact_username" data-required_field="1" value="{if $error}{$vals.contact_username}{/if}" />
                <div class="wpc_field_validation">
                    <span class="wpc_field_required">{$labels.contact_username}{$labels.is_required}</span>
                </div>
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label data-title="{$labels.contact_password}" for="wpc_contact_password">{$labels.contact_password}{$required_text}</label>
            </div>
            <div class="wpc_form_field">
                <input type="password" id="wpc_contact_password" name="contact_password" data-required_field="1" value="" />
                <div class="wpc_field_validation">
                    <span class="wpc_field_required">{$labels.contact_password}{$labels.is_required}</span>
                </div>
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label data-title="{$labels.contact_password2}" for="wpc_contact_password2">{$labels.contact_password2}{$required_text}</label>
            </div>
            <div class="wpc_form_field">
                <input type="password" id="wpc_contact_password2" name="contact_password2" data-required_field="1" value="" />
                <div class="wpc_field_validation">
                    <span class="wpc_field_required">{$labels.contact_password2}{$labels.is_required}</span>
                </div>

                <div id="pass-strength-result" style="display: none;">{$labels.password_indicator}</div>
                <div class="indicator-hint">{$labels.password_hint}</div>
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">&nbsp;</div>
            <div class="wpc_form_field">
                <input type="checkbox" {if $vals.send_password == 1 } checked {/if} name="user_data[send_password]" id="wpc_send_password" value="1" />
                &nbsp;<label for="wpc_send_password">{$labels.send_password}</label>
                <span class="wpc_description">{$labels.send_password_desc}</span>
            </div>
        </div>

        {if isset( $terms_used ) && $terms_used == 'yes'}
            <div class="wpc_form_line">
                <div class="wpc_form_label">&nbsp;</div>
                <div class="wpc_form_field">
                    <label class="terms_label" data-title="{$labels.terms_conditions}" for="wpc_terms_agree">
                        <input type="checkbox" id="wpc_terms_agree" name="terms_agree" value="1" data-required_field="1" {$vals.terms_default_checked} />
                        &nbsp;&nbsp;&nbsp;&nbsp;{$labels.terms_agree}
                    </label>
                    <a href="{$vals.terms_hyperlink}" target="_blank" title="{$labels.terms_conditions}">{$labels.terms_conditions}</a>

                    <div class="wpc_field_validation">
                        <span class="wpc_field_required">{$labels.terms_conditions}{$labels.is_required}</span>
                    </div>
                </div>
            </div>
        {/if}

        <div class="wpc_form_line">
            <div class="wpc_form_label">&nbsp;</div>
            <div id="wpc_block_captcha" class="wpc_form_field">{if isset($labels.captcha)}{$labels.captcha}{/if}</div>
        </div>
        <div class="wpc_form_line">
            <div class="wpc_form_label">&nbsp;</div>
            <div class="wpc_form_field">
                <input type="submit" name="wpc_submit_registration" id="wpc_submit_registration" class="button-primary wpc_submit" value="{$labels.send_button}" />
            </div>
        </div>
        <div class="wpc_form_line">
            <div class="wpc_form_label">&nbsp;</div>
            <div class="wpc_form_field">
                <div class="wpc_submit_info" style="float: left;width: 100%;"></div>
            </div>
        </div>
    </form>
</div>
