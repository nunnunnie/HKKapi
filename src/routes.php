<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/member', function($request, $response, $args){
    $sth = $this->db->prepare("SELECT * FROM member");
    $sth->execute();
    $member = $sth->fetchAll();
    return $this->response->withJson($member);
});

$app->get("/member/[{id}]",function($request, $response, $args){
    $sth = $this->db->prepare("SELECT * FROM member WHERE IDMem =:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $member1 = $sth->fetchObject();
    return $this->response->withJson($member1);
});

$app->get('/member/name/[{query}]',function($request, $response, $args){
    $sth = $this->db->prepare("SELECT * FROM member WHERE NameMem LIKE :q");
    $query = "%".$args['query']."%";
    $sth->bindParam("q", $query);
    $sth->execute();
    $member1 = $sth->fetchAll();
    return $this->response->withJson($member1);
});

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
