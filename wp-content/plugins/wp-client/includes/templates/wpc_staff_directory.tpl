<div class="wpc_staff_directory">
    {if !empty( $message )}
        <div id="message" class="wpc_apply wpc_notice">{$message}</div>
    {/if}

    <div style="float:left;width:100%;margin-bottom:10px;">
        [wpc_client_get_page_link page="hub" text="HUB Page" /]
        {if !empty( $add_staff_link )}
            &nbsp;&nbsp;|&nbsp;&nbsp;<a href="{$add_staff_link}">{$texts.add_staff}</a>
        {/if}
    </div>

    <table class="wpc_staff_directory_table">
        <thead>
            <tr>
                <th class="wpc_staff_login_th">{$texts.staff_login}</th>
                <th class="wpc_staff_first_name_th">{$texts.first_name}</th>
                <th class="wpc_staff_email_th">{$texts.email}</th>
                <th class="wpc_staff_status_th">{$texts.status}</th>
            </tr>
        </thead>
        <tbody>
            {foreach $staffs as $staff}
                <tr class="wpc_staff_line">
                    <td class="wpc_staff_login_td">
                        <div class="wpc_show_details"></div>
                        <strong>{$staff.user_login}</strong>
                        <span style="float:left;width:100%;display:block;">
                            <a href="{$staff.edit_link}">{$texts.edit}</a> |
                            <a onclick="return confirm('{$texts.delete_confirm}');" href="{$staff.delete_link}">{$texts.delete}</a>
                        </span>
                    </td>
                    <td class="wpc_staff_first_name_td">{$staff.first_name}</td>
                    <td class="wpc_staff_email_td">{$staff.user_email}</td>
                    <td class="wpc_staff_status_td">
                        {if $staff.to_approve == 1}
                            {$texts.wait_approve}
                        {else}
                            {$texts.approved}
                        {/if}
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</div>