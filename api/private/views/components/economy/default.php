<?php
global $theme, $db;
?>

<div id="MainPanel">
    <h1>Economy Panel</h1>
    <hr>
    <span>Options</span>
    <ul>
        <li><a href="#">Give someone an item</a></li>
        <li><a href="#">Take an item away from someone</a></li>
        <li><a href="#">Create a new item</a></li>
        <li><a href="#">Give someone <?=Site::getThemeProperty("currency", $theme)?></a></li>
        <li><a href="#">Vote for a new item</a></li>
    </ul>
    <hr>
    <span>Statistics</span>
    <table class="Economy">
        <tr>
            <td title="Dead currency is currency held by banned and terminated users, active currency is currency held by active users"><u>i</u></td>
            <td>Total</td>
            <td>Active</td>
            <td>Dead</td>
        </tr>
        <tr>
            <td><?=Site::getThemeProperty("currency", $theme)?></td>
            <td><?=number_format(Economy::currentBux())?></td>
            <td><?=number_format(Economy::aliveBux())?></td>
            <td><?=number_format(Economy::deadBux())?></td>
        </tr>
        <tr>
            <td>Tickets</td>
            <td><?=number_format(Economy::currentTix())?></td>
            <td><?=number_format(Economy::aliveTix())?></td>
            <td><?=number_format(Economy::deadTix())?></td>
        </tr>
    </table>
    <hr>
    <span>Market Activity</span>
    <table class="Economy">
        <tr>
            <td title="Dead currency is currency held by banned and terminated users, active currency is currency held by active users"><u>i</u></td>
            <td><?=Site::getThemeProperty("currency", $theme)?></td>
            <td>Tickets</td>
        </tr>
        <tr>
            <td>Past Day</td>
            <td><?=number_format(Economy::countCirculatedBux(1))?></td>
            <td><?=number_format(Economy::countCirculatedTix(1))?></td>
        </tr>
        <tr>
            <td>Past Week</td>
            <td><?=number_format(Economy::countCirculatedBux(7))?></td>
            <td><?=number_format(Economy::countCirculatedTix(7))?></td>
        </tr>
        <tr>
            <td>Past Month</td>
            <td><?=number_format(Economy::countCirculatedBux(30))?></td>
            <td><?=number_format(Economy::countCirculatedTix(30))?></td>
        </tr>
    </table>
</div>