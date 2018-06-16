<div class="panel-box">
	<p>
	OGPプラグイン <a href="https://github.com/binbin4649/ogp" target="_blank">github</a><br />
	</p>
	<p>
		<b>Twitter ID</b> : Twitterアカウントがあったら、@の後ろを入力。<br>
		<b>facebook App-ID</b> : facebookはApp-IDを入力することを推奨している。<br>
		Facebookで開発者（デベロッパー）登録し、取得したApp-IDを記述します。<br>
		App-IDを取得するにはFacebookにログイン後、<a href="https://developers.facebook.com/apps/" target="_blank">「すべてのアプリ – 開発者向けFacebook」</a>ページにアクセスし、「新しいアプリを追加」します。<br>
		新しいアプリを追加し、もろもろ設定することで、App-IDが取得できます。<br>
	</p>
</div>

<?php echo $this->bcForm->create('Ogp'); ?>
<table class="form-table">
  <tr>
    <th>Twitter ID</th>
	<td>@ <?php echo $this->bcForm->input('OGP.twitter_id', array('type'=>'text', 'value'=>$OGP['OGP']['twitter_id'])) ?></td>
  </tr>
  <tr>
    <th>facebook App-ID</th>
	<td><?php echo $this->bcForm->input('OGP.facebook_app_id', array('type'=>'text', 'value'=>$OGP['OGP']['facebook_app_id'])) ?></td>
  </tr>
</table>
<div class="submit">
  <?php echo $this->bcForm->submit('保存', array('class' => 'button')) ?>
</div>
<?php echo $this->bcForm->end(); ?>
