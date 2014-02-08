<?php
class PS_Pagination 
{
	var $php_self;
	var $rows_per_page = 10; //Number of records to display per page
	var $total_rows = 0; //Total number of rows returned by the query
	var $links_per_page = 5; //Number of links to display per page
	var $append = ""; //Paremeters to append to pagination links
	var $sql = "";
	var $debug = false;
	var $page = 1;
	var $max_pages = 0;
	var $offset = 0;
	
    function PS_Pagination($table,$lsQry,$cond, $rows_per_page, $links_per_page, $append = "") 
    {
        //$this->sql = $sql;
		$this->sql = "SELECT ".$lsQry." FROM ".$table." WHERE ".$cond;
		$this->rows_per_page = (int)$rows_per_page;
		if (intval($links_per_page ) > 0) {
			$this->links_per_page = (int)$links_per_page;
		} else {
			$this->links_per_page = 5;
		}
		$this->append = $append;
		$this->php_self = htmlspecialchars($_SERVER['PHP_SELF'] );
		if (isset($_GET['page'] )) {
			$this->page = intval($_GET['page'] );
		}
	}	      
    
	function paginate() 
    {	 
	//echo $this->sql ;
        $all_rs = mysql_query($this->sql);                
        if (! $all_rs) {
			if ($this->debug)
				echo "SQL query failed. Check your query.<br /><br />Error Returned: " . mysql_error();
			return false;
		}
		$this->total_rows = mysql_num_rows($all_rs );
		@mysql_close($all_rs );
				
		if ($this->total_rows == 0) 
        {
			//if ($this->debug)
			//	echo "Query returned zero rows.";
			return FALSE;
		}
				
		$this->max_pages = ceil($this->total_rows / $this->rows_per_page );
		if ($this->links_per_page > $this->max_pages) {
			$this->links_per_page = $this->max_pages;
		}
		
		if ($this->page > $this->max_pages || $this->page <= 0) {
			$this->page = 1;
		}
				
		$this->offset = $this->rows_per_page * ($this->page - 1);
				
		$rs = @mysql_query($this->sql . " LIMIT {$this->offset}, {$this->rows_per_page}" );
		if (! $rs) {
			if ($this->debug)
				echo "Pagination query failed. Check your query.<br /><br />Error Returned: " . mysql_error();
			return false;
		}
		return $rs;
	}
		
	function renderFirst($tag = 'First') 
    {
		if ($this->total_rows == 0)
			return FALSE;
		
		if ($this->page == 1) {
			//return "$tag ";
			return '<a  href="' . $this->php_self . '?page=1&' . $this->append . '">' . $tag . '</a> ';
		} else {
			return '<a  href="' . $this->php_self . '?page=1&' . $this->append . '">' . $tag . '</a> ';
		}
	}
		
	function renderLast($tag = ' Last') 
    {
		if ($this->total_rows == 0)
			return FALSE;
		
		if ($this->page == $this->max_pages) {
			//return $tag;
			return ' <a  href="' . $this->php_self . '?page=' . $this->max_pages . '&' . $this->append . '">' . $tag . '</a>';
		} else {
			return ' <a  href="' . $this->php_self . '?page=' . $this->max_pages . '&' . $this->append . '">' . $tag . '</a>';
		}
	}
		
	function renderNext($tag = '&gt;&gt;') 
    {
		if ($this->total_rows == 0)
			return FALSE;
		
		if ($this->page < $this->max_pages) {
			return '<a  href="' . $this->php_self . '?page=' . ($this->page + 1) . '&' . $this->append . '">' . $tag . '</a>';
		} else {
			return $tag;
		}
	}
	
	function renderPrev($tag = '&lt;&lt;') 
    {
		if ($this->total_rows == 0)
			return FALSE;
		
		if ($this->page > 1) {
			return ' <a  href="' . $this->php_self . '?page=' . ($this->page - 1) . '&' . $this->append . '">' . $tag . '</a>';
		} else {
			return " $tag";
		}
	}
	
	function renderNav($prefix = '<span class="page_link">', $suffix = '</span>') 
    {
		if ($this->total_rows == 0)
			return FALSE;
		
		$batch = ceil($this->page / $this->links_per_page );
		$end = $batch * $this->links_per_page;
		if ($end == $this->page) {
		}
        
		if ($end > $this->max_pages) {
			$end = $this->max_pages;
		}
        
		$start = $end - $this->links_per_page + 1;
		$links = '';
		
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $this->page) {
				//$links .= $prefix . " $i " . $suffix;
				$links .= ' ' . $prefix . '<a class="graybutton pagelink active" href="' . $this->php_self . '?page=' . $i . '&' . $this->append . '">' . $i . '</a>' . $suffix . ' ';
			} else {
				$links .= ' ' . $prefix . '<a class="graybutton pagelink" href="' . $this->php_self . '?page=' . $i . '&' . $this->append . '">' . $i . '</a>' . $suffix . ' ';
			}
		}
		
		return $links;
	}
	
	function renderFullNav() 
    {
		//return $this->renderFirst() . '&nbsp;' . $this->renderPrev() . '&nbsp;' . $this->renderNav() . '&nbsp;' . $this->renderNext() . '&nbsp;' . $this->renderLast();
			return $this->renderFirst() . '&nbsp;' . $this->renderNav() . '&nbsp;'. $this->renderLast();

}
    function totRows()
    {
        return $this->total_rows;        
    }
	
    function setDebug($debug) 
    {
		$this->debug = $debug;
	}
	function getLinks()
	{
		return $this->renderPrev().$this->renderNav().$this->renderNext();
	}
}
?>
