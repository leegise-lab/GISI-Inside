<?php
$search = $_POST['search'];
?>
<form name="fr" method="post" action="baseballsearch.php">
    <input type="hidden" value="<?php echo $search?>" name="search2">
</form>
<script>
    alert(<?php echo $search?>);
    document.fr.submit();
</script>
