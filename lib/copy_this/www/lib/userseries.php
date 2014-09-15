<?php
require_once(WWW_DIR."/lib/framework/db.php");

class UserSeries
{
	public function addShow($uid, $rageid, $catid=array())
	{
		$db = new Settings();

		$catid = (!empty($catid)) ? $db->escapeString(implode('|', $catid)) : "null";

		$sql = sprintf("insert into userseries (userID, rageID, categoryID, createddate) values (%d, %d, %s, now())", $uid, $rageid, $catid);
		return $db->queryInsert($sql);
	}

	public function getShows($uid)
	{
		$db = new Settings();
		$sql = sprintf("select userseries.*, tvrage.releasetitle from userseries inner join (SELECT ID, releasetitle, rageid FROM tvrage GROUP BY rageid) tvrage on tvrage.rageID = userseries.rageID where userID = %d order by tvrage.releasetitle asc", $uid);
		return $db->query($sql);
	}

	public function delShow($uid, $rageid)
	{
		$db = new Settings();
		$db->queryExec(sprintf("DELETE from userseries where userID = %d and rageID = %d ", $uid, $rageid));
	}

	public function getShow($uid, $rageid)
	{
		$db = new Settings();
		$sql = sprintf("select userseries.*, tvrage.releasetitle from userseries left outer join (SELECT ID, releasetitle, rageid FROM tvrage GROUP BY rageid) tvrage on tvrage.rageID = userseries.rageID where userseries.userID = %d and userseries.rageID = %d ", $uid, $rageid);
		return $db->queryOneRow($sql);
	}

	public function delShowForUser($uid)
	{
		$db = new Settings();
		$db->queryExec(sprintf("DELETE from userseries where userID = %d", $uid));
	}

	public function delShowForSeries($sid)
	{
		$db = new Settings();
		$db->queryExec(sprintf("DELETE from userseries where rageID = %d", $sid));
	}

	public function updateShow($uid, $rageid, $catid=array())
	{
		$db = new Settings();

		$catid = (!empty($catid)) ? $db->escapeString(implode('|', $catid)) : "null";

		$sql = sprintf("update userseries set categoryID = %s where userID = %d and rageID = %d", $catid, $uid, $rageid);
		$db->queryExec($sql);
	}
}