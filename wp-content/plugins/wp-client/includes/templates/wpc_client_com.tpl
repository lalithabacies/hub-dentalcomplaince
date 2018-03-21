{if !$ajax_pagination}
    <div class="wpc_private_messages_shortcode">
        <div class="wpc_msg_nav_wrapper">
            <input type="button" class="wpc_msg_new_message_button wpc_button" value="{$texts.new}" title="{$texts.new_message}"/>
            <div class="wpc_msg_nav_list_wrapper">
                <div class="wpc_msg_nav_list_collapsed"></div>
                <ul class="wpc_msg_nav_list">
                    <li class="wpc_nav_button inbox" data-list="inbox">{$texts.inbox}</li>
                    <li class="wpc_nav_button sent" data-list="sent">{$texts.sent}</li>
                    <li class="wpc_nav_button archive" data-list="archive">{$texts.archive}</li>
                    <li class="wpc_nav_button trash" data-list="trash">{$texts.trash}</li>
                </ul>
            </div>
        </div>

        <div class="wpc_msg_content_wrapper">
            <div class="wpc_msg_top_nav_wrapper">
                <div class="wpc_msg_active_filters_wrapper"></div>
                <div class="wpc_msg_controls_line">
                    <div class="wpc_msg_bulk_all">
                        <input type="checkbox" name="wpc_msg_bulk_check" class="wpc_msg_bulk_check" title="{$texts.select_all}" />
                        <div class="wpc_msg_bulk_actions_wrapper">
                            <ul class="wpc_msg_bulk_select">
                                <li data-select="all">{$texts.all}</li>
                                <li data-select="all_page">{$texts.select_all}</li>
                                <li data-select="none">{$texts.none}</li>
                                <li data-select="read">{$texts.read}</li>
                                <li data-select="unread">{$texts.unread}</li>
                            </ul>
                            <hr style="clear:both;"/>
                            <ul class="wpc_msg_bulk_actions">
                                <li data-action="read">{$texts.mark_as_read}</li>
                                <li data-action="archive">{$texts.to_archive}</li>
                                <li data-action="delete">{$texts.delete}</li>
                                <li data-action="restore">{$texts.restore}</li>
                                <li data-action="leave">{$texts.leave}</li>
                            </ul>
                        </div>
                    </div>

                    {if $show_filters}
                        <div class="wpc_msg_filter">
                            {$texts.filters}
                            <div class="wpc_msg_filter_wrapper">
                                <label style="float: left;width:100%;">{$texts.filter_by}:<br />
                                    <select style="float: left;width:100%;" class="wpc_msg_filter_by">
                                        <option value="member">{$texts.member}</option>
                                        <option value="date">{$texts.date}</option>
                                    </select>
                                </label>

                                <div class="wpc_ajax_content">

                                    <div class="wpc_loading_overflow">
                                        <div class="wpc_small_ajax_loading"></div>
                                    </div>

                                    <div class="wpc_overflow_content">
                                        <div class="wpc_msg_filter_selectors"></div>
                                        <input type="button" value="{$texts.apply_filter}" class="wpc_msg_add_filter wpc_button">
                                    </div>
                                </div>
                            </div>
                        </div>
                    {/if}

                    <div class="wpc_msg_search_line">
                        <div class="wpc_msg_search_button" title="{$texts.search}">
                            <div class="wpc_msg_search_image"></div>
                        </div>
                        <input type="text" name="wpc_msg_search" class="wpc_msg_search wpc_text" placeholder="{$texts.search_in_messages}"/>
                    </div>
                </div>

                <div class="wpc_msg_pagination" data-pagenumber="1">
                    <div class="wpc_msg_refresh_button" data-object="chains" title="{$texts.refresh}">
                        <div class="wpc_msg_refresh_image"></div>
                    </div>
                    <div class="wpc_msg_pagination_buttons">
                        <div class="wpc_msg_next_button disabled" title="{$texts.newer}">
                            <div class="wpc_msg_next_image"></div>
                        </div>
                        <div class="wpc_msg_prev_button" title="{$texts.older}">
                            <div class="wpc_msg_prev_image"></div>
                        </div>
                    </div>
                    <div class="wpc_msg_pagination_text">
                        <strong><span class="start_count"></span> - <span class="end_count"></span></strong> of <strong><span class="total_count"></span></strong>
                    </div>
                </div>

            </div>

            <div class="wpc_msg_content_wrapper_inner"></div>

            <div class="wpc_msg_chain_content"></div>

            <div class="wpc_msg_add_new_wrapper">
                <form action="" method="post" name="wpc_new_message_form" class="wpc_new_message_form">
                    <div class="wpc_msg_new_message_line">
                        <div class="wpc_msg_new_message_label"><label for="new_message_to">{$texts.to}<span style="color: red;">&nbsp;*</span></label></div>
                        <div class="wpc_msg_new_message_field">
                            <select style="width:100%;" name="new_message[to][]" placeholder="{$texts.select_members}" multiple class="new_message_to wpc_selectbox">
                                {if isset( $to_users.wpc_client ) && !empty( $to_users.wpc_client )}
                                    <optgroup label="{$texts.clients}" data-single_title="{$texts.client}" data-color="#0073aa">
                                        {foreach $to_users.wpc_client as $user}
                                            <option value="{$user->ID}">{if !empty( $user->$display_name )}{$user->$display_name}{else}{$user->user_login}{/if}</option>
                                        {/foreach}
                                    </optgroup>
                                {/if}
                                {if isset( $to_users.wpc_client_staff ) && !empty( $to_users.wpc_client_staff )}
                                    <optgroup label="{$texts.staffs}" data-single_title="{$texts.staff}" data-color="#2da3dc">
                                        {foreach $to_users.wpc_client_staff as $user}
                                            <option value="{$user->ID}">{if !empty( $user->$display_name )}{$user->$display_name}{else}{$user->user_login}{/if}</option>
                                        {/foreach}
                                    </optgroup>
                                {/if}
                                {if isset( $to_users.wpc_managers ) && !empty( $to_users.wpc_managers )}
                                    <optgroup label="{$texts.managers}" data-single_title="{$texts.manager}" data-color="#dc832d">
                                        {foreach $to_users.wpc_managers as $user}
                                            <option value="{$user->ID}">{if !empty( $user->$display_name )}{$user->$display_name}{else}{$user->user_login}{/if}</option>
                                        {/foreach}
                                    </optgroup>
                                {/if}
                                {if isset( $to_users.admins ) && !empty( $to_users.admins )}
                                    <optgroup label="{$texts.admins}" data-single_title="{$texts.admin}" data-color="#b63ad0">
                                        {foreach $to_users.admins as $user}
                                            <option value="{$user->ID}">{if !empty( $user->$display_name )}{$user->$display_name}{else}{$user->user_login}{/if}</option>
                                        {/foreach}
                                    </optgroup>
                                {/if}
                            </select>
                            <span class="wpc_description">{$texts.to_description}</span>
                        </div>
                    </div>
                    <div class="wpc_msg_new_message_line" style="display: none;">
                        <div class="wpc_msg_new_message_label">
                            <label for="new_message_cc">
                                {$texts.cc_members}
                            </label>
                        </div>
                        <div class="wpc_msg_new_message_field">
                            <select style="width:100%;" name="new_message[cc][]" placeholder="{$texts.select_cc_members}" multiple class="new_message_cc wpc_selectbox"></select>
                            <span class="wpc_description">{$texts.cc_members_description}</span>
                        </div>
                    </div>
                    {if $show_cc_email}
                        <div class="wpc_msg_new_message_line">
                            <div class="wpc_msg_new_message_label"><label for="new_message_cc_email">{$texts.cc_email}</label></div>
                            <div class="wpc_msg_new_message_field">
                                <input type="text" style="width:100%;" name="new_message[cc_email]" value="" placeholder="{$texts.cc_email}" class="new_message_cc_email wpc_text"/>
                                <span class="wpc_description">{$texts.cc_email_description}</span>
                            </div>
                        </div>
                    {/if}
                    <div class="wpc_msg_new_message_line">
                        <div class="wpc_msg_new_message_label"><label for="new_message_subject">{$texts.subject}<span style="color: red;">&nbsp;*</span></label></div>
                        <div class="wpc_msg_new_message_field"><input type="text" style="width:100%;" name="new_message[subject]" value="" placeholder="{$texts.message_subject}" class="new_message_subject wpc_text"/></div>
                    </div>
                    <div class="wpc_msg_new_message_line">
                        <div class="wpc_msg_new_message_label"><label for="new_message_content">{$texts.message}<span style="color: red;">&nbsp;*</span></label></div>
                        <div class="wpc_msg_new_message_field">{$new_message_textarea}</div>
                    </div>
                    <div class="wpc_msg_new_message_line">
                        <div class="wpc_msg_new_message_label">&nbsp;</div>
                        <div class="wpc_msg_new_message_field">
                            <input type="button" class="wpc_msg_send_new_message wpc_button" value="{$texts.send}" />
                            <input type="button" class="wpc_msg_back_new_message wpc_button" value="{$texts.cancel}" />
                        </div>
                    </div>
                </form>
            </div>

            <div class="wpc_ajax_overflow"><div class="wpc_ajax_loading"></div></div>
        </div>
    </div>
{else}
    {if $ajax_chains_list}
        <table class="wpc_private_messages_table">
            <tbody>
                {if isset( $chains ) && !empty( $chains )}
                    {foreach $chains as $chain}
                        <tr>
                            <th class="wpc_msg_check-column">
                                <input type="checkbox" class="wpc_msg_item" name="item[]" value="{$chain.c_id}" data-new="{$chain.is_new}">
                            </th>
                            <td class="wpc_msg_column-client_ids" {if $chain.is_new == 'true'}style="font-weight: bold;"{/if}>
                                <span class="wpc_messages_count" title="{$texts.messages_in_chain}">
                                    {if $chain.messages_count > 1}
                                        ({$chain.messages_count})
                                    {/if}
                                </span>
                                <span class="wpc_chain_members" title="{$chain.members_title}">{$chain.members}</span>
                            </td>
                            <td class="wpc_msg_column-message_text">
                                <span class="wpc_chain_subject" {if $chain.is_new == 'true'}style="font-weight: bold;"{/if}>{$chain.subject}</span>
                                <span class="wpc_chain_last_message">{$chain.content}</span>
                            </td>
                            <td class="wpc_msg_column-date">
                                <span {if $chain.is_new == 'true'}style="font-weight: bold;"{/if}>{$chain.date}</span>
                            </td>
                        </tr>
                    {/foreach}
                {else}
                    <tr class="wpc_msg_no-items">
                        <td colspan="4">
                            {$texts.no_messages}
                        </td>
                    </tr>
                {/if}
            </tbody>
        </table>
    {elseif $ajax_chain}
        <div class="wpc_msg_chain_subject">
            <div class="wpc_msg_chain_subject_text">{$subject}</div>
            <div class="wpc_msg_refresh_button" data-object="chain" data-chain_id="{$chain_id}" title="{$texts.refresh}">
                <div class="wpc_msg_refresh_image"></div>
            </div>
            <div class="wpc_msg_collapse_button" title="{$texts.expand_all}" data-alt_title="{$texts.collapse_all}">
                <div class="wpc_msg_expand_image"></div>
            </div>
        </div>

        {foreach from=$messages key=k item=message}
            <div class="wpc_msg_message_line {if !( count( $messages ) <= 4 || ( count( $messages ) > 4 && ( $k == 0 || $k == count( $messages ) - 1 ) ) )}wpc_msg_for_hidden{/if}" data-message_id="{$message.id}">
                <div class="wpc_msg_avatar">
                    {$message.avatar}
                </div>
                <div class="wpc_msg_line_content">
                    <div class="wpc_msg_author_date">
                        <div class="wpc_msg_message_author">{$message.author}</div>
                        <div class="wpc_msg_message_date">{$message.date}</div>
                        </div>
                    <div class="wpc_msg_message_content">{nl2br(stripslashes( $message.content ))}</div>
                </div>
            </div>
            {if count( $messages ) > 4 && $k == 0}
                <div class="wpc_expand_older_messages">{$texts.show} <span class="wpc_expand_count">{count($messages) - 2}</span> {$texts.older_messages}</div>
            {/if}
        {/foreach}

        {if $hide_reply}
            <div class="wpc_msg_answer_actions">
                <input type="button" class="wpc_msg_back_answer wpc_button" value="{$texts.cancel}" />
            </div>
        {else}
            <div class="wpc_msg_chain_answer">
                <div class="wpc_msg_avatar">
                    {$avatar}
                </div>
                <div class="wpc_msg_answer_field">
                    {if $show_cc_email}
                        <div class="wpc_answer_line" style="width:100%;margin: 0 0 10px 0;">
                            <input type="text" class="wpc_msg_answer_cc_email" style="width:100%;" name="answer[cc_email]" value="" placeholder="{$texts.cc_email}" />
                            <span class="wpc_description">{$texts.cc_description}</span>
                        </div>
                    {/if}
                    {$answer_message_textarea}
                </div>
                <div class="wpc_msg_answer_actions">
                    <input type="button" data-chain_id="{$chain_id}" class="wpc_msg_send_answer wpc_button" value="{$texts.send}" />
                    <input type="button" class="wpc_msg_back_answer wpc_button" value="{$texts.cancel}" />
                    <span class="wpc_ajax_loading" style="display: none;float:left;margin: 6px 0 0 10px;"></span>
                </div>
            </div>
        {/if}
    {/if}
{/if}