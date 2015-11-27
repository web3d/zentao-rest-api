ALTER TABLE `zt_user` 
ADD COLUMN `api_key` VARCHAR(45) NULL DEFAULT '' COMMENT '用于模拟redmine的rest接口时，从key取用户' AFTER `deleted`,
ADD INDEX `api_key` (`api_key` ASC);

# 为已有的数据设置一个随机的key
update zt_user set api_key = md5(CONCAT(account, password, dept, id, RAND()));

ALTER TABLE `zt_user` 
DROP INDEX `api_key` ,
ADD UNIQUE INDEX `api_key` (`api_key` ASC);

ALTER TABLE `zt_team` 
ADD COLUMN `id` INT NULL AUTO_INCREMENT AFTER `hours`,
ADD UNIQUE INDEX `id_UNIQUE` (`id` ASC);

