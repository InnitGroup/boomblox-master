<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();
!$user->isTester() && Server::_404();
!isset($_GET["ForumID"]) && !isset($_GET["PostID"]) && Server::_404();

$identifier = isset($_GET["ForumID"]) ? "ForumID" : "PostID";
$forumId = NULL;
if ($identifier == "ForumID") {
    !Forum::forumExists($_GET["ForumID"]) && Server::_404();
    $forumId = $_GET["ForumID"];
    $identifierValue = $forumId;
} else {
    !Thread::threadExists($_GET["PostID"]) && Server::_404();
    $iThread = new Thread($_GET["PostID"]);
    $forumId = $iThread->getForumId();
    $identifierValue = $iThread->getId();
}


if (Server::isPost()) {
    if (isset($_POST['ctl00$cphRoblox$Createeditpost1$PostForm$PostButton'])) {
        $subject = $_POST['ctl00$cphRoblox$Createeditpost1$PostForm$PostSubject'];
        $body = $_POST['ctl00$cphRoblox$Createeditpost1$PostForm$PostBody'];

        if ($user->lastPost()) {
            if ($user->lastPost()->timeSincePosted() < 5) { # FORUM COOLDOWN
                exit(header("Location: /Forum/AddPost.aspx?$identifier=$identifierValue&Error=TooSoon"));
            }
        }   

        if (empty($subject) || empty(trim($subject))) {
            exit(header("Location: /Forum/AddPost.aspx?$identifier=$identifierValue&Error=NoSubject"));
        }

        if (strlen($subject) > 40) {
            exit(header("Location: /Forum/AddPost.aspx?$identifier=$identifierValue&Error=LongSubject"));
        }

        if (strlen($body) > 1000) {
            exit(header("Location: /Forum/AddPost.aspx?$identifier=$identifierValue&Error=LongBody"));
        }

        if (empty($body) || empty(trim($body))) {
            $body = "Body left intentionally blank.";
        }
        
        $iForum = new Forum((int)$forumId);
        $postId = $iForum->addPost($user->getUserId(), $identifier == "PostID" ? $_GET["PostID"] : NULL, $subject, $body, $identifier == "PostID");

        if ($identifier == "ForumID") {
            exit(header("Location: /Forum/ShowPost.aspx?PostID=$postId"));
        } elseif ($identifier == "PostID") {
            $repliedThread = new Thread($identifierValue);
            $exitPost = $repliedThread->isAReply() ? $repliedThread->parentPost() : $_GET["PostID"];
            exit(header("Location: /Forum/ShowPost.aspx?PostID=$exitPost"));
        }
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