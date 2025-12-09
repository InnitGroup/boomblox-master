
<div id="Body">
	
                    <?php
                        $type = $message["type"];
                        switch ($type) {
                            case "Read":
                                $message = $message["messageData"];
                                PageBuilder::addComponent("message", "read", compact("message"));
                                break;
                            case "Write":
                                PageBuilder::addComponent("message", "write", compact("message"));
                                break;
                            default:
                                Server::_404();
                                break;
                        } 
                    ?>				
</div>
<div style="clear:both;"></div>