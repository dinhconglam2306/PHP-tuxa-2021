<?php

class Helper
{

    public static function showStatus($module, $controller, $id, $status)
    {
        $btnClass = 'btn-success';
        $iconClass = 'fa-check';
        if ($status == 'inactive') {
            $btnClass = 'btn-danger';
            $iconClass = 'fa-minus';
        }
        $xhtml =
            '<a href="index.php?module=' . $module . '&controller=' . $controller . '&action=changestatus&id=' . $id . '&status=' . $status . '" class="btn btn-sm ' . $btnClass . '">
                <i class="fas ' . $iconClass . '"></i>
            </a>';
        return $xhtml;
    }

    public static function highLight($search, $link)
    {
        $url = preg_replace('/' . $search . '/imu', '<mark>$0</mark>', $link);
        return $url;
    }
}
