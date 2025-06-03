<div id="colorlib-page">
	<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
	<?php include __DIR__ . '/../side_menu.php' ?>
	<?php
	if ($req->isPost) {
		$comment->load($user->request->post());

		if ($comment->validate()) {
			if (!empty($req->get('reply_comment'))) {
				$comment->parent_id = $req->get('reply_comment');
			}

			if ($comment->save()) {
				$resp->redirect('/post.php', ['post' => $post->post_id]);
				die();
			}
		}
	}
	?>

	<?php
	$comment_input = '';
	if (!$user->isGuest && !$user->isAdmin) {
		$is_invalid = !empty($comment->text_validate) ? 'is-invalid' : '';

		$comment_input = "<div class=\"comment-form-wrap pt-5\">
				<h3 class=\"mb-5\">Оставьте комментарий</h3>
				<form method=\"post\" action=\"\" class=\"p-3 p-md-5 bg-light\">
					<div class=\"form-group\">
						<label for=\"message\">Сообщение</label>
						<textarea name=\"_text\" id=\"message\" cols=\"30\" rows=\"10\" class=\"form-control $is_invalid\"></textarea>
						<div class=\"invalid-feedback\">
							$comment->text_validate
						</div>
					</div>
					<div class=\"form-group\">
						<input type=\"submit\" value=\"Отправить\" name=\"send_comment\" class=\"btn py-3 px-4 btn-primary\">
					</div>
				</form>
			</div>";
	}
	?>

	<!-- END COLORLIB-ASIDE -->
	<div id="colorlib-main">
		<section class="ftco-no-pt ftco-no-pb">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 px-md-3 py-5">
						<div>
							<?php
							$delete_link = $resp->getLink('imports/post_delete.php', ['post' => $post->post_id]);

							if ($user->isAdmin) {
								echo "<a href=\"$delete_link\" class=\"text-danger\" style=\"font-size: 1.8em;\" title=\"Удалить\">🗑</a>";
							} 
							
							elseif (!$user->isGuest && $post->user_id === $user->user_id) {
								$edit_link = $resp->getLink('post-create.php', ['post' => $post->post_id]);

								echo "<a href=\"$edit_link\" class=\"text-warning\" style=\"font-size: 1.8em;\" title=\"Редактировать\">🖍</a>";

								if ($post->comments_count == 0) {
									echo "<a href=\"$delete_link\" class=\"text-danger\" style=\"font-size: 1.8em;\" title=\"Удалить\">🗑</a>";
								}
							}
							?>
						</div>

						<div class="post">
							<h1 class="mb-3"><?= $post->_title ?></h1>
							<div class="meta-wrap">
								<p class="meta">
									<!-- <img src='avatar.jpg' /> -->
									<span class="text text-3"><?= $post->user_login ?></span>
									<span><i class="icon-calendar mr-2"></i><?= $post->post_datetime() ?></span>
									<span><i class="icon-comment2 mr-2"></i><?= $post->comments_count ?> comments</span>
								</p>
							</div>

							<p>
								<?= $post->_content ?>
							</p>

							<!-- <p>
								<img src="images/image_1.jpg" alt="" class="img-fluid">
							</p> -->

						</div>
						<div class="comments pt-5 mt-5">
							<h3 class="mb-5 font-weight-bold"><?= $post->comments_count ?> комментариев</h3>
							<ul class="comment-list">
								<?php
								$action = '';

								foreach ($comment->all_comments() as $comment_) {

									if ($user->isAdmin) {
										$comment_delete = $resp->getLink('imports/comment_delete.php', ['post' => $post->post_id, 'comment' => $comment_->comment_id]);
										$action = "<a href=\"$comment_delete\" class=\"text-danger\" style=\"font-size: 1.8em;\" title=\"Удалить\">🗑</a>";
									}

									$html = "<li class=\"comment\">
										<div class=\"comment-body\">
											<div class=\"d-flex justify-content-between\">
												<h3>{$comment_->post->user->_login}</h3>
												$action
											</div>
											<div class=\"meta\">{$comment_->comment_datetime()}</div>
											<p>
												$comment_->_text
											</p>"
										. ((!$user->isGuest && !$user->isAdmin)
											? "<p><a href=\"{$resp->getLink('post.php', ['post' =>$post->post_id, 'reply_comment' =>$comment_->comment_id])}\" class=\"reply\">Ответить</a></p>"
											: "") .
										"</div>
									</li>";

									$html .= (!empty($req->get('reply_comment')) && $req->get('reply_comment') == $comment_->comment_id) ? $comment_input : "";

									$replies = $comment_->all_comments('replies');

									if (!empty($replies)) {

										$html .= '<ul>';

										foreach ($replies as $reply) {
											$html .= "<li class=\"comment\">
														<div class=\"comment-body\">
															<div class=\"d-flex justify-content-between\">
																<h3>{$reply->post->user->_login}</h3>
																	$action
															</div>
															<div class=\"meta\">{$reply->comment_datetime()}</div>
																<p>
																	$reply->_text
																</p>
															</div>
													</li>";
										}

										$html .= '</ul>';
									}

									echo $html;
									
								}
								?>

								<!-- avatar
									<div class="vcard bio">
										<img src="images/person_1.jpg" alt="Image placeholder">
									</div> -->
							</ul>
							<!-- END comment-list -->
							
							<?= (!$user->isGuest && empty($req->get('reply_comment')) && $post->user_id != $user->user_id) ? $comment_input : "" ?>

						</div>
					</div>
				</div><!-- END-->
			</div>
		</section>
	</div><!-- END COLORLIB-MAIN -->
</div><!-- END COLORLIB-PAGE -->