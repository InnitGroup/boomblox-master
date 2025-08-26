<div id="MainPanel">
    <div>
        <h1>Machines & Cores</h1>
        <hr>
        <h1>Cores</h1>
        <br>Cores: <?=CPU::getCpuUsagePct()?>% in use of <?=CPU::getCPUs()?><br>
        <br><?=Gameservers::countRunning()?> running, 0 waiting
        <hr>
        <h1>Machines (1)</h1>
        <p>104.219.236.150</p>
        <p>New York, USA</p>
    </div>
</div>