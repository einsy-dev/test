<?php
include 'db/index.php';
$sql = "SELECT DISTINCT category FROM Items";

$category = [];
$dbCategory = $conn->query($sql);

if ($dbCategory->num_rows > 0) {
	?>
	<select class="category-list" name="category">
		<option value="">Select category</option>
	<?php
		while ($cat_row = $dbCategory->fetch_assoc()) {
			$item = categoryItem($cat_row['category']);
			echo $item;
		}
		?>
	</select>
	<?php
}


function categoryItem($title)
{
	ob_start()
		?>
		<option value="<?= $title ?>">
				<?= $title ?>
		</option>
		<?php
		$html = ob_get_clean();
		return $html;
}
?>