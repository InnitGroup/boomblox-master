<?php
class InboxPaginator {
    private $target;
    private $page;
    private $pages;
    private $type;

    public function __construct($target, $page, $pages, $type = "") {
        $this->target = $target;
        $this->page = (int)$page;
        $this->pages = (int)$pages;
        $this->type = !empty($type) ? '$' . $type : '';
    }

    public function load() {
        $half = 5;
        $start = max(1, $this->page - $half);
        $end = min($this->pages, $this->page + $half);

        if ($end - $start + 1 < 10) {
            if ($start === 1) {
                $end = min($this->pages, $start + 9);
            } elseif ($end === $this->pages) {
                $start = max(1, $end - 9);
            }
        }

        $output = '<tr class="InboxPager"><th colspan="4" style="padding-top:5px;padding-bottom:5px;">';

        if ($this->page > 1) {
            $output .= '<a href="javascript:__doPostBack(\'' . htmlspecialchars($this->target) . '\',\'Page$' . ($this->page - 1)  . '\')"><span style="color:white"><<</span></a> ';
        }

        if ($start > 1) {
            $output .= '<a href="javascript:__doPostBack(\'' . htmlspecialchars($this->target) . '\',\'Page$' . ($start - 1)  . '\')"><span style="color:white">...</span></a> ';
        }

        for ($i = $start; $i <= $end; $i++) {
            if ($i === $this->page) {
                $output .= $i . ' ';
            } else {
                $output .= '<a href="javascript:__doPostBack(\'' . htmlspecialchars($this->target) . '\',\'Page$' . $i  . '\')"><span style="color:white">' . $i . '</span></a> ';
            }
        }

        if ($end < $this->pages) {
            $output .= '<a href="javascript:__doPostBack(\'' . htmlspecialchars($this->target) . '\',\'Page$' . ($end + 1)  . '\')"><span style="color:white">...</span></a> ';
        }

        if ($this->page < $this->pages) {
            $output .= '<a href="javascript:__doPostBack(\'' . htmlspecialchars($this->target) . '\',\'Page$' . ($this->page + 1)  . '\')">>></a>';
        }

        $output .= '</th></tr>';
        return $output;
    }
}
?>
