<?php
class Paginator {
    private $items;
    private $limit; #how many items per page
    private $sort; #for hyperlinks
    private $current; #what page we are on
    private $name; #name of the page (Catalog/Games)
    public function __construct($name,$items,$current,$limit,$sort) {
        #$items being the result of the query
        #$limit being how many items we will allow for each page
        $this->name = $name;
        $this->items = $items;
        $this->current = $current;
        $this->limit = $limit;
        $this->sort = $sort;
    }
    public function getPages() {
        return ceil($this->items->rowCount()/$this->limit);
    }
    public function loadPreviousA() {
        if ($this->current > 1) {
            return '<a href="'.htmlspecialchars($this->name).'.aspx'.htmlspecialchars($this->sort).'&p='.((int)$this->current-1).'"><span class="NavigationIndicators">&lt;&lt;</span> Previous</a>';
        }
    }
    public function loadNextA() {
        if ($this->current < $this->getPages()) {
            return '<a href="'.htmlspecialchars($this->name).'.aspx'.htmlspecialchars($this->sort).'&p='.((int)$this->current+1).'">Next <span class="NavigationIndicators">&gt;&gt;</span></a>';
        }
    }
    public function load($header = true) {
        $pages = (int)$this->getPages();
        $pageLabel = "";
        if ($pages > 1) {
            $pageLabel = 'Page '.(int)$this->current.' of '.$pages;
            $this->current < $this->getPages() && $pageLabel .= ": ";
        }

        if ($header) {
            echo '
                <div class="HeaderPager">
                    '.$this->loadPreviousA().'
                    <span>'.$pageLabel.'</span>
                    '.$this->loadNextA().'
                </div>
        ';
        } else {
            echo '
            <div class="HeaderPager">
                    '.$this->loadPreviousA().'
                    <span>'.$pageLabel.'</span>
                    '.$this->loadNextA().'
                </div>
            ';
        }
        
    }
}
?>