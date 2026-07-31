<style>.settings-form{max-width:900px}.settings-form .settings-intro{margin:0 0 28px;color:var(--muted);max-width:680px}.settings-form .button{margin-top:8px}</style>
<div class="admin-title">
    <div><p class="eyebrow">Configuration</p><h1>Website settings</h1></div>
</div>
<form class="panel editor settings-form" method="post" action="/admin/settings">
    <?=csrf_field()?>
    <p class="settings-intro">Manage the verified company details shown throughout the public website. Changes take effect immediately.</p>
    <div class="form-grid">
        <label>Company name<input name="company_name" value="<?=e($settings['company_name']??'')?>" maxlength="190" required></label>
        <label>Tagline<input name="tagline" value="<?=e($settings['tagline']??'')?>" maxlength="190" required></label>
        <label>Primary telephone<input type="tel" name="phone_primary" value="<?=e($settings['phone_primary']??'')?>" maxlength="80" required></label>
        <label>Secondary telephone<input type="tel" name="phone_secondary" value="<?=e($settings['phone_secondary']??'')?>" maxlength="80"></label>
        <label>Email address<input type="email" name="email" value="<?=e($settings['email']??'')?>" maxlength="190" required></label>
        <label>Website<input name="website" value="<?=e($settings['website']??'')?>" maxlength="190" required></label>
    </div>
    <button class="button">Save settings</button>
</form>
