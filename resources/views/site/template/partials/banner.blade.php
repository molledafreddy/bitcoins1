<div id="maindiv" class="ticker-wrap">
</div>

<script type="text/javascript">
const currencies = "BTC,ETH,BCH,XRP,LTC,MIOTA,XEM,DASH,NEO,ETC,XMR,STRAT,ZEC";
const xmlhttp = new XMLHttpRequest();
const url = `https://min-api.cryptocompare.com/data/pricemultifull?fsyms=${currencies}&tsyms=USD,BTC`;

const btc = "BTC";
const xmlhttpbtc = new XMLHttpRequest();
const link = `https://min-api.cryptocompare.com/data/pricemultifull?fsyms=${btc}&tsyms=USD,BTC`;

xmlhttp.onreadystatechange = function() {
  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    myFunction(xmlhttp.responseText);
  }
};
xmlhttp.open("GET", url, true);
xmlhttp.send();



xmlhttpbtc.onreadystatechange = function() {
  if (xmlhttpbtc.readyState == 4 && xmlhttpbtc.status == 200) {
    myFunction2(xmlhttpbtc.responseText);
  }
};
xmlhttpbtc.open("GET", link, true);
xmlhttpbtc.send();

function myFunction(response) {
  const coinList = JSON.parse(response).DISPLAY;

  let ticker = [];
  for (let coin in coinList) {
    const { BTC, USD } = coinList[coin];
    ticker.push(`<div class='ticker__item'>
        <strong>${coin}</strong>
    ${USD.PRICE} ${arrow(USD.CHANGEPCT24HOUR)} / ${BTC.PRICE} ${arrow(
      BTC.CHANGEPCT24HOUR
    )}</div>`);
  }

  $('#maindiv').html('<span id="div1">' + ticker + '<span id="div2">' + ticker + '</div></div>');
}

function myFunction2(response) {
  const coinList = JSON.parse(response).DISPLAY;

  let ticker = [];
  for (let coin in coinList) {
    const { BTC, USD } = coinList[coin];
    ticker.push(`<div class='ticker__item BtcPrice'>
        <strong>${coin}</strong>
    ${USD.PRICE} ${arrow(USD.CHANGEPCT24HOUR)}</div>`);
  }

  $('#maindiv2').html('<span id="">' + ticker + '</div></div>');
}

function arrow(change24Bitcoin) {
  let indicadorBitcoin = "";
  let color = "";
  let porcentajeBitcoinCambio = "";

  if (change24Bitcoin.indexOf("-") != -1) {
    indicadorBitcoin = "&#9660;&nbsp";
    color = "down";
  } else {
    indicadorBitcoin = "&#9650;&nbsp;";
    color = "up";
  }

  porcentajeBitcoinCambio = indicadorBitcoin + change24Bitcoin;
  porcentajeBitcoinCambio =
    ' <span class="change ' +
    color +
    ' " >' +
    porcentajeBitcoinCambio +
    "%</span>";

  return porcentajeBitcoinCambio;
}
</script>