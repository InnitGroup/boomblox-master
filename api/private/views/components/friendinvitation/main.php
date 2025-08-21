<div id="Body">
	
                    <?php
                        $type = $invitation["type"];
                        switch ($type) {
                            case "Read":
                                $invitation = $invitation["invitationData"];
                                PageBuilder::addComponent("friendinvitation", "read", compact("invitation"));
                                break;
                            case "Write":
                                PageBuilder::addComponent("friendinvitation", "write", compact("invitation"));
                                break;
                            default:
                                Server::_404();
                                break;
                        } 
                    ?>				
</div>
<div style="clear:both;"></div>