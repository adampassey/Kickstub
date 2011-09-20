<?php

class Db {
	
	private $host;
	private $db;
	private $username;
	private $password;
	private $tablePrefix;
	
	private $resource;
	
	private $results = Array();
	private $error;
	
	public function Db() {
		$this->host = Config::DB_HOST;
		$this->db = Config::DB_DB;
		$this->username = Config::DB_USER;
		$this->password = Config::DB_PASS;
		$this->tablePrefix = Config::TABLE_PREFIX;
		
		$this->resource = @mysql_connect(
			$this->host,
			$this->username,
			$this->password
		);
		
		if( !$this->resource ) {
			$this->error = 'Could not connect: ' . mysql_error();
			return;
		}
		
		@mysql_select_db( $this->db, $this->resource );
	}
	
	public function query( $queryString ) {
		
		$this->results = Array();
		$queryString = trim( $queryString );
		
		$queryString = str_replace( '#__', Config::TABLE_PREFIX, $queryString );
		
		$results = @mysql_query( $queryString, $this->resource );
		
		if( !$results )
			return false;
		
		while( $row = @mysql_fetch_object( $results ) )
			$this->results[] = $row;
			
		@mysql_free_result( $results );
		
		return $this->results;
	}
	
	public function results() {
		return $this->results;
	}
	
	public function isConnected() {
		return ( $this->resource ? true : false );
	}
	
	public function close() {
		@mysql_close( $this->resource );
	}
}