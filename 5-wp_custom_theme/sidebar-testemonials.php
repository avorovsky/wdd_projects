<div class="v-card-1 v-post">

    <article>

        <ul class="v-side-menu">
            <?php wp_list_categories(['title_li' => '', 'child_of' => get_category_by_slug('testemonials')->term_id]); ?>
        </ul>

    </article>

    <hr>

    <article>

        <h2>Search</h2>

        <form action="/" method="get">
            <input type="text" name="s" id="s" />
            <button type="submit">
                <i class="fa fa-search"></i>
            </button>
        </form>

    </article>

</div>