<?php
require_once(WWW_DIR."/lib/framework/db.php");

class UserMovies
{
	public function addMovie($uid, $imdbid, $catid=array())
	{
		$db = new Settings();

		$catid = (!empty($catid)) ? $db->escapeString(implode('|', $catid)) : "null";

		$sql = sprintf("insert into usermovies (userID, imdbID, categoryID, createddate) values (%d, %d, %s, now())", $uid, $imdbid, $catid);
		return $db->queryInsert($sql);
	}

	public function getMovies($uid)
	{
		$db = new Settings();
		$sql = sprintf("select usermovies.*, movieinfo.year, movieinfo.plot, movieinfo.cover, movieinfo.title from usermovies left outer join movieinfo on movieinfo.imdbID = usermovies.imdbID where userID = %d order by movieinfo.title asc", $uid);
		return $db->query($sql);
	}

	public function delMovie($uid, $imdbid)
	{
		$db = new Settings();
		$db->queryExec(sprintf("DELETE from usermovies where userID = %d and imdbID = %d ", $uid, $imdbid));
	}

	public function getMovie($uid, $imdbid)
	{
		$db = new Settings();
		$sql = sprintf("select usermovies.*, movieinfo.title from usermovies left outer join movieinfo on movieinfo.imdbID = usermovies.imdbID where usermovies.userID = %d and usermovies.imdbID = %d ", $uid, $imdbid);
		return $db->queryOneRow($sql);
	}

	public function delMovieForUser($uid)
	{
		$db = new Settings();
		$db->queryExec(sprintf("DELETE from usermovies where userID = %d", $uid));
	}

	public function updateMovie($uid, $imdbid, $catid=array())
	{
		$db = new Settings();

		$catid = (!empty($catid)) ? $db->escapeString(implode('|', $catid)) : "null";

		$sql = sprintf("update usermovies set categoryID = %s where userID = %d and imdbID = %d", $catid, $uid, $imdbid);
		$db->queryExec($sql);
	}
}