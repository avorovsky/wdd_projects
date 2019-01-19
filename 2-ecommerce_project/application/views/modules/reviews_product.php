<div class="tab-pane fade in" id="reviews_tabs">
    <div class="woocommerce-Reviews">
        <div>
<?php

    $reviews = \Models\Review::getList($data['id']);

?>
            <h2 class="woocommerce-Reviews-title"><?=count($reviews)?> review(s) total for <span><?=$data['name']?></span></h2>
            <ol class="commentlist">
<?php

    $reviews = \Models\Review::getList($data['id']);

    // shuffle an array to get random order
    shuffle($reviews);

    // cut to first elements
    $dataToOutput = 5;
    $reviews = array_slice($reviews, 0, $dataToOutput);

    foreach ($reviews as $key => $value) {

        // get the author
        $author = \Models\User::getById($value['user_id']);

        // create excerpt
        $excerpt = new \Components\Excerpt($value['description']);
        $excerpt = $excerpt->getExcerpt();

?>
                <!-- /Review -->
                <li class="comment">
                    <div>
                        <img alt="<?=$author['first_name'].' '.$author['last_name']?>" src="<?=IMG.'users'.DS.$author['image']?>" class="avatar avatar-60 photo">
                        <div class="comment-text">
                            <div class="ratings">
                                <div class="rating-box">
                                    <div style="width:100%" class="rating"></div>
                                </div>
                            </div>
                            <p class="meta">
                                <strong><?=$author['first_name'].' '.$author['last_name']?></strong>
                                <span>–</span><?=date('F j, Y', strtotime($value['created_at']))?>
                            </p>
                            <div class="description">
                                <p><?=$excerpt?></p>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- /Review -->

<?php } // foreach ?>

            </ol>
        </div>
        <!--div>
            <div>
                <div class="comment-respond">
                    <span class="comment-reply-title">Add a review </span>
                    <form action="#" method="post" class="comment-form" novalidate>
                        <p class="comment-notes"><span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span></p>
                        <div class="comment-form-rating">
                            <label id="rating">Your rating</label>
                            <p class="stars">
                                <span>
                                <a class="star-1" href="#">1</a>
                                <a class="star-2" href="#">2</a>
                                <a class="star-3" href="#">3</a>
                                <a class="star-4" href="#">4</a>
                                <a class="star-5" href="#">5</a>
                                </span>
                            </p>
                        </div>
                        <p class="comment-form-comment">
                            <label>Your review <span class="required">*</span></label>
                            <textarea id="comment" name="comment" cols="45" rows="8" required></textarea>
                        </p>
                        <p class="comment-form-author">
                            <label for="author">Name <span class="required">*</span></label>
                            <input id="author" name="author" type="text" value="" size="30" required>
                        </p>
                        <p class="comment-form-email">
                            <label for="email">Email <span class="required">*</span></label>
                            <input id="email" name="email" type="email" value="" size="30"  required>
                        </p>
                        <p class="form-submit">
                            <input name="submit" type="submit" id="submit" class="submit" value="Submit Your Review">
                        </p>
                    </form>
                </div>
            </div>
        </div-->
        <div class="clear"></div>
    </div>
</div>
