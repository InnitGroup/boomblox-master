<?php
class BrowsePaginator {
    private $target;
    private $page = 1;
    private $pages;
    public function __construct($target, $page, $pages) {
        $this->target = $target;
        $this->page = $page;
        $this->pages = $pages;
    }
    public function load() {
        $half = 5;
        $start = max(1, (int)$this->page - $half);
        $end = min((int)$this->pages, (int)$this->page + $half);

        if ($end - $start + 1 < 10) {
            if ($start == 1) {
                $end = min((int)$this->pages, $start + 9);
            } elseif ($end == (int)$this->pages) {
                $start = max(1, $end - 9);
            }
        }
    
        $paginator = '
        <tr class="GridPager">
            <td colspan="4">
                <table border="0">
                    <tr>
        ';

        if ((int)$this->page >= 7 && $start !== 1) {
            $paginator .= '
                <td>
                    <a href="javascript:__doPostBack(\''.htmlspecialchars($this->target).'\',\'Page$'.($start - 1).'\')">...</a>
                </td>
            ';
        }

        for ($i = $start; $i <= $end; $i++) {
            if ($i == (int)$this->page) {
                $paginator .= '
                    <td>
                        <span>'.$i.'</span>
                    </td>
                ';
            } else {
                $paginator .= '
                    <td>
                        <a href="javascript:__doPostBack(\''.htmlspecialchars($this->target).'\',\'Page$'.$i.'\')">'.$i.'</a>
                    </td>
                ';
            }
        }

        if ($end < (int)$this->pages) {
            $paginator .= '
                <td>
                    <a href="javascript:__doPostBack(\''.htmlspecialchars($this->target).'\',\'Page$'.($end + 1).'\')">...</a>
                </td>
            ';
        }
    
        $paginator .= '
                    </tr>
                </table>
            </td>
        </tr>
        ';
    
        return $paginator;
    }
}
?>