<div class="v-card-1 v-post">

    <article>

        <h2>Archives</h2>

        <ul class="v-side-menu">
            <?php wp_get_archives(); ?>
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