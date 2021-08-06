<?php
class Pagination
{
	private $totalItems;	//Tổng số phần tử
	private $totalItemsPerpage = 1; //Tổng số phần tử xuất hiện trên 1 trang
	private $pageRange = 5;		//Số trang xuất hiện
	private $totalPage; //Tổng số trang
	private $currentPage = 1; //Trang hiện tại

	public function __construct($totalItems, $totalItemsPerpage = 1, $pageRange = 3, $currentPage = 1)
	{
		$this->totalItems = $totalItems;
		$this->totalItemsPerpage = $totalItemsPerpage;
		if ($pageRange % 2 == 0) $pageRange = $pageRange + 1;
		$this->pageRange = $pageRange;
		$this->currentPage = $currentPage;
		if($totalItems > 0){
			$this->totalPage = ceil($totalItems / $totalItemsPerpage);
		}
		
	}

	public function showPagination()
	{
		$paginationHTML = '';
		if ($this->totalPage > 1) {
			$start =  '<li>Start</li>';
			$prev =  '<li>Previous</li>';
			if ($this->currentPage > 1) {
				$start =  '<li><a href="?page=1">Start</a></li>';
				$prev =  '<li><a href="?page=' . ($this->currentPage - 1) . '">Previous</a></li>';
			}

			$next =  '<li>Next</li>';
			$end =  '<li>End</li>';
			if ($this->currentPage < $this->totalPage) {
				$next =  '<li><a href="?page=' . ($this->currentPage + 1) . '">Next</a></li>';
				$end =  '<li><a href="?page=' . $this->totalPage . '">End</a></li>';
			}
			$listPage = '';

			if ($this->pageRange < $this->totalPage) {
				if ($this->currentPage == 1) {
					$startPage = 1;
					$endPage = $this->pageRange;
				} else if ($this->currentPage == $this->totalPage) {
					$startPage = $this->totalPage - $this->pageRange + 1;
					$endPage   = $this->totalPage;
				} else {
					$startPage = $this->currentPage - ($this->pageRange - 1) / 2;
					$endPage   = $this->currentPage + ($this->pageRange - 1) / 2;
					if ($startPage < 1) {
						$startPage = 1;
						$endPage =  $endPage + 1;
					}
					if ($endPage > $this->totalPage) {
						$startPage = $endPage - $this->pageRange + 1;
						$endPage = $this->totalPage;
					}
				}
			} else {
				$startPage = 1;
				$endPage   = $this->totalPage;
			}
			for ($i =  $startPage; $i <= $endPage; $i++) {
				if ($i == $this->currentPage) {
					$listPage .= '<li class ="active">' . $i . '</li>';
				} else {
					$listPage .= '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
				}
			}
			$paginationHTML = '<ul class="pagination">' . $start . $prev . $listPage . $next . $end . '</ul>';
		}

		return $paginationHTML;
	}
}
