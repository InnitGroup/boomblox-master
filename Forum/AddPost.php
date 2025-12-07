<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();
!$user->hasPerms(3) && Server::_404();
!isset($_GET["ForumID"]) && !isset($_GET["PostID"]) && Server::_404();

$identifier = isset($_GET["ForumID"]) ? "ForumID" : "PostID";
$forumId = NULL;
if ($identifier == "ForumID") {
    !Forum::forumExists($_GET["ForumID"]) && Server::_404();
    $forumId = $_GET["ForumID"];
} else {
    !Thread::threadExists($_GET["PostID"]) && Server::_404();
    $iThread = new Thread($_GET["PostID"]);
    $forumId = $iThread->getForumId();
}


if (Server::isPost()) {
    if (isset($_POST['ctl00$cphRoblox$Createeditpost1$PostForm$PostButton'])) {
        $subject = $_POST['ctl00$cphRoblox$Createeditpost1$PostForm$PostSubject'];
        $body = $_POST['ctl00$cphRoblox$Createeditpost1$PostForm$PostBody'];
        
        $iForum = new Forum((int)$forumId);
        $postId = $iForum->addPost($user->getUserId(), $identifier == "PostID" ? $_GET["PostID"] : NULL, $subject, $body, $identifier == "PostID");

        exit(header("Location: /Forum/ShowPost.aspx?PostID=$postId"));
    }
}

$page = new PageBuilder(Site::getThemeProperty("alias",$theme).": A FREE Virtual World-Building Game with Avatar Chat, 3D Environments, and Physics", $theme, "/templates/authheader.php", [], "rbxnews");
$page->buildHeader();
?>
<link rel="stylesheet" href="/Forum/skins/default/style/default.css">
<?php
PageBuilder::addComponent("forum", "addpost");

$page->buildFooter();
?>