<?php
define('SITEURL', '/contactsBook/');

function print_arr($arr) {
    echo "<pre>";
    print_r($arr);
    exit();
}

// Pagination
function getpagination($total_records, $current_page = 1, $per_page = 5) {
    $total_pages = !empty($total_records) ? ceil($total_records / $per_page) : 0;
    $pagination = '';

    if ($total_pages > 1) {
        $pagination .= '<nav>
            <ul class="pagination justify-content-center">';

        // Previous button
        $prevClass = ($current_page <= 1) ? "disabled" : "";
        $prevPage = max(1, $current_page - 1);
        $pagination .= '<li class="page-item ' . $prevClass . '">
            <a class="page-link" href="' . SITEURL . 'index.php?page=' . $prevPage . '">Previous</a>
        </li>';

        // Page numbers
        for ($page = 1; $page <= $total_pages; $page++) {
            if ($page == $current_page) {
                $pagination .= '<li class="page-item active">
                    <span class="page-link">' . $page . '</span>
                </li>';
            } else {
                $pagination .= '<li class="page-item">
                    <a class="page-link" href="' . SITEURL . 'index.php?page=' . $page . '">' . $page . '</a>
                </li>';
            }
        }

        // Next button
        $nextClass = ($current_page >= $total_pages) ? "disabled" : "";
        $nextPage = min($total_pages, $current_page + 1);
        $pagination .= '<li class="page-item ' . $nextClass . '">
            <a class="page-link" href="' . SITEURL . 'index.php?page=' . $nextPage . '">Next</a>
        </li>';

        $pagination .= '</ul>
        </nav>';
    }

    echo $pagination;
}
?>
