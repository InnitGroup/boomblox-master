<div style="height:100%;width:100%;position:absolute;">
    <div id="modalPopup" class="modalPopup" style="z-index:3; width:270px; text-align:center; display: none; position:absolute; left:25%; top:50%; transform: translate(-50%, -50%)">
        <div style="margin: 1.5em">
            <div id="Spinner" style="float:left; margin:0 1em 1em 0">
                <img src="images/ProgressIndicator2.gif" alt="Progress" border="0">
            </div>
            <div id="Requesting" style="display: inline"> Requesting a server</div>
            <div id="Waiting" style="display: none"> Waiting for a server</div>
            <div id="Loading" style="display: none"> A server is loading the game</div>
            <div id="Joining" style="display: none"> The server is ready. Joining the game...</div>
            <div id="Error" style="display: none"> An error occured. Please try again later</div>
            <div id="Expired" style="display: none"> There are no game servers available at this time. Please try again later</div>
            <div id="GameEnded" style="display: none"> The game you requested has ended</div>
            <div id="GameFull" style="display: none"> The game you requested is full. Please try again later</div>
            <div style="text-align: center; margin-top: 1em">
                <input id="Cancel" type="button" class="Button" value="Cancel">
            </div>
        </div>
    </div>
</div>

<div id="modalBackground" style="display:none; opacity:0.25; background-color:gray; z-index:2; height:100%; width:100%; position:absolute; left:50%; top:50%; transform: translate(-50%, -50%)">
</div>