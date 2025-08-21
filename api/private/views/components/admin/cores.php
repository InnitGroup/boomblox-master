<div id="MainPanel">
    <div>
        <br>Cores: <?=CPU::getCpuUsagePct()?>% in use of <?=CPU::getCPUs()?><br>
        <br><?=Gameservers::countRunning()?> running, 0 waiting
    </div>
</div>