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
       
    }	      
    
	function paginate() 
    	{	 
	
	}
		
	function renderFirst($tag = 'First') 
	{
	
	}
		
	function renderLast($tag = ' Last') 
	{
	
	}
		
	function renderNext($tag = '&gt;&gt;') 
	{
	
	}
	
	function renderPrev($tag = '&lt;&lt;') 
	{
	
	}
	
	function renderNav($prefix = '<span class="page_link">', $suffix = '</span>') 
 	{
	
	}
	
	function renderFullNav() 
    	{
	
	}
    	function totRows()
    	{
        
    	}
	
    	function setDebug($debug) 
    	{

	}
	function getLinks()
	{

	}
}
?>
