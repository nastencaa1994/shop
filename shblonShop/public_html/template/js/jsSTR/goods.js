var cart={};
function init(){
	var hash=window.location.hash.substring(1);//получаем id товара на страницу которого переходим
	$.post(
		'..\\core\\core.php',
		{
			"action":"loadSingl",
			'id':hash
		},
		goodsOut
	);
}
function goodsOut(data){
	//вывод на странуцу
	if(data!=0){
	data=JSON.parse(data);
	console.log(data);
	var out='';
	out+='<div class="cart">';
	out+='<button class="later"data-id="'+data.id+'">&#9829</button>';
	out+='<p class="name">'+data.name+'</p>';
	out+='<img src="..\\img\\'+data.img+'"alt=""width="100%"height="53%"/>';
	out+='<div class="cost">'+data.cost+'</div>';
	out+='<button class="add-to-cart"data-id="'+data.id+'">Купить</button>';
	out+='<div class="decr">'+data.description+'</div><br>';
	out+='</div>';
		//--------
		// out+='<div class="cart">';
		// out+=`<p class="name">${data[key].name}</p>`;
		// out+=`<img src="img\\${data[key].img}"alt=""width="100%"height="53%"/>`;
		// out+=`<div class="cost">${data[key].cost}</div>`;
		// out+=`<button class="add-to-cart"data-id="${key}">Купить</button>`;
		// out+='</div>';
	
	$('.Goods-out').html(out);
	$('.add-to-cart').on('click',addToCart);
	$('.later').on('click',addLater);
}
else {
	$('.Goods-out').html('Такого товара не существует');
}
}
function addLater(){
	// добовляю товар в желания
	var later={};
	if(localStorage.getItem('later')){
		//если есть -расшифровываю и записываю переменную later
		later=JSON.parse(localStorage.getItem('later'));
	}
	alert('Добавлено в желания');
	var id=$(this).attr('data-id');
	later[id]=1;
	localStorage.setItem('later',JSON.stringify(later));
}
function addToCart(){
	//добавляем товар в корзину--------------------------------
	var id=$(this).attr('data-id');
	if(cart[id]==undefined){
		cart[id]=1;
	}
	else{
		cart[id]++;
	}
	showMiniCart();
	saveCart();
}
function saveCart(){
	//сохраняем карзину в localStorage--------------------------------------------
	localStorage.setItem('cart',JSON.stringify(cart));//конвертируем карзину в строку
}
function showMiniCart(){
	//показываем мини карзину
	var out="";
	for(var key in cart){
		out+=key+"---"+cart[key]+'<br>';
	}
	$('.mini-cart').html(out);
}
function loadCard(){
	//проверяю есть ли в localStorage запись в cart
	if(localStorage.getItem('cart')){
		//если есть -расшифровываю и записываю переменную cart
		cart=JSON.parse(localStorage.getItem('cart'));
		showMiniCart();
	}
}
$(document).ready(function(){
	init();
	loadCard();
})