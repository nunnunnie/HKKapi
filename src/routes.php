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

$app->post('/member',function($request, $response){
    $input = $request->getParsedBody();
    $sql = "INSERT INTO member (IDMem, NameMem, PassMem, NicknameMem, EmailMem, TelMem ) 
        VALUES (:IDMem, :NameMem, :PassMem, :NicknameMem, :EmailMem, :TelMem )";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("IDMem",$input['IDMem']);
    $sth->bindParam("NameMem",$input['NameMem']);
    $sth->bindParam("PassMem",$input['PassMem']);
    $sth->bindParam("NicknameMem",$input['NicknameMem']);
    $sth->bindParam("EmailMem",$input['EmailMem']);
    $sth->bindParam("TelMem",$input['TelMem']);
    $sth->execute();

// $input['id']=$this->db->lastInsertID();
    $result = array("msg"=>true);
    return $this->response->withJson($result);


});

$app->delete('/member/[{id}]', function($request, $response, $args){
    $sth=$this->db->prepare("DELETE FROM member WHERE IDMem=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    #$result=$sth->fetchAll();
    #return $this->response->withJson($result);
    $result = array("msg"=>true);
    return $this->response->withJson($result);
});

$app->post('/member/[{id}]', function($request, $response, $args){
    $input = $request->getParsedBody();
    $sql = "UPDATE member SET NameMem = :NameMem, PassMem= :PassMem, NicknameMem= :NicknameMem,
    EmailMem= :EmailMem, TelMem=:TelMem WHERE IDMem = :IDMem";
    $sth= $this->db->prepare($sql);
    $sth->bindParam("NameMem", $input['NameMem']);
    $sth->bindParam("PassMem", $input['PassMem']);
    $sth->bindParam("NicknameMem", $input['NicknameMem']);
    $sth->bindParam("EmailMem", $input['EmailMem']);
    $sth->bindParam("TelMem", $input['TelMem']);
    $sth->bindParam("IDMem", $args['id']);
    //$sth->debugDumpParams();
    $sth->execute();
    $result = array("msg"=>true);
    //$result=$args['id'];
    return $this->response->withJson($result);

});

$app->get('/hongkwamkit', function($request, $response, $args){
    $sth = $this->db->prepare("SELECT * FROM hongkwamkit ORDER BY IDHong DESC");
    $sth->execute();
    $hongkwamkit = $sth->fetchAll();
    return $this->response->withJson($hongkwamkit);
});

$app->get("/hongkwamkit/[{id}]",function($request, $response, $args){
    $sth = $this->db->prepare("SELECT * FROM hongkwamkit WHERE IDHong =:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $hongkwamkit1 = $sth->fetchObject();
    return $this->response->withJson($hongkwamkit1);
});

$app->post('/hongkwamkit',function($request, $response){
    $input = $request->getParsedBody();
    $sql = "INSERT INTO hongkwamkit (IDHong, NameHong, PassHong) 
        VALUES (:IDHong, :NameHong, :PassHong)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("IDHong",$input['IDHong']);
    $sth->bindParam("NameHong",$input['NameHong']);
    $sth->bindParam("PassHong",$input['PassHong']);

    $sth->execute();

// $input['id']=$this->db->lastInsertID();
    $result = array("msg"=>true);
    return $this->response->withJson($result);


});

$app->post('/hongkwamkit/[{id}]', function($request, $response, $args){
    $input = $request->getParsedBody();
    $sql = "UPDATE hongkwamkit SET NameHong = :NameHong, PassHong= :PassHong WHERE IDHong = :IDHong";
    $sth= $this->db->prepare($sql);
    $sth->bindParam("NameHong", $input['NameHong']);
    $sth->bindParam("PassHong", $input['PassHong']);
    $sth->bindParam("IDHong", $args['id']);
    //$sth->debugDumpParams();
    $sth->execute();
    $result = array("msg"=>true);
    //$result=$args['id'];
    return $this->response->withJson($result);

});
$app->delete('/hongkwamkit/[{id}]', function($request, $response, $args){
    $sth=$this->db->prepare("DELETE FROM hongkwamkit WHERE IDHong=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    #$result=$sth->fetchAll();
    #return $this->response->withJson($result);
    $result = array("msg"=>true);
    return $this->response->withJson($result);
});

$app->get('/topic', function($request, $response, $args){
    $sth = $this->db->prepare("SELECT * FROM topic");
    $sth->execute();
    $topic = $sth->fetchAll();
    return $this->response->withJson($topic);
});

$app->post('/topic',function($request, $response){
    $input = $request->getParsedBody();
    $sql = "INSERT INTO topic (IDtopic, Nametopic) 
        VALUES (:IDtopic, :Nametopic)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("IDtopic",$input['IDtopic']);
    $sth->bindParam("Nametopic",$input['Nametopic']);

    $sth->execute();

// $input['id']=$this->db->lastInsertID();
    $result = array("msg"=>true);
    return $this->response->withJson($result);


});

$app->delete('/topic/[{id}]', function($request, $response, $args){
    $sth=$this->db->prepare("DELETE FROM topic WHERE IDtopic=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    #$result=$sth->fetchAll();
    #return $this->response->withJson($result);
    $result = array("msg"=>true);
    return $this->response->withJson($result);
});



//last
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
