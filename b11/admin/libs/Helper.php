<?php

class Helper
{

    public static function showStatus($id, $status)
    {
        $btnClass = 'btn-success';
        $iconClass = 'fa-check';
        if ($status == 'inactive') {
            $btnClass = 'btn-danger';
            $iconClass = 'fa-minus';
        }
        $xhtml = sprintf(
            '<a href="change-status.php?id=%s&status=%s" class="btn btn-sm %s"><i class="fas %s"></i></a>',
            $id,
            $status,
            $btnClass,
            $iconClass
        );
        return $xhtml;
    }

    public static function highLight($search, $link)
    {
        $url = preg_replace('/'.$search.'/imu', '<mark>$0</mark>', $link);
        return $url;
    }
}
