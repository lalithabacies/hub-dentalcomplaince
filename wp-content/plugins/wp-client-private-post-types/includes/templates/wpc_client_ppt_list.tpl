<div class="wpc_client_private_posts">
    {if $hide_content}
        {$no_redirect_text}
    {else}
        {if !empty($pages)}
            <div class="wpc_client_portal_page_category" id="category_general">
                {foreach $pages as $page}
                    <span class="wpc_page_item">
                        <a href="{$page.url}">{$page.title}</a>
                        {if $show_date}
                            [{$page.date} {$page.time}]
                        {/if}
                    </span>
                {/foreach}
            </div>
        {/if}
    {/if}
</div>