<div id="colorlib-page">
    <?php include __DIR__ . '/../side_menu.php' ?>
    <?php
    if (!empty($req->get()['post'])) {
        $post->findOne($req->get('post'));
    }

    if ($req->isPost && !($user->isGuest) && !($user->isAdmin)) {

        $post->load($user->request->post());

        if ($post->validate()) {
            if ($post->save()) {
                $resp->redirect('/post.php', ['post' => $post->post_id]);
                die();
            }
        }
    }
    ?>
    <!-- END COLORLIB-ASIDE -->
    <div id="colorlib-main">
        <section class="contact-section px-md-2 pt-5">
            <div class="container">
                <div class="row d-flex contact-info">
                    <div class="col-md-12 mb-1">
                        <h2 class="h3">Создание поста</h2>
                    </div>

                </div>
                <div class="row block-9">
                    <div class="col-lg-6 d-flex">

                        <form method="post" action="" class="bg-light p-5 contact-form">
                            <div class="form-group">
                                <input type="text" class="form-control <?= !empty($post->title_validate) ? 'is-invalid' : '' ?>" placeholder="Post title" name="_title" value="<?= isset($post->_title) ? $post->_title : '' ?>">
                                <div class="invalid-feedback">
                                    <?= $post->title_validate ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control <?= !empty($post->preview_validate) ? 'is-invalid' : '' ?>" placeholder="Post preview" name="_preview" value="<?= isset($post->_preview) ? $post->_preview : '' ?>">
                                <div class="invalid-feedback">
                                    <?= $post->preview_validate ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="_content" id="" cols="30" rows="10" class="form-control <?= !empty($post->content_validate) ? 'is-invalid' : '' ?>"
                                    placeholder="Post content"><?= isset($post->_content) ? $post->_content : '' ?></textarea>
                                <div class="invalid-feedback">
                                    <?= $post->content_validate ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Создать" class="btn btn-primary py-3 px-5">
                            </div>
                        </form>

                    </div>


                </div>
            </div>
        </section>
    </div><!-- END COLORLIB-MAIN -->
</div><!-- END COLORLIB-PAGE -->