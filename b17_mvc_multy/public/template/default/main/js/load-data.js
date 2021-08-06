$(document).ready(function(){
    let urlGold = $('#box-gold').attr('data-url');
    let urlCoin = $('#box-coin').attr('data-url');
    $('#box-gold').load(urlGold);
    $('#box-coin').load(urlCoin);
})