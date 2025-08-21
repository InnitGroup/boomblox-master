<div id="MainPanel">
    <table style="border-collapse:collapse;">
        <tbody>
            <tr id="TableHeader">
                <th id="TableHeader" style="min-width:50px; color: white;">ID</th>
                <th id="TableHeader" style="min-width:50px; color: white;">Type</th>
                <th id="TableHeader" style="min-width:50px; color: white;">Abuse</th>
                <th id="TableHeader" style="min-width:50px; color: white;">Comment</th>
                <th id="TableHeader" style="min-width:75px; color: white;">Informant</th>
                <th id="TableHeader" style="min-width:75px; color: white;">Handled</th>
                <th id="TableHeader" style="min-width:50px; color: white;">Date</th>
                <th id="TableHeader" style="min-width:50px; color: white;">Moderate</th>
            </tr>
            <?php foreach (Admin::getReportsToReview() as $key => $report) {
                PageBuilder::addComponent("admin", "abuseRow", compact("report", "key"));
            }?>
        </tbody>
    </table>
</div>