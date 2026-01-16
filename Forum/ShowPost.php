<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();
!$user->isTester() && Server::_404();

$postId = isset($_GET["PostID"]) ? (int)$_GET["PostID"] : Server::_404();
!Thread::threadExists($postId) && Server::_404();

$thread = new Thread($postId);
!$thread->viewedBy($user->getUserId()) && $thread->addView();
$thread->isAReply() && Server::_404();
$totalPosts = $thread->countReplies() + 1;
$page = isset($_GET["PageIndex"]) ? (int)$_GET["PageIndex"] : 1;
$pages = ceil($totalPosts / 25);
if ($page > $pages || $page == 0) {
    Server::_404();
}

if (Server::isPost()) {
    if (isset($_POST['__EVENTTARGET'])) {
        switch ($_POST['__EVENTTARGET']) {
            case 'ctl00$cphRoblox$PostView1$ctl00$PostList$ctl00$PreviousThread':
                exit(header("Location: /Forum/ShowPost.aspx?PostID=" . Forum::getPreviousPostId($postId)));
                break;
            case 'ctl00$cphRoblox$PostView1$ctl00$PostList$ctl00$NextThread':
                exit(header("Location: /Forum/ShowPost.aspx?PostID=" . Forum::getNextPostId($postId)));
                break;
        }
    }
}

$page = new PageBuilder(Site::getThemeProperty("alias",$theme).": A FREE Virtual World-Building Game with Avatar Chat, 3D Environments, and Physics", $theme, "/templates/authheader.php", [], "rbxnews");
$page->buildHeader();
?>
<link rel="stylesheet" href="/Forum/skins/default/style/default.css">
<?php
PageBuilder::addComponent("forum", "showpost");

$page->buildFooter();
?>