<div id="MainPanel">
    <?php if (isset($_POST["recommendedAsset"])): print_r(Recommender::gatherKeywords($_POST["recommendedAsset"])); endif; ?>

    <input type="number" name="recommendedAsset">
    <input type="submit">
</div>