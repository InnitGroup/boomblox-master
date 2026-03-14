<div id="MainPanel">
    <?php if (isset($_POST["recommendedAsset"])) {
        $recommender = new Recommender($_POST["recommendedAsset"]);
        $recommendations = $recommender->generateRecommendations();
        if (!isset($recommendations["Error"])) {
            foreach ($recommendations as $recommendation) {
                echo $recommendation->get()->itemName . "<br>";
            }
        } else {
            echo $recommendations["Error"];
        }
    }
    ?>

    <input type="number" name="recommendedAsset">
    <input type="submit">
</div>