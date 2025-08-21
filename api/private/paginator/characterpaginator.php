<?php
class CharacterPaginator {
    private $target;
    private $page = 1;
    private $pages;
    private $type;
    public function __construct($target, $page, $pages, $type = "") {
        $this->target = $target;
        $this->page = $page;
        $this->pages = $pages;
        if (!empty($type)) {
            $this->type = "$".$type;
        } else {
            $this->type = "";
        }
    }
    public function load() {
        $half = 5;
        $start = max(1, (int)$this->page - $half);
        $end = min((int)$this->pages, (int)$this->page + $half);

        if ($end - $start + 1 < 10) {
            if ($start == 1) {
                $end = min((int)$this->pages, $start + 4);
            } elseif ($end == (int)$this->pages) {
                $start = max(1, $end - 3);
            }
        }

        $paginator = '';

        if ((int)$this->page > 1) {
            $paginator .= '
                <a href="javascript:__doPostBack(\''.htmlspecialchars($this->target).'\',\'Page$1'.htmlspecialchars($this->type).'\')">First</a>
                <a href="javascript:__doPostBack(\''.htmlspecialchars($this->target).'\',\'Page$'.(int)($this->page-1).htmlspecialchars($this->type).'\')">Previous</a>
            ';
        } else {
            $paginator .= '
                <span style="color:#dcdcdc;">First</span>
                <span style="color:#dcdcdc;">Previous</span>
            ';
        }

        # add ... before if start cuz thats a nono
        if ($start > 1) {
            $paginator .= '
                <a href="javascript:__doPostBack(\''.htmlspecialchars($this->target).'\',\'Page$'.(int)($start-1).htmlspecialchars($this->type).'\')">...</a>
            ';
        }

        for ($i = $start; $i <= $end; $i++) {
            if ($i == (int)$this->page) {
                $paginator .= '
                    <span>'.$i.'</span>
                ';
            } else {
                $paginator .= '
                    <a href="javascript:__doPostBack(\''.htmlspecialchars($this->target).'\',\'Page$'.$i.htmlspecialchars($this->type).'\')">'.$i.'</a>
                ';
            }
        }

        # add ... after if eend not eeeeee
        if ($end < (int)$this->pages) {
            $paginator .= '
                <a href="javascript:__doPostBack(\''.htmlspecialchars($this->target).'\',\'Page$'.(int)($end+1).htmlspecialchars($this->type).'\')">...</a>
            ';
        }

        if ((int)$this->page < (int)$this->pages) {
            $paginator .= '
                <a href="javascript:__doPostBack(\''.htmlspecialchars($this->target).'\',\'Page$'.(int)($this->page+1).htmlspecialchars($this->type).'\')">Next</a>
                <a href="javascript:__doPostBack(\''.htmlspecialchars($this->target).'\',\'Page$'.(int)($this->pages).htmlspecialchars($this->type).'\')">Last</a>
            ';
        } else {
            $paginator .= '
                <span style="color:#dcdcdc;">Next</span>
                <span style="color:#dcdcdc;">Last</span>
            ';
        }
    
        return $paginator;
    }
}
?>