<div class="panel-box">
	<p>
	OGPプラグイン <a href="https://github.com/binbin4649/ogp" target="_blank">github</a><br />
	</p>
	<p>
		<b>Twitter ID</b> : Twitterアカウントがあったら、@の後ろを入力。
	</p>
	<p>
		<b>Twitter Card</b> : Twitter IDが入力されていれば、選択されたTwitter Cardが反映されます。
	</p>
	<p>
		<b>facebook App-ID</b> : facebookはApp-IDを入力することを推奨している。<br>
		Facebookで開発者（デベロッパー）登録し、取得したApp-IDを記述します。<br>
		App-IDを取得するにはFacebookにログイン後、<a href="https://developers.facebook.com/apps/" target="_blank">「すべてのアプリ – 開発者向けFacebook」</a>ページにアクセスし、「新しいアプリを追加」します。<br>
		新しいアプリを追加し、もろもろ設定することで、App-IDが取得できます。
	</p>
	<p>
		<b>Default Image</b> : アイキャッチがない場合に代替する画像のファイル名。<br>
		( app/webroot/テーマ名/img/ ) or ( app/webroot/img/ )<br>
		デフォルトイメージはどちらかのディレクトに入れてください。
	</p>
	<p>
		<b>locale, locale_alternate</b> : 省略すると「ja_JP」が入る。<br>
		locale_alternateを省略すると出力されません。
	</p>
	<p>
		<b>ブログ画面表示, 固定ページ画面表示</b> : チェックを入れるとそれぞれの投稿画面に、OGP専用の拡張フィールドが表示されます。<br>
		title,description,image それぞれ個別に指定する場合はチェックを入れてください。
	</p>
</div>

<?php echo $this->bcForm->create('OgpConfig'); ?>
<table class="form-table">
  <tr>
    <th>Twitter ID</th>
	<td>@ <?php echo $this->bcForm->input('OgpConfig.twitter_id', array('type'=>'text')) ?></td>
  </tr>
  <tr>
    <th>Twitter Card</th>
	<td><?php echo $this->bcForm->input('OgpConfig.twitter_card', array('type'=>'select', 'options'=>$twitter_cards)) ?></td>
  </tr>
  <tr>
    <th>facebook App-ID</th>
	<td><?php echo $this->bcForm->input('OgpConfig.facebook_app_id', array('type'=>'text')) ?></td>
  </tr>
  <tr>
    <th>Default Image</th>
	<td><?php echo $this->bcForm->input('OgpConfig.default_image', array('type'=>'text')) ?></td>
  </tr>
  <tr>
    <th>locale</th>
	<td><?php echo $this->bcForm->input('OgpConfig.locale', array('type'=>'text')) ?></td>
  </tr>
  <tr>
    <th>locale_alternate</th>
	<td><?php echo $this->bcForm->input('OgpConfig.locale_alternate', array('type'=>'text')) ?></td>
  </tr>
  <tr>
    <th>ブログ画面表示</th>
	<td><?php echo $this->bcForm->input('OgpConfig.add_blog', array('type'=>'checkbox')) ?></td>
  </tr>
  <tr>
    <th>固定ページ画面表示</th>
	<td><?php echo $this->bcForm->input('OgpConfig.add_content', array('type'=>'checkbox')) ?></td>
  </tr>
  
</table>
<div class="submit">
  <?php echo $this->bcForm->submit('保存', array('class' => 'button')) ?>
</div>
<?php echo $this->bcForm->end(); ?>
