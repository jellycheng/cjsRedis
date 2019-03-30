
CREATE TABLE `t_sequence` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键，自增长',
  `tbl_name` varchar(20) NOT NULL DEFAULT '' COMMENT '序列号用于哪个表',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-正常 1-删除',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `delete_time` int(10) NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COMMENT='序列表';
