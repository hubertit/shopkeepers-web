<?php

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
} ?>
<div class="row justify-content-xxl-end">
    <div class="col-xxl-9">
        <div class="epix-pagination pagination-area mt-40 mb-70">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center justify-xl-content-left">

                    <li class="page-item <?php if ($page == 1) { ?> disabled<?php } ?>">
                        <a class="page-link prev" href="?page=<?php print $page - 1; ?>" tabindex="-1"><i class="fal fa-angle-left"></i> Prev</a>
                    </li>

                    <?php


                    $query = mysqli_query($connection, "SELECT * FROM shops WHERE country_id ='1'  ");
                    $shops = mysqli_num_rows($query);
                    $pages = $shops / 24;

                    $count = $page;
                    while ($count <= $page + 6) {

                    ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php print $count; ?>"><?php print $count; ?></a></li>
                    <?php
                        $count = $count + 1;
                    } ?>
                    <li class="page-item">
                        <a class="page-link next" href="?page=<?php print $page + 1; ?>">Next <i class="fal fa-angle-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>