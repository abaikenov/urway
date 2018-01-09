<?php
use yii\helpers\Url;
?>

<form id="form" action="https://epay.kkb.kz/jsp/process/logon.jsp">
    <input type="hidden" name="Signed_Order_B64" value="<?= $sign?>"/>
    <input type="hidden" name="Language" value="rus"/>
    <input type="hidden" name="BackLink" value="<?= Url::to(['school/check', 'id' => $id], true) ?>"/>
    <input type="hidden" name="FailureLink" value="<?= Url::to(['/'], true) ?>#for-school"/>
    <input type="hidden" name="PostLink" value="<?= Url::to(['post-link/school'], true) ?>"/>
</form>

<script type="text/javascript">
    var form = document.getElementById('form');
    form.submit();
</script>