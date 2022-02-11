<?php
require_once "vendor/autoload.php";

$data = Finnhub\Configuration::getDefaultConfiguration()->setApiKey('token', 'c832cciad3ie4lt0c0f0');
$client = new Finnhub\Api\DefaultApi(
    new GuzzleHttp\Client(),
    $data);

$search = $_GET['search'] ?? '';
$show = ["PXD", "MSFT", "AAPL", "AEO"];
$searchQuote=$client->quote(strtoupper($search));
$results = [];
foreach ($show as $stockQuote){
    $results[$stockQuote] = $client->quote($stockQuote);
}
?>

<body style="background-color: #404040;">
</body>
<form method="get" action="/"  <label for="start"></label>

<div>
    <head>
        <!--        <meta http-equiv="refresh" content="2">-->
        <style>
            table {
                width: 100%;
                height: 8%;
                font-size: larger;
                color: white;
                background-color: #242424;
            }

            th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: center;
            }
        </style>

        <table>

            <tr>
                <?php foreach ($results as $key=>$stock) { ?>
                <th>
                    <?php
                    echo $key . "\n" .
                        "Price: " . ($stock->getC()) . " $ <br/>\n";
                    if ($stock->getDp() < 0): ?>
                    <span style="color: red; ">
                        <?php echo round(($stock->getDp()), 2) . "%" . "<br/> \n";

                        elseif ($stock->getDp() > 0): ?>
                        <span style="color: green; ">
                            <?php echo round(($stock->getDp()), 2)."%" . "<br/> \n";
                            endif;

                            if ($stock->getD() < 0): ?>
                            <span style="color: red; ">
                                <?php echo round(($stock->getD()), 2);
                                elseif ($stock->getD() > 0): ?>
                                <span style="color: green; ">
                                    <?php echo round(($stock->getD()), 2)."<br/> \n";
                                    endif;
                                    } ?>
                </th>
            </tr>
        </table>
</div>

<p> </p>


<form method="get" action="/">
    <input name='search' placeholder="Search stock symbol" value="">
    <p> </p>

    <button type="submit">Search </button>
    <?php $search = strtoupper($search);
    if ($search !== '') { ?>
    <p> </p>

    <table>
        <tr>
            <th>
                <?php
                echo $search . "<br/>" . "\n";
                echo "Price: " . (round($searchQuote->getC(), 3)) . "$ <br/> \n";
                if ($searchQuote->getDp() < 0): ?>
                <font color="red">
                    <?php echo round(($searchQuote->getDp()), 2) . "%" . "<br/> \n";

                    elseif ($searchQuote->getDp() > 0): ?><font color="green">
                        <?php echo round(($searchQuote->getDp() . " % "), 2) . "<br/> \n";
                        endif;

                        if ($searchQuote->getD() < 0): ?>
                        <font color="red">
                            <?php echo round(($searchQuote->getD()), 2);

                            elseif ($searchQuote->getD() > 0): ?><font color="green">
                                <?php echo round(($searchQuote->getDp() . " % "), 2) . "<br/> \n";
                                endif;
                                } ?>
            </th>
        </tr>
    </table>

</form>

 <?php if ($search !== ''):?>
<form method="get" action="/">

    <button type="submit"> Clear search </button>
    <?php $search ='';
    endif; ?>

</form>


