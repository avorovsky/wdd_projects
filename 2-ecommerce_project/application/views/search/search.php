<form class="navbar-form" action="/search/result" method="post" autocomplete="off" accept-charset="UTF-8">
    <?=\Components\Token::getToken().PHP_EOL?>
    <div class="input-group">
        <input id="search_field" type="search" name="search_field" class="form-control" placeholder="Search">
        <span class="input-group-btn">
            <button id="search_button" type="submit" class="search-btn">
                <span class="glyphicon glyphicon-search">
                    <span class="sr-only">Search</span>
                </span>
            </button>
        </span>
    </div>
</form>
<div id="search_suggest">
</div>
