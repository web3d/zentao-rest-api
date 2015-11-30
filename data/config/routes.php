<?php

//更多使用方法请阅读文档:
//http://docs.slimframework.com/#Routing-Overview

return array(
    'get' => array(
        '/users/current.:format' => 'User:fetchByKey',
        '/users.:format' => 'User:index',
        '/roles/:id.:format' => 'Role:fetch',
        '/roles.:format' => 'Role:fetchAll',
        '/issue_statuses.:format' => 'IssueStatus:index',
        '/issues/:id.:format' => 'Issue:fetch',
        '/issues.:format' => 'Issue:fetchAll',
        '/projects/:id/memberships.:format' => 'ProjectMembership:fetchAll',
        '/projects/:id/versions.:format' => 'ProjectVersion:fetchAll',
        '/projects/:id/issue_categories.:format' => 'IssueCategory:fetchAllByProjectId',
        '/projects/:id.:format' => 'Project:fetch',
        '/projects.:format' => 'Project:fetchAll',
        '/enumerations/issue_priorities.:format' => 'Enum:issue_priorities',
        '/trackers.:format' => 'Tracker:index',
        '/queries.:format' => 'Query:index',
        '/' => 'Main:index',
    ),
    'post' => array(
        
    ),
    'put' => array(
        
    ),
    'delete' => array(
        
    )
);