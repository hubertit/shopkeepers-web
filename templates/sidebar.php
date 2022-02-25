<div class="epix-sidebar-area">
    <div class="epix-sidebar-widget mb-40">
        <h4 class="epix-s-widget-title">SHOP BY CATEGORIES</h4>
        <div class="epix-taglist">
            <ul>
                <?php $query = mysqli_query($connection, "SELECT * FROM categories ORDER BY category_name ") or die(mysqli_error($connection));
                while ($category = mysqli_fetch_assoc($query)) { ?>
                    <li><a href="category?id=<?php print $category["category_id"]; ?>"><?php print $category["category_name"]; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>