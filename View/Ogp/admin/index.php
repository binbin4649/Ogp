<div class="panel-box">
	<p>
	OGPプラグイン <a href="https://github.com/binbin4649/ogp" target="_blank">github</a><br />
	</p>
	<p>
		<b>Twitter ID</b> : Twitterアカウントがあったら、@の後ろを入力。<br>
		<b>Twitter Card</b> : Twitter IDが入力されていれば、選択されたTwitter Cardが反映されます。<br>
		<b>facebook App-ID</b> : facebookはApp-IDを入力することを推奨している。<br>
		Facebookで開発者（デベロッパー）登録し、取得したApp-IDを記述します。<br>
		App-IDを取得するにはFacebookにログイン後、<a href="https://developers.facebook.com/apps/" target="_blank">「すべてのアプリ – 開発者向けFacebook」</a>ページにアクセスし、「新しいアプリを追加」します。<br>
		新しいアプリを追加し、もろもろ設定することで、App-IDが取得できます。<br>
		<b>Default Image</b> : アイキャッチがない場合に代替する画像のファイル名。<br>
		( app/webroot/テーマ名/img/ ) or ( app/webroot/img/ )<br>
		デフォルトイメージはどちらかのディレクトに入れてください。
	</p>
</div>

<?php echo $this->bcForm->create('Ogp'); ?>
<table class="form-table">
  <tr>
    <th>Twitter ID</th>
	<td>@ <?php echo $this->bcForm->input('OGP.twitter_id', array('type'=>'text', 'value'=>$OGP['OGP']['twitter_id'])) ?></td>
  </tr>
  <tr>
    <th>Twitter Card</th>
	<td><?php echo $this->bcForm->input('OGP.twitter_card', array('type'=>'select', 'options'=>$twitter_cards)) ?></td>
  </tr>
  <tr>
    <th>facebook App-ID</th>
	<td><?php echo $this->bcForm->input('OGP.facebook_app_id', array('type'=>'text', 'value'=>$OGP['OGP']['facebook_app_id'])) ?></td>
  </tr>
  <tr>
    <th>Default Image</th>
	<td><?php echo $this->bcForm->input('OGP.default_image', array('type'=>'text', 'value'=>$OGP['OGP']['default_image'])) ?></td>
  </tr>
</table>
<div class="submit">
  <?php echo $this->bcForm->submit('保存', array('class' => 'button')) ?>
</div>
<?php echo $this->bcForm->end(); ?>
