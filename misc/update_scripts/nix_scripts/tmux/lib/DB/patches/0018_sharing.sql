ALTER TABLE sharing ADD COLUMN max_download MEDIUMINT UNSIGNED NOT NULL DEFAULT '150';

UPDATE sharing SET max_pull = 20000;

UPDATE tmux SET value = '18' WHERE setting = 'sqlpatch';